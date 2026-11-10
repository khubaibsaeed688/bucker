<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            // Billing details
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            // Additional details
            $table->text('order_notes')->nullable();

            // Payment details
            $table->string('payment_method')->nullable();

            // Shipping address
            $table->boolean('ship_to_different_address')
                ->default(false);

            $table->string('shipping_first_name')->nullable();
            $table->string('shipping_last_name')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_postcode')->nullable();
            $table->string('shipping_phone')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropColumn([
                'first_name',
                'last_name',
                'company',
                'country',
                'address',
                'address_line_2',
                'city',
                'state',
                'postcode',
                'phone',
                'email',
                'order_notes',
                'payment_method',
                'ship_to_different_address',
                'shipping_first_name',
                'shipping_last_name',
                'shipping_country',
                'shipping_address',
                'shipping_city',
                'shipping_state',
                'shipping_postcode',
                'shipping_phone',
            ]);
        });
    }
};