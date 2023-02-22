@extends('Layout.layout')
@section('content')

{{-- VUE  --}}
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script> 
{{-- CONEXIONES --}}
<link rel="stylesheet" href="{{asset('css/inicio.css')}}">
<script src="{{asset('js/inicio.js')}}"></script>


<main>
    {{-- Inicio --}}
    <section id="inicio" class="py-4 py-xl-5">
        <article class="container bg-opacity-50 bg-white rounded">
            <div class="text-center p-4 p-lg-5">
                <p class="fw-bold text-primary mb-2">Comparte, aprende y explora</p>
                <h1 class="fw-bold mb-4">GlichCode es una herramienta para descubrir y compartir código</h1>
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
