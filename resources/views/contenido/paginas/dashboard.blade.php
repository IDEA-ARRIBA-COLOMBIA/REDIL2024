@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Inicio')

@section('content')
<h4>Home Page {{ auth()->user()->primer_nombre }}</h4>
<p>For more layout options refer <a href="{{ config('variables.documentation') ? config('variables.documentation').'/laravel-introduction.html' : '#' }}" target="_blank" rel="noopener noreferrer">documentation</a>.</p>


  {{ App\Models\TipoGrupo::find(1)->automatizacionesPasosCrecimiento }}

  <hr>
  @foreach (App\Models\CrecimientoUsuario::get() as $x)
  Usuario: {{ $x->user_id }} - Estado: {{ $x->estado_id }} - Paso: {{ $x->paso_crecimiento_id}}<br>

  @endforeach



  <hr>
  @foreach (App\Models\CrecimientoUsuario::where('user_id',11)->get() as $x)
  Usuario: {{ $x->user_id }} - Estado: {{ $x->estado_id }} - Paso: {{ $x->paso_crecimiento_id}}<br>

  @endforeach

@endsection
