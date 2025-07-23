<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produit extends Model
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
        'prix',
        'quantite',
        'image',
        'stand_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'prix' => 'decimal:2',
        'quantite' => 'integer',
    ];

    /**
     * Get the stand that owns the product.
     */
    public function stand(): BelongsTo
    {
        return $this->belongsTo(Stand::class);
    }
}
