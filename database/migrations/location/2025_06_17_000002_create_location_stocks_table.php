<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::connection('location')->create('location_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity')->default(0);
            $table->timestamp('last_updated')->useCurrent();
            $table->timestamps();

            $table->unique(['location_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::connection('location')->dropIfExists('location_stocks');
    }
};
