<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name' => 'Hannah Tinkler',
            'email' => 'hannah.tinkler@mayden.co.uk',
            'slug' => str_slug('Hannah Tinkler'),
            'curator' => 0
        ]);

        User::create([
            'name' => 'Taryn Duncum',
            'email' => 'taryn.duncum@mayden.co.uk',
            'slug' => str_slug('Taryn Duncum'),
            'curator' => 1
        ]);
    }
}
