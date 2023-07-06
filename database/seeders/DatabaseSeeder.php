<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Webkul\Velocity\Database\Seeders\VelocityMetaDataSeeder;
use Webkul\Admin\Database\Seeders\DatabaseSeeder as BagistoDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Drop all tables
//        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//        foreach(DB::select('SHOW TABLES') as $table) {
//            $table_array = get_object_vars($table);
//            Schema::drop($table_array[key($table_array)]);
//        }
//        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Run your seeders
        $this->call(BagistoDatabaseSeeder::class);
        $this->call(VelocityMetaDataSeeder::class);

        // Import db.sql file to database
//        $sql = file_get_contents(__DIR__ . '/db.sql');

//        DB::unprepared($sql);
    }
}
