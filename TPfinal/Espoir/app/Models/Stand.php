<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stand extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'description',
        'emplacement',
        'user_id',
        'status',
        'message_rejet',
    ];

    /**
     * Get the user that owns the stand.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the products for the stand.
     */
    public function produits(): HasMany
    {
        return $this->hasMany(Produit::class);
    }

    /**
     * Get the orders for the stand.
     */
    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class);
    }
}
