<?php

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       // $this->call(UsersSeeder::class);
        $this->call(SettingsSeeder::class);
       // $this->call(SlidersSeeder::class);
       // $this->call(ServicesSeeder::class);
       // $this->call(ProjectsSeeder::class);
       // $this->call(WorksSeeder::class);
    }
}
