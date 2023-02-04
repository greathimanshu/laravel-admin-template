<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::firstOrNew(['email' =>  'admin@admin.com']);
        $admin->name = 'admin';
        $admin->email = 'admin@admin.com';
        $admin->password = Hash::make('123456');
        $admin->email_verified_at = date('Y-m-d H:i:s', strtotime('now'));
        $admin->save();

        //Assign role
        $admin->assignRole('admin');
    }
}
