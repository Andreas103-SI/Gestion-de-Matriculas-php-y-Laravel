<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'two_factor_code',
        'two_factor_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
    public function generateTwoFactorCode(): void
    {
        $this->timestamps = false;  // Previene que se actualicen los timestamps automáticamente
        $this->two_factor_code = rand(100000, 999999);  // Genera un código de 6 dígitos
        $this->two_factor_expires_at = now()->addMinutes(10);  // Establece la expiración del código a 10 minutos desde ahora
        $this->save();
    }

    public function resetTwoFactorCode(): void
    {
        $this->timestamps = false;  // Previene que se actualicen los timestamps automáticamente
        $this->two_factor_code = null;  // Limpia el código de autenticación de dos factores
        $this->two_factor_expires_at = null;  // Limpia la expiración del código
        $this->save();
    }
}
