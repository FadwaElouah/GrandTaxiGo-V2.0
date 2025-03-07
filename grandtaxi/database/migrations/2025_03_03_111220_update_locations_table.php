<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('locations', function (Blueprint $table) {
        $table->decimal('latitude', 10, 8)->nullable()->change();
        $table->decimal('longitude', 11, 8)->nullable()->change();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('locations', function (Blueprint $table) {
        $table->decimal('latitude', 10, 8)->nullable(false)->change();
        $table->decimal('longitude', 11, 8)->nullable(false)->change();
    });
}

};
