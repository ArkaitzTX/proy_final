@extends('Layout.layout')
@section('content')

{{-- CONEXIONES --}}
<link rel="stylesheet" href="{{asset('css/inicio.css')}}">

<main>

    {{-- Inicio --}}
    <section id="inicio" class="py-4 py-xl-5">
        <article class="container bg-opacity-50 bg-white rounded">
            <div class="text-center p-4 p-lg-5">
                <p class="fw-bold text-primary mb-2">Comparte, aprende y explora</p>
                <h1 class="fw-bold mb-4">GlichCode es una herramienta para descubrir y compartir código</h1>
                <a href="{{ route('proyectos') }}"
                    class="btn btn-primary fs-5 me-2 py-2 px-4" type="button">Explora</a>
                <a  href="{{ route('nuevo') }}"
                    class="btn btn-light fs-5 py-2 px-4" type="button">Comparte</a>
            </div>
        </article>
    </section>
    {{-- Proyectos --}}
    <section id="proyectos">
        {{-- Filtros --}}
        <article id="filtros">
            <div class="rounded d-flex align-items-center justify-content-around text-light bg-opacity-75 bg-dark">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <select class="form-select w-25" aria-label="Default select example">
                    <option selected>Por fecha</option>
                    <option value="1">Mas Nuevos</option>
                    <option value="2">Mas Viejos</option>
                </select>
            </div>
        </article>
        {{-- Proyectos --}}
        <article id="projects">
            @foreach ($proyectos as $proyecto)

            <div class="py-4 py-xl-5">
                <div class="container" style="padding-left: 12px;">
                    <div class="bg-dark border rounded border-0 border-dark overflow-hidden">
                        <div class="row g-0">
                            <div class="col-md-6 order-first order-md-last">
                                <div class="text-white p-4 p-md-5">
                                    <h2 class="fw-bold text-white mb-3">{{ $proyecto->nombre }}</h2>
                                    <p class="mb-4">{{ $proyecto->descripcion }}</p>
                                    <div class="my-3"><a class="btn btn-primary btn-lg me-2" role="button"
                                            href="#">Ver</a><a class="btn btn-light btn-lg" role="button"
                                            href="#">Descargar</a></div>
                                </div>
                            </div>
                            <div class="col-md-6" style="min-height: 250px;"><img class="w-100 h-100 fit-cover"
                                    src="{{url("proyectos/images/" . $proyecto->img)}}"></div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

        </article>
    </section>
</main>

@endsection
