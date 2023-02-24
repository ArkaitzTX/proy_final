@extends('Layout.layout')
@section('content')

{{-- VUE  --}}
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script> 
{{-- AXIOX  --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> 
{{-- JSZIP --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.6.0/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
{{-- CONEXIONES --}}
<link rel="stylesheet" href="{{asset('css/inicio.css')}}">
<script src="{{asset('js/inicio.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/proyecto.css')}}">



<main>
    {{-- Inicio --}}
    <section id="inicio" class="py-4 py-xl-5">
        <article class="container bg-opacity-50 bg-white rounded">
            <div class="text-center p-4 p-lg-5">
                <p class="fw-bold text-primary mb-2">Comparte, aprende y explora</p>
                <h1 class="fw-bold mb-4">GlichCode es una herramienta para descubrir y compartir código</h1>
                <p>
                    Esta es una pagina en la que puedes subir pequeños fragmentos de codigo para que otros usuario puedan usarlo. No es una pagina donde puedas subir el codigo de un proyecto completo. Algunos ejemplos de codigos que podras usar son: animaciones, diseños de elementos, codigos reutilisable, archivos de almacenamiento
                </p>
                <a href="{{ route('proyectos') }}" class="btn btn-primary fs-5 me-2 py-2 px-4" type="button">Explora</a>
                <a href="{{ route('nuevo') }}" class="btn btn-light fs-5 py-2 px-4" type="button">Comparte</a>
            </div>
        </article>
    </section>
    {{-- Proyectos --}}
    <section id="proyectos">
        {{-- Filtros --}}
        <filtros pro="{{ json_encode($proyectos) }}"></filtros>
    </section>
</main>


@endsection
