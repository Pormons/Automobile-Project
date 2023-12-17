<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BodyStyle;
use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Color;
use App\Models\User;
use App\Models\Variant;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Customer']);
        Role::create(['name' => 'Dealer']);

        BodyStyle::create(['body_style' => 'Sedan']);
        BodyStyle::create(['body_style' => 'Coupe']);
        BodyStyle::create(['body_style' => 'Hatchback']);
        BodyStyle::create(['body_style' => 'Pickup']);
        BodyStyle::create(['body_style' => 'Off-road']);
        BodyStyle::create(['body_style' => 'Van']);
        BodyStyle::create(['body_style' => 'Crossover']);
        BodyStyle::create(['body_style' => 'SUV']);
        BodyStyle::create(['body_style' => 'Wagon']);

        Color::create(['color_name' => 'Black']);
        Color::create(['color_name' => 'Blue']);
        Color::create(['color_name' => 'Brown']);
        Color::create(['color_name' => 'Gold']);
        Color::create(['color_name' => 'Gray']);
        Color::create(['color_name' => 'Green']);
        Color::create(['color_name' => 'Orange']);
        Color::create(['color_name' => 'Red']);
        Color::create(['color_name' => 'White']);
        Color::create(['color_name' => 'Silver']);
        Color::create(['color_name' => 'Yellow']);

        Variant::create(['variant_name' => 'Base']);
        Variant::create(['variant_name' => 'Premium']);
        Variant::create(['variant_name' => 'Sport']);


        Brand::create(['brand_name' => 'Ford']);
        Brand::create(['brand_name' => 'Toyota']);
        Brand::create(['brand_name' => 'Nissan']);
        Brand::create(['brand_name' => 'Mitsubishi']);

        $admin = User::create([
            "first_name" =>  'Admin',
            "address" =>  'Admin City',
            "email" =>  'admin@gmail.com',
            "password" => bcrypt( 'password'),
            "user_type" => 'admin'
        ]);

        $admin->assignRole('Admin');
    }
}
