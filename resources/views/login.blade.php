@extends('Layout.layout')
@section('content')
<!-- Section: Design Block -->
<section class="">
  <!-- Jumbotron -->
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight">
            Inicia sesion <br />
            <span class="text-primary">Empieza a crear</span>
          </h1>
          <p style="color: hsl(217, 10%, 50.8%)">
            Al iniciar sesion en nuestra pagina vas a poder subir,
            editar, explorar, y disfrutar de todas las funciones de la pagina.
          </p>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form>
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row">
                  <div class="col-md-12 mb-4">
                    <div class="form-outline">
                      <input type="text" id="form3Example1" class="form-control" />
                      <label class="form-label" for="form3Example1">Nombre</label>
                    </div>
                  </div>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4" class="form-control" />
                  <label class="form-label" for="form3Example4">Contraseña</label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">
                  Inicia sesion
                </button>

                <!-- Register buttons -->
                <div class="text-center">
                <p class="mb-5 pb-lg-2" style="color: #393f81;">¿No tienes cuenta? <a href="{{ route('sign') }}"
                      style="color: #393f81;">Registrate gratis</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>

@endsection
