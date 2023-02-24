@extends('Layout.layout')
@section('content')

    {{-- CONEXIONES --}}
    <link rel="stylesheet" href="{{asset('css/ver.css')}}">   

    <main>

        {{-- CODIGO --}}
        <section id="codigo" class="my-3">
            {{-- PRINCIPAL --}}
            <article id="principal" class="my-3 rounded"></article>
            <section id="vp">
                {{-- SECUNDARIO --}}
                <article id="secundario" class="my-3 rounded"></article>
                {{-- VISTA --}}
                <iframe id="vista" class="my-3" style="min-height: 300px;"></iframe>
            </section>
        </section>

    </main>

    {{-- ACE CODE --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>
    <script src="https://ace.c9.io/build/src/ext-language_tools.js"></script>
    <script src="{{asset('js/ver.js')}}"></script>

@endsection
