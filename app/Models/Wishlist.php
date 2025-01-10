<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlists';

    protected $fillable = [
        'customer_id',
        'wishlist_customer_id',
    ];

    // Relasi ke model Customer (Customer yang menambahkan wishlist)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    // Relasi ke model Customer (Customer yang masuk ke wishlist)
    public function wishlistCustomer()
    {
        return $this->belongsTo(Customer::class, 'wishlist_customer_id', 'customer_id');
    }
}
