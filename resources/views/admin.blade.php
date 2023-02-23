@extends('Layout.layout')
@section('content')

<link rel="stylesheet" href="{{asset('css/admin.css')}}">

<main>
    <section>
        <h1 class="text-dark">Usuarios: </h1>
        <table class="bg-dark rounded">
            @foreach ($usuarios as $usuario)
                @if ($usuario->id != session()->get('usuario')->id && $usuario->idn != 1)
                <tr>
                    <td>{{$usuario->nombre}}</td>
                    <td>{{count($usuario->proyectos) . ' proyetos'}}</td>
                    <td>
                        {{ $usuario->admin ? 'Administrador' : 'Usuario' }}
                    </td>
                    <td id="botones">
                        <a class="btn btn-outline-light" href="{{ route('perfil', $usuario->id)}}">EDITAR</a>
                        <form action="{{ route('adminPermisos', $usuario->id) }}" method="post">
                            @csrf
                            <button class="btn btn-outline-light">CAMBIAR PERMISOS</button>
                        </form>
                        <form action="{{ route('adminDelete', $usuario->id) }}" method="post">
                            @csrf {{ method_field('DELETE') }}
                            <button class="btn btn-outline-light">ELIMINAR</button>
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach
        </table>
    </section>
</main>

@endsection
