<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Administrator']);
        $manager = Role::create(['name' => 'Manager']);
        $seller = Role::create(['name' => 'Seller']);

        $firstUser = User::first();

        if ($firstUser) {
            $firstUser->assignRole('Administrator');
        }
    }
}
