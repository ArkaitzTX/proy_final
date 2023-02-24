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
                <p class="fw-bold text-primary mb-2">Comparte, explora y aprende</p>
                <h1 class="fw-bold mb-4">GlichCode es una herramienta para descubrir y compartir código</h1>
                <p>
                    Bienvenido a esta plataforma para compartir fragmentos de código.
                    Aquí puedes compartir pequeñas partes de código que puedan ser útiles a otros usuarios. 
                    Esta página no está diseñada para compartir proyectos completos, sino para subir fragmentos de código en CSS, JavaScript y JSON, junto con las instrucciones y codigo necesario para su uso. 
                    ¡Gracias por ser parte de nuestra comunidad de desarrolladores!         
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
