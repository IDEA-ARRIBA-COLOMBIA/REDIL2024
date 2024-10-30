<div class="row g-2">
  <div class="col-12 offset-md-3 col-md-6 mb-4">
    <div class="input-group input-group-merge ">
      <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
      <input wire:model.live.debounce.30ms="busqueda" type="text" class="form-control" placeholder="Buscar integrante por nombre, email, identificación" aria-label="Buscar grupo" aria-describedby="basic-addon-search31" spellcheck="false" data-ms-editor="true">
    </div>
  </div>
    @if($integrantes->count() > 0)

      @foreach($integrantes as $integrante)
        <div class="col-12 col-md-12 d-none">
          <div class="p-2 border rounded">
            <div class="d-flex align-items-start">
              <div class="d-flex align-items-start">
                <div class="avatar avatar-md me-2 my-auto">
                  <img src="{{ $configuracion->version == 1 ? Storage::url($configuracion->ruta_almacenamiento.'/img/foto-usuario/'.$integrante->foto) : $configuracion->ruta_almacenamiento.'/img/foto-usuario/'.$integrante->foto }}" alt="Avatar" class="rounded-circle" />
                </div>
                <div class="me-2 ms-1">
                  <h6 class="mb-0">{{ $integrante->nombre(3) }}</h6>
                  <small class="text-muted"><i class="ti {{ $integrante->tipoUsuario->icono }} text-heading fs-6"></i> {{ $integrante->tipoUsuario->nombre}}</small>

                  <div class="mt-2">
                    @if($integrante->tipoUsuario->seguimiento_actividad_grupo==FALSE)
                      <span class="badge bg-label-secondary">No seguimiento grupos</span>
                    @else
                      @if($integrante->estadoActividadGrupos())
                      <span class="badge bg-label-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Último reporte {{$integrante->ultimo_reporte_grupo}}">Activo grupo</span>
                      @else
                      <span class="badge bg-label-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Último reporte {{$integrante->ultimo_reporte_grupo}}">Inactivo grupo</span>
                      @endif
                    @endif

                    @if($integrante->tipoUsuario->seguimiento_actividad_reunion==FALSE)
                      <span class="badge bg-label-secondary">No seguimiento en reuniónes</span>
                    @else
                      @if($integrante->estadoActividadReuniones())
                      <span class="badge bg-label-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Último reporte {{$integrante->ultimo_reporte_reunion}}">Activo reuniones</span>
                      @else
                      <span class="badge bg-label-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Último reporte {{$integrante->ultimo_reporte_reunion}}">Inactivo reuniones</span>
                      @endif
                    @endif
                  </div>

                </div>
              </div>

              <div class="ms-auto pt-1 my-auto">
                @if($rolActivo->hasPermissionTo('personas.lista_asistentes_todos'))
                <a href="{{ route('usuario.perfil', $integrante) }}" target="_blank" class="text-body" data-bs-toggle="tooltip" aria-label="Ver perfil" data-bs-original-title="Ver perfil">
                  <i class="ti ti-user-check me-2 ti-sm"></i></a>
                </a>
                @endif
              </div>
            </div>
          </div>
        </div>


        <div class="col-xl-4 col-lg-6 col-md-6">
          <div class="card border rounded">
            <div class="card-body ">
              <div class="dropdown btn-pinned border rounded p-1">
                <a href="{{ route('usuario.perfil', $integrante) }}" target="_blank" class="text-body" data-bs-toggle="tooltip" aria-label="Ver perfil" data-bs-original-title="Ver perfil">
                  <i class="ti ti-user-check m-1 ti-sm"></i>
                </a>
              </div>
              <div class="avatar avatar-xl mx-auto my-3">
                <img src="{{ $configuracion->version == 1 ? Storage::url($configuracion->ruta_almacenamiento.'/img/foto-usuario/'.$integrante->foto) : $configuracion->ruta_almacenamiento.'/img/foto-usuario/'.$integrante->foto }}" alt="foto {{$integrante->primer_nombre}}" class="rounded-circle" />
              </div>
              <h5 class="mb-1 card-title text-center">{{ $integrante->primer_nombre}} {{ $integrante->segundo_nombre ? $integrante->segundo_nombre : ''}} {{ $integrante->primer_apellido }}</h5>

              <p class="pb-1 text-center">
                <span class="badge" style="background-color: {{$integrante->tipoUsuario->color}}">
                <i class="{{ $integrante->tipoUsuario->icono }} fs-6 mx-1"></i> {{ $integrante->tipoUsuario->nombre }} </span>
              </p>

              @if(isset($integrante->tipoUsuario->id))

              <div class="row mt-4 mb-4 g-3">

                @if($integrante->tipoUsuario->seguimiento_actividad_grupo==FALSE)
                  <div class="col-12 col-sm-12">
                    <div class="d-flex">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-secundary"><i class="ti ti-users-group ti-28px text-black"></i></span>
                      </div>
                      <div>
                        <small>Grupo</small>
                        <h6 class="mb-0 text-nowrap">No seguimiento en grupos</h6>
                      </div>
                    </div>
                  </div>
                @else
                  @if($integrante->estadoActividadGrupos())
                  <div class="col-12 col-sm-12">
                    <div class="d-flex">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-users-group ti-28px"></i></span>
                      </div>
                      <div>
                        <small>Grupo</small>
                        <h6 class="mb-0 text-nowrap">Activo</h6>
                      </div>
                    </div>
                  </div>
                  @else
                  <div class="col-12 col-sm-12">
                    <div class="d-flex">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-danger"><i class="ti ti-users-group ti-28px"></i></span>
                      </div>
                      <div>
                        <small>Grupo</small>
                        <h6 class="mb-0 text-nowrap">Inactivo desde hace 2 semanas</h6>
                      </div>
                    </div>
                  </div>
                  @endif
                @endif

                @if($integrante->tipoUsuario->seguimiento_actividad_reunion==FALSE)
                  <div class="col-12 col-sm-12">
                    <div class="d-flex">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-secundary"><i class="ti ti-building-church ti-28px text-black"></i></span>
                      </div>
                      <div>
                        <small>Reuniones</small>
                        <h6 class="mb-0 text-nowrap">No seguimiento en reuniones</h6>
                      </div>
                    </div>
                  </div>
                @else
                  @if($integrante->estadoActividadReuniones())
                  <div class="col-12 col-sm-12">
                    <div class="d-flex">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-building-church ti-28px"></i></span>
                      </div>
                      <div>
                        <small>Reuniones</small>
                        <h6 class="mb-0 text-nowrap">Activo</h6>
                      </div>
                    </div>
                  </div>
                  @else
                  <div class="col-12 col-sm-12">
                    <div class="d-flex">
                      <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-danger"><i class="ti ti-building-church ti-28px"></i></span>
                      </div>
                      <div>
                        <small>Reuniones</small>
                        <h6 class="mb-0 text-nowrap">Inactivo desde  {{ Carbon\Carbon::parse($integrante->ultimo_reporte_reunion)->format('Y-m-d') }} </h6>
                      </div>
                    </div>
                  </div>
                  @endif
                @endif

                <div class="col-12 col-sm-12">
                  <div class="d-flex">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-school ti-28px"></i></span>
                    </div>
                    <div>
                      <small>Cursando actualmente</small>
                      <h6 class="mb-0 text-nowrap">Camino hacia la libertad</h6>
                    </div>
                  </div>
                </div>
              </div>
              @endif

            </div>
          </div>
        </div>
        @endforeach
      @elseif($busqueda == '')
        <div class="py-4 border rounded mt-2">
          <center>
            <i class="ti ti-users ti-xl pb-1"></i>
            <h6 class="text-center">¡Ups! este grupo no posee integrantes.</h6>
            @if($rolActivo->hasPermissionTo('grupos.pestana_anadir_integrantes_grupo'))
              <a href="{{ route('grupo.gestionarIntegrantes',$grupo) }}" target="_blank" class="btn btn-primary pendiente" data-bs-toggle="tooltip" aria-label="Gestionar integrantes" data-bs-original-title="Este grupo no tiene integrantes, agrégalos aquí">
                <i class="ti ti-user-plus me-2 ti-sm"></i> Gestionar integrantes
              </a>
            @endif
          </center>
        </div>
      @else
        <div class="py-4 border rounded mt-2">
          <center>
            <i class="ti ti-search ti-xl pb-1"></i>
            <h6 class="text-center">¡Ups! la busqueda no arrojo ningun resultado.</h6>
          </center>
        </div>
      @endif
</div>
