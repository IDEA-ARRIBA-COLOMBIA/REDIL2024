<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('tipo_servicio_grupos', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->string('nombre', 50);
      $table->string('descripcion', 200)->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tipo_servicio_grupos');
  }
};
