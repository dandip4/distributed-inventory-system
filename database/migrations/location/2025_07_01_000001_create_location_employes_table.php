<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::connection('location')->create('location_employes', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('position')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::connection('location')->dropIfExists('location_employes');
    }
};
