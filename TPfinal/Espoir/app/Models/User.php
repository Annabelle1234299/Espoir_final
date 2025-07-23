<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Commande;
use App\Models\Stand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    
    /**
     * Constantes pour les différents rôles
     */
    const ROLE_ADMIN = 'admin';
    const ROLE_ENTREPRENEUR_EN_ATTENTE = 'entrepreneur_en_attente';
    const ROLE_ENTREPRENEUR_APPROUVE = 'entrepreneur_approuve';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',     // Ajouté pour la gestion des rôles
        'phone',    // Numéro de téléphone
        'address',  // Adresse postale
        'preferences', // Préférences culinaires en JSON
        'photo_profil', // Photo de profil (chemin de fichier)
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
    
    /**
     * Get the stand associated with the user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stand(): HasOne
    {
        return $this->hasOne(Stand::class);
    }
    
    /**
     * Get the orders placed by the user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class);
    }
    
    /**
     * Check if user has the specified role.
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
    
    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }
    
    /**
     * Check if user is an approved entrepreneur.
     */
    public function isApprovedEntrepreneur(): bool
    {
        return $this->role === self::ROLE_ENTREPRENEUR_APPROUVE;
    }
    
    /**
     * Check if user is a pending entrepreneur.
     */
    public function isPendingEntrepreneur(): bool
    {
        return $this->role === self::ROLE_ENTREPRENEUR_EN_ATTENTE;
    }
}
