<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'detail',
        'img',
        'status', //未対応、対応中、対応済み
    ];
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
