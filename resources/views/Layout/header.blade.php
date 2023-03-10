<nav class="navbar navbar-light navbar-expand-md py-3" style="background: var(--bs-gray-900);">
    {{-- OTROS --}}
    <div class="container">
        {{-- LOGO --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('inicio') }}">
            <span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon">
                <img src="{{url("/images/pagina/GlichCodeLogo.png")}}" fill="currentColor" viewBox="0 0 16 16"
                    class="bi bi-bezier rounded-circle mx-2" width="50px" height="50px">
            </span>
            <span style="color: var(--bs-white);">
                {{__("texto.t6")}}
            </span>
        </a>
        {{-- NAV --}}
        <div class="collapse navbar-collapse" id="navcol-1">
            {{-- LINKS --}}
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="{{ route('proyectos') }}"
                        style="color: var(--bs-white);">{{__("texto.t7")}}</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('nuevo') }}"
                        style="color: var(--bs-white);">{{__("texto.t8")}}</a></li>
                @if (isset(session()->get('usuario')->id))
                <li class="nav-item"><a class="nav-link active" href="{{ route('perfil', session()->get('usuario')->id)}}"
                    style="color: var(--bs-white);">{{__("texto.t9")}}</a></li>
                @endif
            </ul>
            {{-- SECCION --}}
            @if (isset(session()->get('usuario')->id))
                <section class="text-center" id="perfil">
                    <a href="{{ route('perfil', session()->get('usuario')->id)}}"><img class="rounded-circle" src="{{url("images/usuarios/" . session()->get('usuario')->img)}}" alt="usuario"></a>
                    {{-- <p class="text-light">{{session()->get('usuario')->nombre}}</p> --}}
                </section>
            @else
                <button onclick="location.href='{{ route('login') }}'" class="btn btn-primary" type="button">{{__("texto.t12")}}</button>
            @endif
        </div>
    </div>
</nav>