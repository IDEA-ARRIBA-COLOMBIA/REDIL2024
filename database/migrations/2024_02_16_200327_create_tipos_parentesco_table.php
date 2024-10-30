<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipos_parentesco', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->smallinteger('relacionado_con')->nullable();
            $table->string('nombre_masculino',100)->nullable();
            $table->string('nombre_femenino',100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_parentesco');
    }
};
