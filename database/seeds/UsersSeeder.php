<?php

use Illuminate\Database\Seeder;
use App\User, Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $new = New User();
        $new->role = 'admin';
        $new->name = 'AutoPartner';
        $new->email = 'test@test.com';
        $new->email_verified_at = Carbon::now()->subDays(3);
        $new->password = bcrypt('102030');
        $new->created_at = Carbon::now()->subDays(3);
        $new->updated_at = Carbon::now()->subDays(3);
        $new->save();
    }
}
