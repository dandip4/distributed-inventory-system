<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::connection('master')->create('master_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code', 50)->unique();
            $table->string('product_name', 255);
            $table->foreignId('category_id')->constrained('master_categories');
            $table->foreignId('unit_id')->constrained('master_units');
            $table->integer('min_stock')->default(0);
            $table->integer('max_stock')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection('master')->dropIfExists('master_products');
    }
};
