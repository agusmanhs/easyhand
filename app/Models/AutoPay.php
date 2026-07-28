<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoPay extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    protected $casts = [
        'status' => 'boolean',
        'last_run_at' => 'datetime',
        'next_run_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function booted()
    {
        static::saving(function ($autoPay) {
            if (!$autoPay->user_id) {
                $autoPay->user_id = auth()->id();
            }
            
            if ($autoPay->isDirty(['schedule_type', 'schedule_day', 'schedule_time']) || !$autoPay->next_run_at) {
                $autoPay->next_run_at = self::calculateNextRunAt($autoPay->schedule_type, $autoPay->schedule_day, $autoPay->schedule_time);
            }
        });
    }

    public static function calculateNextRunAt($type, $day, $time)
    {
        $now = \Carbon\Carbon::now();
        $next = \Carbon\Carbon::parse($time);
        
        if ($type === 'daily') {
            if ($next->isPast()) {
                $next->addDay();
            }
        } elseif ($type === 'weekly') {
            // day: 1 (Mon) - 7 (Sun)
            $next = $next->next($day);
            if ($now->dayOfWeekIso == $day && \Carbon\Carbon::parse($time)->isFuture()) {
                $next = \Carbon\Carbon::parse($time);
            }
        } elseif ($type === 'monthly') {
            $next->day($day);
            if ($next->isPast()) {
                $next->addMonth();
            }
        }
        
        return $next;
    }
}
