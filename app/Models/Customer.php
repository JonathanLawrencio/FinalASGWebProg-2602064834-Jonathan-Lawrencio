<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    // Primary key
    protected $primaryKey = 'customer_id';

    protected $guarded = ['customer_id'];
}
