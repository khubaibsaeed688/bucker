<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{

    protected $fillable = [
        'user_id',
        'order_number',
        'subtotal',
        'shipping_cost',
        'discount',
        'total',
        'status',
        'payment_status',

        // Billing Details
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

        // Payment
        'payment_method',

        // Shipping Details
        'ship_to_different_address',
        'shipping_first_name',
        'shipping_last_name',
        'shipping_country',
        'shipping_address',
        'shipping_city',
        'shipping_state',
        'shipping_postcode',
        'shipping_phone',
    ];


    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
