@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Perfil del grupo')

<!-- Page -->
@section('page-style')
@vite([
'resources/assets/vendor/scss/pages/page-profile.scss',
'resources/assets/vendor/libs/select2/select2.scss',
'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
'resources/assets/vendor/libs/apex-charts/apex-charts.scss',
])
@endsection

@section('vendor-script')
@vite([
'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',
'resources/assets/vendor/libs/select2/select2.js',
'resources/assets/vendor/libs/flatpickr/flatpickr.js',
'resources/assets/vendor/libs/apex-charts/apexcharts.js',
])
@endsection

@section('page-script')
<script type="module">
  let cardColor, headingColor, labelColor, borderColor, legendColor;

  if (isDarkStyle) {
    cardColor = config.colors_dark.cardColor;
    headingColor = config.colors_dark.headingColor;
    labelColor = config.colors_dark.textMuted;
    legendColor = config.colors_dark.bodyColor;
    borderColor = config.colors_dark.borderColor;
  } else {
    cardColor = config.colors.cardColor;
    headingColor = config.colors.headingColor;
    labelColor = config.colors.textMuted;
    legendColor = config.colors.bodyColor;
    borderColor = config.colors.borderColor;
  }

  const chartColors = {
    column: {
      series1: '#826af9',
      series2: '#d2b0ff',
      bg: '#f8d3ff'
    },
    donut: {
      series1: '#fee802',
      series2: '#3fd0bd',
      series3: '#826bf8',
      series4: '#2b9bf4'
    },
    area: {
      series1: '#29dac7',
      series2: '#60f2ca',
      series3: '#a5f8cd'
    }
  };

  // grafico ultimos reportes
  const graficoUltimosReportes = document.querySelector('#graficoUltimosReportes'),
    dataReportesReunion = JSON.parse(<?php print json_encode(json_encode($dataUltimosReportes)); ?>),
    serieReporesReunion = JSON.parse(<?php print json_encode(json_encode($serieUltimosReportes)); ?>),
    graficoUltimosReportesConfig = {
      chart: {
        height: 400,
        type: 'area',
        parentHeightOffset: 0,
        toolbar: {
          show: false
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: false,
        curve: 'straight'
      },
      legend: {
        show: true,
        position: 'top',
        horizontalAlign: 'start',
        labels: {
          colors: legendColor,
          useSeriesColors: false
        }
      },
      grid: {
        borderColor: borderColor,
        xaxis: {
          lines: {
            show: true
          }
        }
      },
      colors: [chartColors.area.series1],
      series: [{
        name: 'Asistencias',
        data: dataReportesReunion
      }, ],
      xaxis: {
        categories: serieReporesReunion,
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px'
          }
        }
      },
      yaxis: {
        min: 0,
        labels: {
          formatter: function(val) {
            return val.toFixed(0)
          },
          style: {
            colors: labelColor,
            fontSize: '13px'
          }
        }
      },


      fill: {
        opacity: 1,
        type: 'solid'
      },
      tooltip: {
        shared: false
      }
    };
  if (typeof graficoUltimosReportes !== undefined && graficoUltimosReportes !== null) {
    let areaChartUltimosReportes = new ApexCharts(graficoUltimosReportes, graficoUltimosReportesConfig);
    areaChartUltimosReportes.render();
  }
  // grafico ultimos reportes

  // grafico promedios de asistencia
  const graficoPromedioAsistenciaMensual = document.querySelector('#graficoPromedioAsistenciaMensual'),
    dataPromedioAsistenciaMensual = JSON.parse(<?php print json_encode(json_encode($dataUltimosMeses)); ?>),
    seriePromedioAsistenciaMensual = JSON.parse(<?php print json_encode(json_encode($serieUltimosMeses)); ?>),
    graficoPromedioAsistenciaMensualConfig = {
      series: [{
          name: 'Promedio asistencias',
          data: dataPromedioAsistenciaMensual
        }
      ],

      annotations: {
        yaxis: [{
            y: '{{$grupo->asistentes()->count()}}',
            borderColor: '#00E396',
            label: {
              borderColor: '#00E396',
              style: {
                color: '#fff',
                background: '#00E396',
              },
              text: 'Total integrantes: {{$grupo->asistentes()->count()}}',
            }
          }]
      },
      colors: [chartColors.donut.series4],
      chart: {
        type: 'bar',
        height: 400,
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '55%',
          endingShape: 'rounded'
        },
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      xaxis: {
        categories: seriePromedioAsistenciaMensual,
      },
      fill: {
        opacity: 1
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return "" + val + " "
          }
        }
      },
    };
  if (typeof graficoPromedioAsistenciaMensual !== undefined && graficoPromedioAsistenciaMensual !== null) {
    let areaChartPromedioAsistenciaMensual = new ApexCharts(graficoPromedioAsistenciaMensual, graficoPromedioAsistenciaMensualConfig);
    areaChartPromedioAsistenciaMensual.render();
  }
  // grafico promedios de asistencia
