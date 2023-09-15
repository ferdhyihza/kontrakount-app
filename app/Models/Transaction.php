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
        return $query->whereMonth('datetime', now()->month)
            ->whereYear('datetime', now()->year);
    }

    public function scopeBulanSebelumIni($query, $monthsAgo)
    {
        return $query->whereMonth('datetime', now()->subMonths($monthsAgo)->month)
            ->whereYear('datetime', now()->subMonths($monthsAgo)->year);
    }
}
