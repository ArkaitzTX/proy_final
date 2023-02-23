@extends('Layout.layout')
@section('content')

<link rel="stylesheet" href="{{asset('css/admin.css')}}">

<main>
    <section>
        <table class="bg-dark rounded">
            @foreach ($usuarios as $usuario)
                @if ($usuario->id != session()->get('usuario')->id)
                <tr>
                    <td>{{$usuario->nombre}}</td>
                    <td>{{count($usuario->proyectos) . '-proyetos'}}</td>
                    <td id="botones">
                        <a class="btn btn-outline-light">Editar</a>
                        <form action="{{ route('adminDelete', $usuario->id) }}" method="post">
                            @csrf {{ method_field('DELETE') }}
                            <button class="btn btn-outline-light">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach
        </table>
    </section>
</main>

@endsection
