@extends('Layout.layout')
@section('content')

<link rel="stylesheet" href="{{asset('css/admin.css')}}">
<main style="background-color: hsl(0, 0%, 96%)">
    {{-- USUARIOS --}}
    <section>
        <h1 class="text-dark">{{__("texto.t13")}}</h1>
        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover ">
                <thead>
                    <tr>
                        <th>{{__("texto.t14")}}</th>
                        <th>{{__("texto.t15")}}</th>
                        <th>{{__("texto.t16")}}</th>
                        <th>{{__("texto.t17")}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{$usuario->nombre}}</td>
                        <td>{{count($usuario->proyectos) . ' '.__("texto.t18")}}</td>
                        <td>{{ $usuario->admin ? __("texto.t19") : __("texto.t20") }}</td>
                        <td id="botones">
                            @if ($usuario->id != session()->get('usuario')->id && $usuario->idn != 1)

                            <a class="btn btn-outline-light" href="{{ route('perfil', $usuario->id)}}">{{__("texto.t21")}}</a>
                            <form action="{{ route('adminPermisos', $usuario->id) }}" method="post">
                                @csrf
                                <button class="btn btn-outline-light">{{__("texto.t22")}}</button>
                            </form>
                            <form action="{{ route('adminDelete', $usuario->id) }}" method="post">
                                @csrf {{ method_field('DELETE') }}
                                <button class="btn btn-outline-danger">{{__("texto.t23")}}</button>
                            </form>

                            @else
                            <p>---</p>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $usuarios->links() }}
    </section>


    {{-- PROYECTOS --}}
    <section>
        <h1 class="text-dark">{{__("texto.t24")}}</h1>
        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover ">
                <thead>
                    <tr>
                        <th>{{__("texto.t14")}}</th>
                        <th>{{__("texto.t17")}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proyectos as $proyecto)
                    <tr>
                        <td>{{$proyecto->nombre}}</td>
                        <td id="botones">

                            <a class="btn btn-outline-light" role="button" href="{{ route('ver', $proyecto->id) }}">{{__("texto.t25")}}</a>
                            <a class="btn btn-outline-light" href="{{ route('proyedit',  $proyecto->id)}}">{{__("texto.t26")}}</a>
                            <a class="btn btn-outline-danger" role="button" href="{{ route('borrarProyecto', $proyecto->id) }}">{{__("texto.t27")}}</a>
                            {{-- !EDITAR --}}

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $proyectos->links() }}
    </section>


</main>

@endsection
