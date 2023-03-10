@extends('Layout.layout')
@section('content')

{{-- CONEXIONES --}}
<link rel="stylesheet" href="{{asset('css/nuevo.css')}}">
{{-- LIBRERIAS --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<textarea id="edit_info" hidden>@isset($proyecto){{$proyecto}}@endisset</textarea>

<main class="container my-3 d-flex flex-column">

@if (isset($proyecto))
    <form action="{{ route('proyupdate', $proyecto->id) }}" method="post" enctype="multipart/form-data">
    {{ method_field('PUT') }}
@else
    <form action="{{ route('nuevoCrear') }}" method="post" enctype="multipart/form-data">
@endif

        @csrf
        {{-- INFORMACION PROYECTO --}}

        <h1 class=" text-center my-5 display-3 fw-bold ls-tight">{{__("texto.t56")}}</h1>
        <section class="my-3">
            <label class="form-label ">{{__("texto.t57")}}</label>
            <input type="text" name="nombre" class="form-control validar mb-4" @isset($proyecto)
                value="{{ $proyecto->nombre }}" @endisset>
            <p class="text-danger" id="nombre_error"></p>
            <div class="d-flex justify-content-between">
                <div class="w-100" style="width: 95%; margin-right: 20px;">
                    <label class="form-label">{{__("texto.t58")}}</label>
                    <textarea cols="30" rows="10" name="descripcion"
                        class="form-control validar mb-4">@isset($proyecto){{$proyecto->descripcion }}@endisset</textarea>
                    <p class="text-danger" id="descripcion_error"></p>
                </div>
                <div class="w-100" style="width: 95%; margin-left: 20px;">
                    <label class="form-label">{{__("texto.t59")}}</label>
                    <textarea cols="30" rows="10" name="como"
                        class="form-control mb-4">@isset($proyecto){{$proyecto->como }}@endisset</textarea>
                    <p class="text-danger" id="como_error"></p>
                </div>

            </div>
            <label class="form-label">{{__("texto.t48")}}</label>
            <input type="file" name="img" class="form-control mb-5">
        </section>
        {{-- CODIGO --}}
        <section id="codigo" class="my-3">
            <div class="d-flex">
                <div class="w-25">
                    <h3>{{__("texto.t49")}}</h3>
                </div>
                <select name="tipo" id="tipo" class="form-select">
                </select>
            </div>

            <p style="display: none;" id="mensaje-error" class="text-danger small">{{__("texto.t50")}}</p>

            {{-- PRINCIPAL --}}
            <article id="principal" class="my-3 w-100 rounded"></article>
            <label class="form-label" for="subir_principal">{{__("texto.t51")}}</label>
            <input type="file" id="subir_principal" class="form-control mb-3 mb-5">
            <h3>{{__("texto.t52")}}</h3>
            <div class="form-check mb-3">
                <input type="checkbox" id="check_vp" name="vista_prev" class="form-check-input">
                <label class="form-check-label" for="check_vp">{{__("texto.t53")}}</label>
            </div>
            <section id="vp">
                {{-- SECUNDARIO --}}
                <article id="secundario" class="my-3 w-100 rounded"></article>
                <label class="form-label" for="subir_secundario">{{__("texto.t54")}}</label>
                <input type="file" id="subir_secundario" class="form-control mb-5">
                {{-- VISTA --}}
                <h3>{{__("texto.t55")}}</h3>
                <iframe id="vista" class="my-3 rounded w-100" style="min-height: 300px;"></iframe>
            </section>
        </section>
        {{-- ENVIAR --}}
        {{--! TEXT AREA -> NO TOCAR -> CUIDADO EN GIT --}}
        <textarea id="archivo1" name="archivo1" hidden></textarea>
        <textarea id="archivo2" name="archivo2" hidden></textarea>
        
        <button type="submit" id="enviar" class="btn btn-primary my-3">{{__("texto.t60")}}</button>

    </form>
</main>

{{-- !BOTON INFO --}}
<button id="info" class="btn btn-primary rounded-circle">?</button>

{{-- ACE CODE --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>
<script src="https://ace.c9.io/build/src/ext-language_tools.js"></script>
<script src="{{asset('js/nuevo.js')}}"></script>

@endsection
