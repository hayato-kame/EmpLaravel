<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 親テーブルから順に書くこと
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([ UsersTableSeeder::class]);
        $this->call([ DepartmentsTableSeeder::class]);
        $this->call([ PhotosTableSeeder::class ]);
    }
}
