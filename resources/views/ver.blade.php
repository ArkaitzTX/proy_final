@extends('Layout.layout')
@section('content')

{{-- CONEXIONES --}}
<link rel="stylesheet" href="{{asset('css/ver.css')}}">
{{-- JSZIP --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- VUE  --}}
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>


<main class="container my-5">

<div>
    <section class="d-flex">
        <article class="w-25">
        <img class="rounded mt-4" src="{{url('proyectos/images/' . $proyecto->img)}}" alt="img_perfil" style="width: 15vw; height: 13vw; object-fit: cover;"></article>
        <article class="mx-5">
            <div><h1 class="my-4 fw-bold">{{$proyecto->nombre}}</h1></div>
            <div class="d-flex align-items-end">{{-- PERFIL USUARIO --}}
            <img class="rounded-circle mx-3" src="{{url('images/usuarios/' . $proyecto->usuarios->img)}}" alt="img_perfil" style="width: 60px; height: 60px; object-fit: cover;">
            <p>Por: {{$proyecto->usuarios->nombre}}</p></div>
            <div><h5 class="my-3 mb-3"><strong class="text-primary">Descripcion: </strong> {{$proyecto->descripcion}}</h5></div>
            <div class="my-3">   
            <button id="descargar" class="btn btn-lg btn-primary">Descargar</button>
            <button id="copiar" class="btn btn-lg btn-secondary mx-4 my-3">Compartir</button></div>
        </article>
    </section>
    <section>
        @if ($proyecto->como != null)
            <h5 class="mt-4 rounded p-4"><strong class="">Explicacion: </strong> {{$proyecto->como}}</h5>
        @endif       
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
            @if ($proyecto->vista_prev)
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
            @endif
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
