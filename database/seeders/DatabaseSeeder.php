<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Model::unguard();
        Schema::disableForeignKeyConstraints();

        DB::table('users')->truncate();
        User::factory(3)->create();
        
        DB::table('school_classes')->truncate();
        SchoolClass::factory(5)->create();
        
        DB::table('students')->truncate();
        Student::factory(10)->create();


        Schema::enableForeignKeyConstraints();
        Model::reguard();
    }
}
