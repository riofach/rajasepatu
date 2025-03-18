<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
class ProductTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'booking_trx_id',
        'city',
        'post_code',
        'proof',
        'shoe_size',
        'address',
        'quantity',
        'sub_total_amount',
        'grand_total_amount',
        'discount_amount',
        'is_paid',
        'shoe_id',
        'promo_code_id',
    ];

    public static function generateUniqueTrxId()
    {
        $prefix = 'RS';
        do {
            $trxId = $prefix . Str::random(5);
        } while (self::where('booking_trx_id', $trxId)->exists());

        return $trxId;
    }

    public function shoe()
    {
        return $this->belongsTo(Shoe::class);
    }

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }



}