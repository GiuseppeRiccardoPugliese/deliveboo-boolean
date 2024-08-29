<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'number_order',
        'price',
        'guest_name',
        'guest_email',
        'guest_address',
        'restaurant_id',
        // Aggiungi altri campi fillable, se necessario
    ];
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function dishes()
    {
        return $this->belongsToMany(Dish::class);
    }
}
