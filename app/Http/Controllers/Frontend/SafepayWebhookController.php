<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Safepay\Webhook;
use Throwable;

class SafepayWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $signature = $request->header('X-SFPY-SIGNATURE');
        $payload = $request->getContent();
        $secret = config('payment.safepay.webhook_secret');

        if (!$signature || !$secret) {
            Log::warning('Safepay webhook: missing signature or secret.');

            return response('Missing webhook signature or secret.', 400);
        }

        // Verify the original, unmodified request body.
        try {
            $event = Webhook::constructEvent(
                $payload,
                $signature,
                $secret
            );
        } catch (Throwable $e) {
            Log::warning('Safepay webhook signature verification failed.', [
                'message' => $e->getMessage(),
            ]);

            return response('Invalid webhook signature.', 400);
        }

        // Ignore events other than payment events we handle.
        if (!in_array($event->type, [
            'payment.succeeded',
            'payment.failed',
        ], true)) {
            return response('Event ignored.', 200);
        }

        $payment = $event->data;

        // Our checkout service adds order_id to tracker metadata.
        $orderId = data_get($payment, 'metadata.order_id');

        if (!$orderId) {
            Log::warning('Safepay webhook: order ID missing in metadata.');

            return response('Order reference missing.', 400);
        }

        try {
            DB::transaction(function () use ($payment, $orderId, $event) {

                $order = Order::whereKey($orderId)
                    ->lockForUpdate()
                    ->first();

                if (!$order) {
                    throw new \RuntimeException('Order not found.');
                }

                // Do not process unrelated payment methods.
                if ($order->payment_method !== 'online') {
                    throw new \RuntimeException(
                        'Order payment method does not match.'
                    );
                }

                // Verify amount and currency before changing payment status.
                $expectedAmount = (int) round((float) $order->total * 100);
                $receivedAmount = (int) data_get($payment, 'amount');
                $currency = strtoupper((string) data_get($payment, 'currency'));

                if (
                    $receivedAmount !== $expectedAmount ||
                    $currency !== 'PKR'
                ) {
                    throw new \RuntimeException(
                        'Payment amount or currency mismatch.'
                    );
                }

                // Idempotency: never process a successful payment twice.
                if ($order->payment_status === 'paid') {
                    return;
                }

                if ($event->type === 'payment.succeeded') {
                    $order->update([
                        'payment_status' => 'paid',
                    ]);
                }

                // We will handle failed status after checking your
                // actual payment_status column definition.
            });

        } catch (Throwable $e) {
            Log::error('Safepay webhook processing failed.', [
                'order_id' => $orderId,
                'message' => $e->getMessage(),
            ]);

            return response('Webhook processing failed.', 400);
        }

        return response('Webhook received.', 200);
    }
}
