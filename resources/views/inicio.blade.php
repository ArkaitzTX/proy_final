@extends('Layout.layout')
@section('content')

<link rel="stylesheet" href="{{asset('css/inicio.css')}}">

<main>

    {{-- Inicio --}}
    <section id="inicio" class="py-4 py-xl-5">
        <article class="container bg-opacity-75 bg-white rounded">
            <div class="text-center p-4 p-lg-5">
                <p class="fw-bold text-primary mb-2">Comparte, aprende y explora</p>
                <h1 class="fw-bold mb-4">GlichCode es una herramienta para descubrir y compartir código</h1><button class="btn btn-primary fs-5 me-2 py-2 px-4" type="button">Explora</button><button class="btn btn-light fs-5 py-2 px-4" type="button">Comparte</button>
            </div>
        </article>
    </section>
    {{-- Proyectos --}}
    <section id="filtros">
        {{-- Filtros --}}
        <article>
            <div class="rounded">
                #
            </div>
        </article>
        Proyectos
    </section>

</main>

@endsection