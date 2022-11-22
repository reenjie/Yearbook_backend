<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create([  'id' => 1,
                        'Name' => 'Admin',
                        'Description'   => 'System moderator']);
                        
        Role::create([
                        'id' => 1,
                        'Name' => 'Instructor',
                        'Description'   => 'Section and batch adviser']);
                                        
        Role::create([  'id' => 1,
                        'Name' => 'Students',
                        'Description'   => 'Graduates']);
    }
}
