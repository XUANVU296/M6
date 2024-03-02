<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = ['categories', 'products', 'orders', 'groups', 'order_defails', 'customers', 'users'];
        $actions = ['viewAny', 'view', 'create', 'update', 'delete', 'restore', 'forceDelete','viewtrash'];

        foreach ($tables as $table) {
            foreach ($actions as $action) {
                $item = new Role();
                $item->name = $table . '_' . $action;
                $item->group_name = $table;
                $item->timestamps = false; // Vô hiệu hóa timestamps

                $item->save();
            }
        }
    }
}
