<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        User::create([
            'name' => 'Diego',
            'apepat' => 'Chavez',
            'apemat' => 'Ramos',
            
        
            'email' => 'Diego@gmail.com',
            'password' => bcrypt('diego123'),
        ]);
        */
        $user1 = User::firstOrCreate([
            'email' => 'Diego@gmail.com',
         
        ]);

        $adminRole = Role::firstOrCreate(['name' => 'administrador']);

        $user1->assignRole($adminRole);
        $user1->save();

        $user2 = User::firstOrCreate([
            'email' => 'Usuario1@gmailcom',
         
        ]);

        $adminRole = Role::firstOrCreate(['name' => 'mesero']);

        $user2->assignRole($adminRole);
        $user2->save();
    }
   
}