</script>

<script>
  function darBajaAlta(grupoId, tipo)
  {
    Livewire.dispatch('abrirModalBajaAlta', { grupoId: grupoId, tipo: tipo });
  }

  function eliminacion(grupoId)
  {
    Livewire.dispatch('confirmarEliminacion', { grupoId: grupoId });
  }
</script>
@endsection

@section('content')
<div class="d-flex mb-4">
  <div class="p-2 flex-grow-1 bd-highlight">
  </div>
  <div class="flex-shrink-1 ">
    <div class="dropdown d-flex border rounded py-2 px-4 ">
      <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false">Opciones <i class="ti ti-dots-vertical text-muted"></i></button>
      <ul class="dropdown-menu dropdown-menu-end">
        @if($grupo->dado_baja == 0)
          @if($rolActivo->hasPermissionTo('grupos.opcion_modificar_grupo'))
            <li><a class="dropdown-item" href="{{ route('grupo.modificar', $grupo)}}">Modificar</a></li>
          @endif

          @if($rolActivo->hasPermissionTo('grupos.opcion_excluir_grupo'))
            <form id="excluirGrupo" method="POST" action="{{ route('grupo.excluir', ['grupo' => $grupo]) }}">
              @csrf
              <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('excluirGrupo').submit();" >Excluir grupo</a></li>
            </form>
          @endif

          @if($rolActivo->hasPermissionTo('grupos.opcion_dar_de_baja_alta_grupo'))
            <li><a class="dropdown-item" href="javascript:void(0);" onclick="darBajaAlta('{{$grupo->id}}', 'baja')">Dar de baja</a></li>
          @endif

          @if($rolActivo->hasPermissionTo('grupos.opcion_eliminar_grupo'))
          <li><a class="dropdown-item" href="javascript:void(0);" onclick="eliminacion('{{$grupo->id}}')">Eliminar</a></li>
          @endif
        @else
          @if($rolActivo->hasPermissionTo('grupos.opcion_dar_de_baja_alta_grupo'))
            <li><a class="dropdown-item" href="javascript:void(0);" onclick="darBajaAlta('{{$grupo->id}}', 'alta')">Dar de alta</a></li>
          @endif
        @endif
      </ul>
    </div>
  </div>
</div>

<div class="d-flex flex-column  text-center">
  <div class="px-1">
    <button class="btn rounded-pill btn-icon btn-primary waves-effect waves-light btn-xl"><i class="ti ti-users-group ti-xl mx-2"></i></button>
  </div>
  <h4 class="mb-1">{{ $grupo->nombre }}</h4>
  <p class="mb-4">{{ $grupo->tipoGrupo ? $grupo->tipoGrupo->nombre : 'Tipo de grupo no indicado' }}</p>
</div>

