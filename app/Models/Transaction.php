<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'transactions';

    public function scopeBulanIni($query)
    {
        return $query->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year);
    }

    public function scopeBulanSebelumIni($query, $monthsAgo)
    {
        return $query->whereMonth('created_at', now()->subMonths($monthsAgo)->month)
            ->whereYear('created_at', now()->subMonths($monthsAgo)->year);
    }
}
