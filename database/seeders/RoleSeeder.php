<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Support\RoleEnum;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
          ['title' => 'ROOT', 'description' => 'L\'utente che tutto vede e tutto fa'],
          ['title' => 'ADMIN', 'description' => 'L\'utente da pannello di controllo'],
          ['title' => 'RESTAURANT', 'description' => 'Utente ristoratore'],
          ['title' => 'GUEST', 'description' => 'L\'utente del sito web'],
        ];

        foreach ($roles as $role) {
          $role = Role::firstOrCreate($role);
        }
    }
}
