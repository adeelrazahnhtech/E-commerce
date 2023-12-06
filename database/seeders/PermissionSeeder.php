<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      

        DB::table('permissions')->insert([
         ['name' => 'product-store'],
         ['name' => 'product-update'],
         ['name' => 'product-delete'],
         ['name' => 'seller-update'],
         ['name' => 'seller-delete'],
          ]);
    }
}
