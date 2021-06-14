<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder{

    public function run(){
       $user = new user;
       $user->firstname = 'Funmilola';
       $user->lastname = 'Adeoti';
       $user->email = 'funmiadeoti@gmail.com';
       $user->password = Hash::make('mypassword');
       $user->telephone = '+2348162340162';
       $user->admin = '1';
       $user->save();

    }
}