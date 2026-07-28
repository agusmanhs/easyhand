<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

#[Fillable(['name', 'email', 'password', 'saldo', 'saldo_hash'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->hasRole('admin');
        }

        if ($panel->getId() === 'member') {
            return $this->hasRole('member');
        }

        return false;
    }


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    protected static function booted(): void
    {
        static::saving(function (User $user) {
            // Re-calculate hash using email and current saldo
            // We use email instead of id because id might be null on creation
            $user->saldo_hash = hash_hmac('sha256', $user->email . $user->saldo, config('app.key'));
        });
    }

    public function getSaldoAttribute($value)
    {
        // Skip check if the user is completely new and has no email yet (rare, but just in case)
        if (!$this->email) {
            return $value;
        }

        $expectedHash = hash_hmac('sha256', $this->email . $value, config('app.key'));
        
        if ($this->saldo_hash !== $expectedHash) {
            \Illuminate\Support\Facades\Log::warning("POTENTIAL TAMPERING DETECTED: User {$this->email} balance was changed maliciously. Expected hash: {$expectedHash}, Found: {$this->saldo_hash}");
            return 0; // Freeze balance to 0
        }

        return $value;
    }
}
