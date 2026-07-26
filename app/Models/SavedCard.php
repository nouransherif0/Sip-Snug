<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Defines the structure and properties of this class
class SavedCard extends Model
{
    use HasFactory;

    // Defines which columns can be safely mass-assigned in the database
    protected $fillable = [
        'user_id',
        'card_type',
        'card_name',
        'card_number',
        'expiry_date',
        'cvv',
    ];

    public function user()
    {
        // Defines a relationship: this model belongs to a parent model
        return $this->belongsTo(User::class);
    }
}
