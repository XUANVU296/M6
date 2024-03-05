<?php
namespace Database\Seeders;
use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->importGroups();
        $this->importRoles();
        $this->importRole();
        $this->importGroupRole();
        // $this->call(UserSeeder::class);
    }
    public function importRoles()
    {
        $groups = ['Category', 'User','Product','Group'];
        $actions = ['viewAny', 'view', 'create', 'update', 'delete', 'restore', 'forceDelete','viewtrash'];
        foreach ($groups as $group) {
            foreach ($actions as $action) {
                DB::table('roles')->insert([
                    'name' => $group . '_' . $action,
                    'group_name' => $group,
                ]);
            }
        }
    }
    public function importRole()
    {
        $groups = ['Customer', 'Order'];
        $actions = ['viewAny', 'view'];
        foreach ($groups as $group) {
            foreach ($actions as $action) {
                DB::table('roles')->insert([
                    'name' => $group . '_' . $action,
                    'group_name' => $group,
                ]);
            }
        }
    }
    public function importGroupRole()
    {
        for ($i = 10; $i <= 66; $i++) {
            DB::table('group_roles')->insert([
                'group_id' => 10,
                'role_id' => $i,
            ]);
        }
    }
    public function importGroups()
    {
        $userGroup = new Group();
        $userGroup->name = 'Supper Admin';
        $userGroup->save();
        $userGroup = new Group();
        $userGroup->name = 'Quản Lý';
        $userGroup->save();
        $userGroup = new Group();
        $userGroup->name = 'Giám Đốc';
        $userGroup->save();
        $userGroup = new Group();
        $userGroup->name = 'Nhân Viên';
        $userGroup->save();
    }
}
