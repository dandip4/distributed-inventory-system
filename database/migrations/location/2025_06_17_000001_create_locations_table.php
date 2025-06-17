<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::connection('location')->create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('location_name', 100);
            $table->text('address');
            $table->string('city', 100);
            $table->string('country', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection('location')->dropIfExists('locations');
    }
};
