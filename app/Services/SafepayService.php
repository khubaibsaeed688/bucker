<?php

namespace App\Services;

use App\Models\Order;
use Safepay\SafepayClient;
use Safepay\Checkout;
use RuntimeException;

class SafepayService
{
    protected function client(): SafepayClient
    {
        $secretKey = config('payment.safepay.secret_key');
        $baseUrl = config('payment.safepay.base_url');

        if (!$secretKey || !$baseUrl) {
            throw new RuntimeException(
                'Safepay credentials are not configured.'
            );
        }

        return new SafepayClient([
            'api_key' => $secretKey,
            'api_base' => $baseUrl,
        ]);
    }

    public function createCheckoutUrl(
        Order $order,
        string $successUrl,
        string $cancelUrl
    ): string {

        $client = $this->client();

        $publicKey = config('payment.safepay.public_key');

        if (!$publicKey) {
            throw new RuntimeException(
                'Safepay Public Key is missing.'
            );
        }

        // Convert PKR to paisa.
        $amount = (int) round((float) $order->total * 100);

        if ($amount <= 0) {
            throw new RuntimeException('Invalid payment amount.');
        }

        // Create Safepay customer.
        $customer = $client->customer->create([
            'first_name' => $order->first_name,
            'last_name' => $order->last_name,
            'email' => $order->email,
            'phone_number' => $order->phone,
            'country' => 'PK',
        ]);

        if (empty($customer->token)) {
            throw new RuntimeException(
                'Safepay customer token was not generated.'
            );
        }

        // Create payment tracker.
        $session = $client->order->setup([
            'customer' => $customer->token,
            'merchant_api_key' => $publicKey,
            'intent' => 'CYBERSOURCE',
            'mode' => 'payment',
            'currency' => 'PKR',
            'amount' => $amount,
        ]);

        $trackerToken = $session->tracker->token ?? null;

        if (!$trackerToken) {
            throw new RuntimeException(
                'Safepay payment tracker was not generated.'
            );
        }

        // Attach Bucker order ID to Safepay tracker.
        $client->order->metadata($trackerToken, [
            'data' => [
                'order_id' => (string) $order->id,
            ],
        ]);

        // Generate authentication token.
        $tbt = $client->passport->create();

        if (empty($tbt->token)) {
            throw new RuntimeException(
                'Safepay authentication token was not generated.'
            );
        }

        // Generate hosted checkout URL.
        $checkoutUrl = Checkout::constructURL([
            'environment' => config('payment.mode'),
            'tracker' => $trackerToken,
            'tbt' => $tbt->token,

            // Correct parameter name.
            'user_id' => $customer->token,

            'redirect_url' => $successUrl,
            'cancel_url' => $cancelUrl,

            // Website hosted checkout.
            'source' => 'hosted',
        ]);

        if (!$checkoutUrl || !filter_var($checkoutUrl, FILTER_VALIDATE_URL)) {
            throw new RuntimeException(
                'Safepay returned an invalid checkout URL.'
            );
        }

        return $checkoutUrl;
    }
}
