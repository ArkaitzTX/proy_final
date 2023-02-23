@extends('Layout.layout')
@section('content')

<div class="container mt-5">
    <div class="row">
      <div class="col">
        <div class="d-flex flex-column w-75 sticky-xl-top mb-4" style="top: 155px">
            <img src="{{url("/images/fotosPerfil/".session()->get('usuario')->img)}}" alt="{{session()->get('usuario')->img}}" class="rounded-circle mx-auto" style="width: 125px;">
            
            <form method="POST" action="{{ route('actualizarPefil', session()->get('usuario')->id) }}">                
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="" class="form-label">Nombre</label>
              <input type="text"
                class="form-control" name="nombre" id="" aria-describedby="helpId" placeholder="{{session()->get('usuario')->nombre}}">
            </div>
        
            <div class="mb-3">
                <label for="" class="form-label">Contraseña</label>
                <input type="text"
                  class="form-control" name="pass" id="" aria-describedby="helpId" placeholder="{{session()->get('usuario')->pass}}">
              </div>
        
              <div class="mb-4 d-grid gap-2">
                <label for="" class="form-label">Foto de perfil</label>
                    <input class="form-control" type="file" name="image">
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary block mb-3">Actualizar información personal</button>
                <a name="" id="" class="btn btn-outline-primary block" href="#" role="button">Administracion</a>
            </div>
            </div>

            </form>
        
            <div class="bg-primary w-75">
        
            </div>
      </div>
      <div class="col">
        
        <div class="d-flex flex-wrap">

            @foreach (session()->get('usuario')->proyectos as $proyecto)
                
            <div class="container mb-4" style="padding-left: 12px;">
                <div class="bg-dark border rounded border-0 border-dark overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-6 order-first order-md-last">
                            <div class="text-white p-4 p-md-5">
                                <h2 class="fw-bold text-white mb-3">{{ $proyecto->nombre }}</h2>
                                <p class="mb-4">{{ $proyecto->descripcion }}</p>
                                <div class="my-3">
                                    <a class="btn btn-primary btn-lg me-2" role="button" href="#">Ver</a>
                                    <a class="btn btn-danger btn-lg" role="button" href="{{ route('borrarProyecto', $proyecto->id) }}">Eliminar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="min-height: 250px;">
                            <img class="w-100 h-100 fit-cover" src="'/proyectos/images/' . {{$proyecto->img}}">
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

<style>footer{display: none;}</style>

@endsection