@include('layouts.status-msn')
@livewire('Grupos.modal-baja-alta-grupo')

  <div id="div-principal" class="row">

    <div class="col-12">

    </div>

    <div class="col-lg-6 col-md-6">
      <!-- Georreferencia -->
      <div class="card mb-4">
        <div class="card-body pb-3">
          @if( $grupo->latitud )
          <iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{$grupo->latitud}},{{$grupo->longitud}}&hl=es&z=14&amp;output=embed">
          </iframe>
          @else
            <div class="py-5 border rounded">
              <center>
                <i class="ti ti-brand-google-maps ti-xl pb-1"></i>
                <h6 class="text-center">¡Ups! no se puede mostrar el mapa debido a que no se ha asignado la georrefencia.</h6>
                @if($rolActivo->hasPermissionTo('grupos.pestana_georreferencia_grupo'))
                <a href="{{ route('grupo.georreferencia',$grupo) }}" target="_blank" class="btn btn-primary pendiente" data-bs-toggle="tooltip" aria-label="Agregar georeferencia" data-bs-original-title="Este grupo no está ubicado en el mapa, por favor agrega la ubicación aquí">
                  <i class="ti ti-map-pin-plus me-2 ti-sm"></i> Agregar georreferencia
                </a>
                @endif
              </center>
            </div>
          @endif

          <div class="row mt-4 mb-4 g-3">

            <div class="col-6">
              <div class="d-flex">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-calendar-event ti-28px"></i></span>
                </div>
                <div>
                  <small>Día de reunión</small>
                  <h6 class="mb-0 text-nowrap">{{ Helper::obtenerDiaDeLaSemana($grupo->dia) ? Helper::obtenerDiaDeLaSemana($grupo->dia) : 'Día no indicado' }}</h6>
                </div>
              </div>
            </div>

            <div class="col-6">
              <div class="d-flex">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-clock ti-28px"></i></span>
                </div>
                <div>
                  <small>Hora de reunión</small>
                  <h6 class="mb-0 text-nowrap">{{ Carbon\Carbon::parse($grupo->hora)->format(('g:i a')) }}</h6>
                </div>
              </div>
            </div>

            <div class="col-6">
              <div class="d-flex">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-primary"><i class="ti ti ti-user ti-28px"></i></span>
                </div>
                <div>
                  <small>Cantidad de integrantes:</small>
                  <h6 class="mb-0 text-nowrap">{{ $grupo->asistentes()->select('users.id')->count() }}</h6>
                </div>
              </div>
            </div>

            <div class="col-6">
              <a href="{{ route('grupo.graficoDelMinisterio', ['idNodo' => 'G-'.$grupo->id]  ) }}" target="_blank" class="" data-bs-toggle="tooltip" aria-label="Ver gráfico ministerial " data-bs-original-title="Ver gráfico ministerial">
                <div class="d-flex">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-sitemap ti-28px"></i></span>
                  </div>
                  <div>
                    <small>Ver gráfico<br> ministerial</small>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-6">
              <div class="d-flex">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-primary"><i class="ti ti ti-home ti-28px"></i></span>
                </div>
                <div>
                  <small>Sede:</small>
                  <h6 class="mb-0 text-nowrap">{{ $grupo->sede ? $grupo->sede->nombre : 'Sin dato'}}</h6>
                </div>
              </div>
            </div>

            <div class="col-6">
              <div class="d-flex">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-phone ti-28px"></i></span>
                </div>
                <div>
                  <small>Teléfono:</small>
                  <h6 class="mb-0 text-nowrap">{{ $grupo->telefono ? $grupo->telefono : 'Sin dato'}}</h6>
                </div>
              </div>
            </div>

            <div class="col-6">
              <div class="d-flex">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-map ti-28px"></i></span>
                </div>
                <div>
                  <small>Dirección:</small>
                  <h6 class="mb-0 ">{{ $grupo->direccion ? $grupo->direccion : 'Sin dato'}}</h6>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="d-flex">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-point ti-28px"></i></span>
                </div>
                <div>
                  <small>{{$configuracion->label_campo_opcional1}}:</small>
                  <h6 class="mb-0 text-nowrap">{{ $grupo->rhema ? $grupo->rhema : 'Sin dato'}}</h6>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <!-- Georreferencia /-->

      <!-- Encargados -->
      <div class="card mb-4">
        <div class="card-header align-items-center">
          <p class="card-text text-uppercase fw-bold"> Encargados y servidores</p>
        </div>
        <div class="card-body pb-3">

          <ul class="list-unstyled mb-4">
            <small class="card-text text-uppercase">Encargados</small>
            @if($encargados->count() > 0)
              @foreach($encargados as $encargado)
              <li class="mb-1 mt-1 p-2 border rounded">
                <div class="d-flex align-items-start">
                  <div class="d-flex align-items-start">
                    <div class="avatar avatar-md me-2 my-auto">
                      <img src="{{ $configuracion->version == 1 ? Storage::url($configuracion->ruta_almacenamiento.'/img/foto-usuario/'.$encargado->foto) : $configuracion->ruta_almacenamiento.'/img/foto-usuario/'.$encargado->foto }}" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="me-2 ms-1">
                      <h6 class="mb-0">{{ $encargado->nombre(3) }}</h6>
                      <small class="text-muted"><i class="ti {{ $encargado->tipoUsuario->icono }} text-heading fs-6"></i> {{ $encargado->tipoUsuario->nombre}}</small>
                    </div>
                  </div>

                  <div class="ms-auto pt-1 my-auto">
                    @if($rolActivo->hasPermissionTo('personas.lista_asistentes_todos'))
                    <a href="{{ route('usuario.perfil', $encargado) }}" target="_blank" class="text-body" data-bs-toggle="tooltip" aria-label="Ver perfil" data-bs-original-title="Ver perfil">
                      <i class="ti ti-user-check me-2 ti-sm"></i></a>
                    </a>
                    @endif
                  </div>
                </div>
              </li>
              @endforeach
            @else
              <div class="py-4 border rounded mt-2">
                <center>
                  <i class="ti ti-user-star ti-xl pb-1"></i>
                  <h6 class="text-center">¡Ups! este grupo no tiene encargados asignados.</h6>
                  @if($rolActivo->hasPermissionTo('grupos.pestana_anadir_lideres_grupo'))
                  <a href="{{ route('grupo.gestionarEncargados',$grupo) }}" target="_blank" class="btn btn-primary pendiente" data-bs-toggle="tooltip" aria-label="Gestionar encargados" data-bs-original-title="Este grupo no tiene encargados, agrégalos aquí">
                    <i class="ti ti-user-plus me-2 ti-sm"></i> Gestionar encargados
                  </a>
                  @endif
                </center>
              </div>
            @endif
          </ul>

          @if($grupo->tipoGrupo->contiene_servidores)
          <ul class="list-unstyled mb-0">
            <small class="card-text text-uppercase">Servidores</small>
            @if($servidores->count() > 0)
              @foreach($servidores as $servidor)
              <li class="mb-1 mt-1 p-2 border rounded">
                <div class="d-flex align-items-start">
                  <div class="d-flex align-items-start">
                    <div class="avatar avatar-md me-2 my-auto">
                      <img src="{{ $configuracion->version == 1 ? Storage::url($configuracion->ruta_almacenamiento.'/img/foto-usuario/'.$servidor->foto) : $configuracion->ruta_almacenamiento.'/img/foto-usuario/'.$servidor->foto }}" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="me-2 ms-1">
                      <h6 class="mb-0">{{ $servidor->nombre(3) }}</h6>
                      <small class="text-muted"><i class="ti {{ $servidor->tipoUsuario->icono }} text-heading fs-6"></i> {{ $servidor->tipoUsuario->nombre}}</small>
                      <div class="">
                        @if(count($servidor->servicios) > 0)
                          @foreach($servidor->servicios as $servicio)
                          <span class="mt-1 badge rounded-pill bg-label-primary">{{$servicio}}</span>
                          @endforeach
                        @else
                          <span class="mt-1 badge badge rounded-pill bg-label-secondary">No tiene asignado ningun servicio</span>
                        @endif
                      </div>

                    </div>
                  </div>

                  <div class="ms-auto pt-1 my-auto">
                    @if($rolActivo->hasPermissionTo('personas.lista_asistentes_todos'))
                    <a href="{{ route('usuario.perfil', $servidor) }}" target="_blank" class="text-body" data-bs-toggle="tooltip" aria-label="Ver perfil" data-bs-original-title="Ver perfil">
                      <i class="ti ti-user-check me-2 ti-sm"></i></a>
                    </a>
                    @endif
                  </div>
                </div>
              </li>
              @endforeach
            @else
            <div class="py-4 border rounded mt-2">
              <center>
                <i class="ti ti-user-star ti-xl pb-1"></i>
                <h6 class="text-center">¡Ups! este grupo no tiene servidores asignados.</h6>
                @if($rolActivo->hasPermissionTo('grupos.pestana_anadir_lideres_grupo'))
                  <a href="{{ route('grupo.gestionarEncargados',$grupo) }}" target="_blank" class="btn btn-primary pendiente" data-bs-toggle="tooltip" aria-label="Gestionar servidores" data-bs-original-title="Este grupo no tiene servidores, agrégalos aquí">
                    <i class="ti ti-user-plus me-2 ti-sm"></i> Gestionar servidores
                  </a>
                @endif
              </center>
            </div>
            @endif
          </ul>
          @endif
        </div>
      </div>
      <!--/ Encargados -->

      <!-- Más Información -->
     <div class="card mb-4">
        <div class="card-header align-items-center">
          <p class="card-text text-uppercase fw-bold"> Más información </p>
        </div>
        <div class="card-body pb-3">
          <ul class="list-unstyled mb-4 mt-2">

              @if($configuracion->visible_seccion_campos_extra_grupo == TRUE && $rolActivo->hasPermissionTo('grupos.visible_seccion_campos_extra_grupo') )
                @foreach($camposExtras as $campo)
                <li class="d-flex align-items-center mb-1">
                  <i class="ti ti-point "></i>
                  <span class="fw-medium mx-2 text-heading">{{$campo->nombre}}: </span>
                  <span>{{ $campo->valor ? $campo->valor : 'Sin dato'}}</span>
                </li>
                @endforeach
              @endif

              <li class="d-flex align-items-center mb-1">
                <i class="ti ti-confetti"></i>
                <span class="fw-medium mx-2 text-heading">{{ $configuracion->label_fecha_creacion_grupo ? $configuracion->label_fecha_creacion_grupo : 'Fecha de apertura'}}: </span>
                <span>{{ $grupo->fecha_apertura ? $grupo->fecha_apertura : 'Sin dato'}}</span>
              </li>

              <li class="d-flex align-items-center mb-1">
                <i class="ti ti-calendar "></i>
                <span class="fw-medium mx-2 text-heading"> Fecha y hora de creación: </span>
                <span>{{ $grupo->created_at ? $grupo->created_at : 'Sin dato'}}</span>
              </li>

              <li class="d-flex align-items-center mb-1"><i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Creado por:</span> <span>{{ !$grupo->usuarioCreacion ? 'Sin dato' : '' }}</span></li>
              @if($grupo->usuarioCreacion)
              <div class="d-flex align-items-start border rounded-3 p-2">
                <div class="avatar me-2">
                  <img src="{{ $configuracion->version == 1 ? Storage::url($configuracion->ruta_almacenamiento.'/img/foto-usuario/'.$grupo->usuarioCreacion->foto) : Storage::url($configuracion->ruta_almacenamiento.'/img/foto-usuario/'.$grupo->usuarioCreacion->foto) }}" alt="foto {{$grupo->usuarioCreacion->nombre(3)}}" class="rounded-circle">
                </div>
                <div class="me-2 ms-1 ">
                  <h6 class="mb-0">{{ $grupo->usuarioCreacion->nombre(3) }}</h6>
                  <small class="text-muted">{{ $grupo->usuarioCreacion->tipoUsuario->nombre }} </small>
                </div>
              </div>
              @endif

            </ul>
        </div>
      </div>
      <!--/ Más Información -->


    </div>

    <div class="col-lg-6 col-md-6">
      <!-- Grafico de asistencia a reunión -->
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
          <div>
            <h6 class="card-title text-uppercase mb-0 fw-bold">Gráfico asistencias según reportes</h6>
            <small class="text-muted">
              Asistencias de los últimos {{ count($dataUltimosReportes) }} reportes
            </small>
          </div>
        </div>
        <div class="card-body">
          <div id="graficoUltimosReportes"></div>
          @if(count($dataUltimosReportes)>0)
          <center>
            <small class="text-muted">
              Promedio de asistencias: <b> {{ array_sum($dataUltimosReportes)/count($dataUltimosReportes) }}</b>
            </small>
          </center>
          @endif

        </div>
      </div>
      <!-- /Grafico de asistencia a reunión -->

      <!-- Grafico de promedios de asistencia  -->
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
          <div>
            <h6 class="card-title text-uppercase mb-0 fw-bold">Promedios de asistencia mensual</h6>
            <small class="text-muted">
              Promedios de asistencia de los últimos 6 meses
            </small>
          </div>
        </div>
        <div class="card-body">
          <div id="graficoPromedioAsistenciaMensual"></div>

        </div>
      </div>
      <!-- /Grafico de promedios de asistencia  -->
    </div>

    <div class="col-lg-12 col-md-12">
      <!-- Integrantes -->
      <div class="card mb-4">
        <div class="card-header align-items-center">
          <p class="card-text text-uppercase fw-bold"><i class="ti ti-users ms-n1 me-2"></i> Integrantes</p>
        </div>
        <div class="card-body pb-3">

            @livewire('Grupos.listado-integrantes-grupo', [
              'grupo' => $grupo,
            ])

        </div>
      </div>
      <!--/ Integrantes -->
    </div>

  </div>
@endsection
