@extends('Layout.layout')
@section('content')

{{-- CONEXIONES --}}
<link rel="stylesheet" href="{{asset('css/nuevo.css')}}">

<main>
    <form action="{{ route('nuevoCrear') }}" method="post" enctype="multipart/form-data">
        @csrf

        {{-- INFORMACION PROYECTO --}}
        <section>
            <label>Nombre:</label>
            <input type="text" name="nombre" class="validar">
            <label>Descripcion:</label>
            <textarea cols="30" rows="10" name="descripcion" class="validar"></textarea>
            <label>Explicacion:</label>
            <textarea cols="30" rows="10" name="como" class="validar"></textarea>
            <label>Imagen:</label>
            <input type="file" name="img">
        </section>
        {{-- CODIGO --}}
        <section id="codigo">
            <select name="tipo" id="tipo">
            </select>
            {{-- PRINCIPAL --}}
            <article id="principal"></article>
            <input type="file" id="subir_principal">
            <input type="checkbox" id="check_vp" name="vista_prev">Activar vista previa
            <section id="vp">
                {{-- SECUNDARIO --}}
                <article id="secundario"></article>
                <input type="file" id="subir_secundario">
                {{-- VISTA --}}
                <iframe id="vista"></iframe>
            </section>
        </section>
        {{-- ENVIAR --}}
        <input type="text" id="archivo1" name="archivo1" hidden>
        <input type="text" id="archivo2" name="archivo2" hidden>
        <button type="submit" id="enviar">Enviar</button>
    </form>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>
<script src="https://ace.c9.io/build/src/ext-language_tools.js"></script>
<script src="{{asset('js/nuevo.js')}}"></script>

@endsection
