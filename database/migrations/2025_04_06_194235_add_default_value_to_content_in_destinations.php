<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddDefaultValueToContentInDestinations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First, update any existing NULL content to use the description
        DB::statement('UPDATE destinations SET content = description WHERE content IS NULL');
        
        // Then alter the column to set a default empty string
        DB::statement('ALTER TABLE destinations ALTER COLUMN content SET DEFAULT ""');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE destinations ALTER COLUMN content DROP DEFAULT');
    }
}
