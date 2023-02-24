@extends('Layout.layout')
@section('content')

{{-- CONEXIONES --}}
<link rel="stylesheet" href="{{asset('css/ver.css')}}">
{{-- JSZIP --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.6.0/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>


<main class="container text-center my-5">

    {{-- DATOS --}}
    <input id="info" type="text" value="{{json_encode($proyecto)}}" hidden>

    <h1 class="my-4 display-3 fw-bold ls-tight">{{$proyecto->nombre}}</h1>
    <h3 class="my-3">{{$proyecto->descripcion}}</h3>

    <section class="my-5">
        <button id="descargar" class="btn btn-primary mx-4">Descargar</button>
        <button id="copiar" class="btn btn-secondary mx-4">Compartir</button>
    </section>

    <section class="my-4">
        <h4 class="fw-bold">{{$proyecto->como}}</h4>
    </section>

    <hr>

    <section class="row mt-5">

        {{-- CODIGO --}}
        <article id="codigo" class="my-3">
            {{-- PRINCIPAL --}}
            <h1>Codigo principal</h1>
            <article id="principal" class="my-3 rounded"></article>
            <button id="c_1" class="copiar">Copiar</button>
            <button id="d_1" class="descargar">Descargar</button>
            <section id="vp">
                {{-- SECUNDARIO --}}
                <h1>Codigo secundario</h1>
                <article id="secundario" class="my-3 rounded"></article>
                <button id="c_2" class="copiar">Copiar</button>
                <button id="d_2" class="descargar">Descargar</button>
                {{-- VISTA --}}
                <h1>Vista previa</h1>
                <iframe id="vista" class="my-3" style="min-height: 300px;"></iframe>
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
