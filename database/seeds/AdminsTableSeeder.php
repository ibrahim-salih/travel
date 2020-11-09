<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\Admin::create([
            'name'  => 'Ibrahim Saleh',
            'email'  => 'ibrahim@gmail.com',
            'password'  => bcrypt('12345678'),
        ]);
        $user->attachRole('super_admin');
    }
}
