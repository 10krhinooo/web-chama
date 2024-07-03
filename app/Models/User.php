<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\HasTenants;
use Filament\Notifications\Collection;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',        // Changed from 'Name' to 'name'
        'id_number',   // Changed from 'ID_number' to 'id_number'
        'email',
        'password',
        'image_path'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
    //
    // public function getTenants(panel $panel): Collection
    // {
    //     return $this->teams;
    // }
    // public function teams(): BelongsToMany
    // {
    //     return $this->belongsToMany(Team::class);
    // }


    // // public function getTenants(Panel $panel): Collection
    // // {
    // //     return $this->teams;
    // // }

    // public function canAccessTenant(Model $tenant): bool
    // {
    //     return $this->teams()->whereKey($tenant)->exists();
    // }
    // public function teams(): BelongsToMany
    // {
    //     return $this->belongsToMany(Team::class);
    // }

    // public function getTenants(Panel $panel): Collection
    // {
    //     return $this->teams;
    // }
}
