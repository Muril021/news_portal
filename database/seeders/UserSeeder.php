<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::where('name', 'admin')->first();
        $roleEditor = Role::where('name', 'editor')->first();

        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@investidor10.com',
            'password' => bcrypt('password')
        ]);

        $roleAdmin && $adminUser->roles()->attach($roleAdmin);

        $editorUser = User::create([
            'name' => 'Editor',
            'email' => 'editor@investidor10.com',
            'password' => bcrypt('password')
        ]);

        $roleEditor && $editorUser->roles()->attach($roleEditor);
    }
}
