<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateImageDefaultInDestinations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First, update any existing NULL values to use the default
        DB::statement("UPDATE destinations SET image = 'placeholder.jpg' WHERE image IS NULL");
        
        // Then alter the column to set the default value
        DB::statement("ALTER TABLE destinations MODIFY image VARCHAR(255) DEFAULT 'placeholder.jpg'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE destinations MODIFY image VARCHAR(255) NOT NULL");
    }
}
