<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;

    protected $primaryKey = 'avatar_id';
    protected $fillable = ['name', 'image_path', 'price'];

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_avatars', 'avatar_id', 'customer_id');
    }
}
