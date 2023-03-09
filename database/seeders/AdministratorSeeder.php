<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Administrator;

use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    public function run()
    {
        $administrator = new Administrator();
        $administrator->name = "João Silva";
        $administrator->email = "joao@hxy.com";
        $administrator->password = Hash::make('123');
        $administrator->save();
    }
}

