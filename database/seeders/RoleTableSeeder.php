<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Exception;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin','user'];
        
        foreach($roles as $role) {
            try {
                $role = Role::create(['name' => $role, 'guard_name' => 'web']);
                echo $role->name . ' Created' . PHP_EOL;
            } catch (Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }
}
