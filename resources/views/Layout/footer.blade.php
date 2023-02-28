<footer class="text-center bg-dark mt-auto">
    <div class="container text-white py-4 py-lg-5">
        @if (isset(session()->get('usuario')->id))
            <a class="btn btn-outline-primary mb-4" href="{{ route('logout') }}" role="button">Cerrar sesion</a>
        @endif
        <p class="text-muted mb-0">Copyright © 2023 BaboonCorp</p>
    </div>
</footer>