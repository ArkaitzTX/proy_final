@extends('Layout.layout')
@section('content')

{{-- CONEXIONES --}}
<link rel="stylesheet" href="{{asset('css/nuevo.css')}}">

<main class="container my-3 d-flex flex-column align-items-start">
    <form action="{{ route('nuevoCrear') }}" method="post" enctype="multipart/form-data">
      @csrf
      {{-- INFORMACION PROYECTO --}}

      <h1 class="text-primary text-center my-5">Crea un nuevo proyecto</h1>
<section class="my-3">
    <label class="form-label">Nombre:</label>
    <input type="text" name="nombre" class="form-control validar">
    <label class="form-label">Descripción:</label>
    <textarea cols="30" rows="10" name="descripcion" class="form-control validar"></textarea>
    <label class="form-label">Explicación:</label>
    <textarea cols="30" rows="10" name="como" class="form-control"></textarea>
    <label class="form-label">Imagen:</label>
    <input type="file" name="img" class="form-control">
</section>
{{-- CODIGO --}}
<section id="codigo" class="my-3">
    <select name="tipo" id="tipo" class="form-select ">
    </select>
    {{-- PRINCIPAL --}}
    <article id="principal" class="my-3 rounded"></article>
    <label class="form-label" for="subir_principal">Subir archivo:</label>
    <input type="file" id="subir_principal" class="form-control mb-3">
    <div class="form-check mb-3">
        <input type="checkbox" id="check_vp" name="vista_prev" class="form-check-input">
        <label class="form-check-label" for="check_vp">Activar vista previa</label>
    </div>
    <section id="vp">
        {{-- SECUNDARIO --}}
        <article id="secundario" class="my-3 rounded"></article>
        <label class="form-label" for="subir_secundario">Subir archivo:</label>
        <input type="file" id="subir_secundario" class="form-control mb-3">
        {{-- VISTA --}}
        <iframe id="vista" class="my-3" style="min-height: 300px;"></iframe>
    </section>
</section>
{{-- ENVIAR --}}
<input type="text" id="archivo1" name="archivo1" hidden>
<input type="text" id="archivo2" name="archivo2" hidden>
<button type="submit" id="enviar" class="btn btn-primary my-3">Enviar</button>

</form>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>
<script src="https://ace.c9.io/build/src/ext-language_tools.js"></script>
<script src="{{asset('js/nuevo.js')}}"></script>

@endsection
