@extends('Layout.layout')
@section('content')

<link rel="stylesheet" href="{{asset('css/admin.css')}}">
<main style="background-color: hsl(0, 0%, 96%)">
<section>
    <h1 class="text-dark">Usuarios</h1>
    <div class="table-responsive">
        <table class="table table-dark table-striped table-hover ">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Proyectos</th>
                    <th>Permisos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{$usuario->nombre}}</td>
                        <td>{{count($usuario->proyectos) . ' proyectos'}}</td>
                        <td>{{ $usuario->admin ? 'Administrador' : 'Usuario' }}</td>
                        <td id="botones">
                            @if ($usuario->id != session()->get('usuario')->id && $usuario->idn != 1)
    
                            <a class="btn btn-outline-primary" href="{{ route('perfil', $usuario->id)}}">EDITAR</a>
                            <form action="{{ route('adminPermisos', $usuario->id) }}" method="post">
                                @csrf
                                <button class="btn btn-outline-warning">CAMBIAR PERMISOS</button>
                            </form>
                            <form action="{{ route('adminDelete', $usuario->id) }}" method="post">
                                @csrf {{ method_field('DELETE') }}
                                <button class="btn btn-outline-danger">ELIMINAR</button>
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
</main>

@endsection
