<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'schedule_id',
        'participants',
        'amount',
        'payment_status',
        'payment_method_id',
        'paid_at',
        'is_canceled',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function paymentMethod(): HasOne{
        return $this->hasOne(PaymentMethod::class);
    }
    
    public function schedule(): BelongsTo{
        return $this->belongsTo(Schedule::class);
    }
}
