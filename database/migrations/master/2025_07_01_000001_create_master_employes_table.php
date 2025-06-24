<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::connection('master')->create('master_employes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::connection('master')->dropIfExists('master_employes');
    }
};
