@extends('Layout.layout')
@section('content')

{{-- CONEXIONES --}}
<link rel="stylesheet" href="{{asset('css/ver.css')}}">
{{-- JSZIP --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<main class="container my-5">

<div>
    <section class="d-flex">
        <article class="w-25">
        <img class="rounded-circle mt-4" src="{{url('proyectos/images/' . $proyecto->img)}}" alt="img_perfil" width="200px"></article>
        <article class="mx-5">
            <div><h1 class="my-4 fw-bold">{{$proyecto->nombre}}</h1></div>
            <div class="d-flex align-items-end">{{-- PERFIL USUARIO --}}
            <img class="rounded-circle mx-3" src="{{url('images/usuarios/' . $proyecto->usuarios->img)}}" alt="img_perfil" width="60px">
            <p>Por: {{$proyecto->usuarios->nombre}}</p></div>
            <div><h5 class="my-3 mb-3"><strong class="text-primary">Descripcion: </strong> {{$proyecto->descripcion}}</h5></div>
            <div class="my-3">   
            <button id="descargar" class="btn btn-lg btn-primary">Descargar</button>
            <button id="copiar" class="btn btn-lg btn-secondary mx-4 my-3">Compartir</button></div>
        </article>
    </section>
    <section>       
        <h5 class="mt-4 rounded p-4"><strong class="">Explicacion: </strong> {{$proyecto->como}}</h5>
    </section>
</div>

    <div class="d-flex">
    
    <div class="d-flex flex-column text-center">
    {{-- DATOS --}}
    <input id="info" type="text" value="{{json_encode($proyecto)}}" hidden>
    </div>
    </div>


    <section class="row">

        {{-- CODIGO --}}
        <article id="codigo" class="my-1">
            {{-- PRINCIPAL --}}
            <h1 class="mt-5 mb-3">Codigo principal</h1>
            <article id="principal" class="my-3 rounded w-100 mt-4"></article>
            <div>
            <button id="c_1" class="copiar btn btn-primary">Copiar</button>
            <button id="d_1" class="descargar btn btn-secondary">Descargar</button>
            </div>
            <section id="vp">
                {{-- SECUNDARIO --}}
                <h1 class="mt-5 mb-3">Codigo secundario</h1>
                <article id="secundario" class="my-3 rounded w-100"></article>
                <button id="c_2" class="copiar btn btn-primary">Copiar</button>
                <button id="d_2" class="descargar btn btn-secondary">Descargar</button>
                {{-- VISTA --}}
                <h1 class="mt-5 mb-3">Vista previa</h1>
                <iframe id="vista" class="my-3 w-100 rounded" style="min-height: 300px;"></iframe>
            </section>
        </article>

    </section>
</main>

<style>
    footer {
        display: none;
    }
</style>

{{-- ACE CODE --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>
<script src="https://ace.c9.io/build/src/ext-language_tools.js"></script>
<script src="{{asset('js/ver.js')}}"></script>


@endsection
