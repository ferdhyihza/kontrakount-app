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
        return $query->whereMonth('date', now()->month)
            ->whereYear('date', now()->year);
    }

    public function scopeBulanSebelumIni($query, $monthsAgo)
    {
        return $query->whereMonth('date', now()->subMonths($monthsAgo)->month)
            ->whereYear('date', now()->subMonths($monthsAgo)->year);
    }
}
