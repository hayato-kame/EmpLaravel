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
        $this->call([UsersTableSeeder::class]);
        $this->call([DepartmentsTableSeeder::class]);  // employeesテーブルの親テーブル
        $this->call([PhotosTableSeeder::class]);   //  employeesテーブルの親テーブル
        $this->call([EmployeesTableSeeder::class]);  // departmentsテーブルと、photosテーブルの子テーブル
    }
}
