<?php

namespace Database\Seeders;

use App\Models\EstadoPasoCrecimientoUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoPasoCrecimientoUsuarioSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    EstadoPasoCrecimientoUsuario::create([
      'nombre' => 'No Realizado',
      'color' => 'danger',
      'puntaje' => 0
    ]);

    EstadoPasoCrecimientoUsuario::create([
      'nombre' => 'En proceso',
      'color' => 'warning',
      'puntaje' => 1
    ]);

    EstadoPasoCrecimientoUsuario::create([
      'nombre' => 'Finalizado',
      'color' => 'success',
      'puntaje' => 2
    ]);
  }
}
