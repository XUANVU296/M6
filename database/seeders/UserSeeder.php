<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = new User();
        $item->name = "Lê Chí Bảo";
        $item->email = "lechibaovlog123@gmail.com";
        $item->password = Hash::make('123456');
        $item->image ='a26.jpg';
        $item->group_id ='10';
        // $item->phone ='013456789';

        // $item->image ='thang.ipg';
        $item->save();
    }
}
