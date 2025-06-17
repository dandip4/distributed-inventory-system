<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::connection('master')->create('master_units', function (Blueprint $table) {
            $table->id();
            $table->string('unit_name', 50);
            $table->string('unit_symbol', 10);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection('master')->dropIfExists('master_units');
    }
};
