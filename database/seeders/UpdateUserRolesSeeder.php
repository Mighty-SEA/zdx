<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateUserRolesSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->update(['role' => 'admin']);
    }
} 