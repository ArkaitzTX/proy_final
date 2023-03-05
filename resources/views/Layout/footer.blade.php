<footer class="text-center bg-dark mt-auto">
    <div class="container text-white py-4 py-lg-5">
        {{-- IDIOMAS --}}
        <form class="d-flex justify-content-center align-items-center mb-4" action="{{ route('idioma') }}" method="post" onchange="this.submit();">
            @csrf
            <select  style="width: 90px" class="form-select form-select-sm" name="idioma" id="idioma">
                @if (session()->get('idioma') == "en")
                    <option value="es">{{__("texto.t10")}}</option>
                    <option value="eu">Eu</option>
                    <option value="en" selected>{{__("texto.t11")}}</option>
                @elseif (session()->get('idioma') == "eu")
                    <option value="es">Es</option>
                    <option value="eu" selected>Eu</option>
                    <option value="en">En</option>
                @else
                    <option value="es" selected>{{__("texto.t10")}}</option>
                    <option value="eu">Eu</option>
                    <option value="en">{{__("texto.t11")}}</option>
                @endif
            </select>  
        </form>
        @if (isset(session()->get('usuario')->id))
            <a class="btn btn-outline-primary mb-4" href="{{ route('logout') }}" role="button">{{__("texto.t41")}}</a>
        @endif
    
    <p class="text-muted mb-0">Copyright © 2023 BaboonCorp</p>
</div>
</footer>


