@extends('Layout.layout')
@section('content')

{{-- CONEXIONES --}}
<link rel="stylesheet" href="{{asset('css/ver.css')}}">
{{-- JSZIP --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- VUE  --}}
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>


<main class="container text-center my-5">

    {{-- DATOS --}}
    <input id="info" type="text" value="{{json_encode($proyecto)}}" hidden>


    <h1 class="my-4 display-3 fw-bold ls-tight">{{$proyecto->nombre}}</h1>

    <section>
        {{-- PERFIL USUARIO --}}
        <img src="{{url("images/usuarios/" . $proyecto->usuarios->img)}}" alt="img_perfil">
        <p>{{$proyecto->usuarios->nombre}}</p>
    </section>

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

{{-- !NO ELIMINAR CON GIT --}}
@isset(session()->get('usuario')->id)
<section id="comentarios">
    <div class="card border-0">
        <!-- TODO: ESCRIBIR -->
        <form action="{{ route('insertarCom') }}" method="POST" class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
            @csrf {{ method_field('POST') }}

            <div class="d-flex flex-start w-100">
                <!-- IMG  PERFIL -->
                <img class="rounded-circle shadow-1-strong me-3"
                    src="{{url("images/usuarios/" . session()->get('usuario')->img)}}" alt="avatar" width="40"
                    height="40" />
                <!-- INPUT COMENTARIO -->
                <div class="form-outline w-100">
                    <textarea class="form-control" id="texto" rows="4" style="background: #fff;"
                        placeholder="Escriba un comentario..." name="texto"></textarea>
                    <p id="texto-char" class=" text-secondary">0/250</p>
                </div>
            </div>
            {{-- DATOS OCULTOS --}}
            <input type="text" value="{{$proyecto->id}}" name="id_proy" hidden>
            <input type="text" value="{{session()->get('usuario')->id}}" name="id_usu" hidden>

            <div class="float-end mt-2 pt-1">
                <button type="submit" class="btn btn-primary btn-sm">Enviar</button>
            </div>
            
        </form>
        <!-- TODO: MENSAJE -->
        @foreach ($proyecto->comentarios as $com)
        <div class="card-body">
            <!-- INFO USUARIO -->
            <div class="d-flex flex-start align-items-center">
                <!-- IMG USUARIO -->
                <img class="rounded-circle shadow-1-strong me-3" src="{{url("images/usuarios/" . $com->usuarios->img)}}"
                    alt="avatar" width="60" height="60" />
                <!-- DATOS COMENTARIO -->
                <div>
                    <h6 class="fw-bold text-primary mb-1">{{$com->usuarios->nombre}}</h6>
                    <p class="text-muted small mb-0">
                        Publicado - {{$com->created_at}}
                    </p>
                </div>
            </div>
            <!-- COMENTARIO TEXTO -->
            <p class="mt-3 mb-4 pb-2">
                {{$com->texto}}
            </p>
            <!-- OTROS -->
            @if ($com->usuarios->id === session()->get('usuario')->id || session()->get('usuario')->admin)
                <div class="small d-flex justify-content-start">
                    <form action="{{ route('eliminarCom', $com->id) }}" method="POST" class="d-flex align-items-center me-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link mb-0">Eliminar</button>
                    </form>
                </div>
            @endif
        </div>
        @endforeach
        <!-- TODO: FIN MENSAJE -->
    </div>
</section>
@endisset


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
