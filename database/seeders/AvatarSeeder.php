<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Avatar;

class AvatarSeeder extends Seeder
{
    
    public function run()
    {
        $avatars = [
            ['name' => 'Avatar 1', 'image_path' => 'images/avatars/avatar1.jpg', 'price' => 50],
            ['name' => 'Avatar 2', 'image_path' => 'images/avatars/avatar2.jpg', 'price' => 100],
            ['name' => 'Avatar 3', 'image_path' => 'images/avatars/avatar3.jpg', 'price' => 500],
            ['name' => 'Avatar 4', 'image_path' => 'images/avatars/avatar4.jpg', 'price' => 1000],
            ['name' => 'Avatar 5', 'image_path' => 'images/avatars/avatar5.jpg', 'price' => 5000],
            ['name' => 'Avatar 6', 'image_path' => 'images/avatars/avatar6.jpg', 'price' => 10000],
            ['name' => 'Avatar 7', 'image_path' => 'images/avatars/avatar7.jpg', 'price' => 25000],
            ['name' => 'Avatar 8', 'image_path' => 'images/avatars/avatar8.jpg', 'price' => 50000],
            ['name' => 'Avatar 9', 'image_path' => 'images/avatars/avatar9.jpg', 'price' => 75000],
            ['name' => 'Avatar 10', 'image_path' => 'images/avatars/avatar10.jpg', 'price' => 100000],
        ];

        foreach ($avatars as $avatar) {
            Avatar::create($avatar);
        }
    }
}
