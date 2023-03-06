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
                        {{__("texto.t27")}} <br />
                        <span class="text-primary">{{__("texto.t28")}}</span>
                    </h1>
                    <p style="color: hsl(217, 10%, 50.8%)">
                        {{__("texto.t29")}}
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card">
                        <div class="card-body py-5 px-md-5">
                            <form action="{{ route('login-a')}}" method="POST">
                                @csrf
                                <!-- 2 column grid layout with text inputs for the first and last names -->
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-outline">
                                            <input type="text" id="form3Example1" name="nombre" class="form-control" />
                                            <label class="form-label" for="form3Example1">{{__("texto.t30")}}</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" id="form3Example4" name="pass" class="form-control" />
                                    <label class="form-label" for="form3Example4">{{__("texto.t31")}}</label>
                                </div>

                                {{-- ERROR --}}
                                <p class="text-center text-danger">
                                    @isset($mensaje)
                                    {{ $mensaje }}
                                    @endisset
                                </p>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                    {{__("texto.t27")}}
                                </button>

                                <!-- Register buttons -->
                                <div class="text-center">
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">{{__("texto.t32")}} <a
                                            href="{{ route('sign') }}" style="color: #393f81;">{{__("texto.t33")}}</a></p>
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
