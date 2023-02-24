@extends('Layout.layout')
@section('content')

<div class="container text-center my-5">
    <h1 class="my-4 display-3 fw-bold ls-tight">{{$proyecto->nombre}}</h1>
  
    <h3 class="my-3">{{$proyecto->descripcion}}</h3>
  
    <div class="my-5">
      <button class="btn btn-primary mx-4">Descargar</button>
      <button class="btn btn-secondary mx-4">Compartir</button>
    </div>
  
    <div class="my-4">
      <h4 class="fw-bold">{{$proyecto->como}}</h4>
    </div>
  
    <hr>
  
    <div class="row mt-5">
      <div class="col-md-12 mb-5">
        <h4 class="fw-bold">Vista previa</h4>
        <div class="preview-box bg-light p-3">
          <!-- Aquí va la vista previa -->
        </div>
      </div>
      <br>
      <div class="col-md-12 ">
        <h4 class="fw-bold">Código principal</h4>
        <div class="code-box bg-light p-3">
          <!-- Aquí va el código principal -->
        </div>
        <br>
        <h4 class="fw-bold mt-4">Código secundario</h4>
        <div class="code-box bg-light p-3">
          <!-- Aquí va el código secundario -->
        </div>
      </div>
    </div>
  </div>
  
<style>
    footer {
        display: none;
    }

</style>

@endsection
