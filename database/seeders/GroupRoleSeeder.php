<?php

namespace Database\Seeders;

use App\Models\Group_role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group_role::truncate();
        for($i = 37; $i <= 72; $i++){
            $item = new Group_role();
            $item->role_id= $i;
            $item->group_id = 10;
            $item->timestamps = false;
            $item->save();
        }
    }
}
