@extends('Layout.layout')
@section('content')

<link rel="stylesheet" href="{{asset('css/proyecto.css')}}">

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="d-flex flex-column w-75 sticky-xl-top mb-4" style="top: 155px">
                <img src="{{url("/images/usuarios/".$usuario->img)}}"
                    alt="{{$usuario->img}}" class="rounded-circle mx-auto" style="width: 125px; height: 125px; object-fit: cover;">

                <form method="POST" action="{{ route('actualizarPefil', $usuario->id) }}"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="" aria-describedby="helpId"
                            placeholder="{{$usuario->nombre}}">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Contraseña</label>
                        <input type="text" class="form-control" name="pass" id="" aria-describedby="helpId"
                            placeholder="{{$usuario->pass}}">
                    </div>

                    <div class="mb-4 d-grid gap-2">
                        <label for="" class="form-label">Foto de perfil</label>
                        <input class="form-control" type="file" name="img">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary block mb-3">Actualizar información
                            personal</button>
                        <a class="btn btn-outline-primary block" href="{{ route('logout') }}" role="button">Cerrar sesion</a>
                        @if ($usuario->admin)
                            <a class="btn btn-outline-primary block" href="{{ route('admin') }}" role="button">Administracion</a>    
                        @endif
                    </div>
            </div>

            </form>

            <div class="bg-primary w-75">

            </div>
        </div>
        <div class="col">

            <div class="d-flex flex-wrap">

              @if(count($usuario->proyectos) === 0)
                  <h1>NO EXISTEN PROYECTOS</h1>
              @endif
              @foreach ($usuario->proyectos as $proyecto)

                <div id="tarjetaproy" class="container mb-4" style="padding-left: 12px;">
                    <div class="bg-dark border rounded border-0 border-dark overflow-hidden">
                        <div class="row g-0">
                            <div class="col-md-6 order-first order-md-last">
                                <div class="text-white p-4 p-md-5">
                                    <h2 class="fw-bold text-white mb-3">{{ $proyecto->nombre }}</h2>
                                    <p class="mb-4">{{ $proyecto->descripcion }}</p>
                                    <div class="my-3">
                                        <a class="btn btn-primary btn-lg" role="button" href="{{ route('ver', $proyecto->id) }}">Ver</a>
                                        <br><br>
                                        <a class="btn btn-warning" href="{{ route('proyedit',  $proyecto->id)}}">Editar</a>
                                        <a class="btn btn-danger" role="button" href="{{ route('borrarProyecto', $proyecto->id) }}">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                            <div id="contenedor" class="col-md-6" style="min-height: 250px;">
                                <div class="bg-dark text-light rounded" id="tipo">
                                  {{
                                    array('css', 'js', 'json')[$proyecto->tipo-1];
                                  }}
                                </div>
                                <img class="w-100 h-100 fit-cover" src="{{asset('/proyectos/images/' . $proyecto->img)}}">
                            </div>
                        </div>
                    </div>
                </div>

              @endforeach

            </div>

        </div>
    </div>
</div>

<div class="d-flex justify-content-around flex-wrap">



</div>

</div>

<style>
    footer {
        display: none;
    }

</style>

@endsection
