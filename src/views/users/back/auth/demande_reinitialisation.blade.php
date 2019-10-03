@extends('medKitTheme::_layouts.back.notlogged')
@section('content')
<section class="h-100">
        <div class="row h-100">
                <div id="bg_joli_a_mettre" class="bg-primary d-none d-lg-block col-lg-6 h-100 text-light p-0">
                        <div class="d-flex h-100  justify-content-center">
                            <div class="align-self-center">
                                <p class="h1 mb-5">Réinitialisation </p>
                                <h1 class="bg-primary d-inline p-2 ">de votre mot de passe</h1>
                                {{-- <p class="mt-5 h2">avec une jolie  date<br> par exemple c'est pas mal non ?</p> --}}
                            </div>
                        </div>
                </div>
                <div class="col-lg-6 h-100">
                        @if (session('status'))
                            <div class="alert alert-success mb-4">
                                {{ session('status') }}
                            </div>
                        @endif
                    
                        <div class="card">
                            <div class="card-header">{{ _i('Réinitialiser le mot de passe') }}</div>
                    
                            <div class="card-body">
                                <div class="alert alert-info">
                                    {{ _i('Veuillez saisir votre adresse email pour réinitialiser votre mot de passe.') }}<br />
                                    {{ _i('Vous recevrez les instructions dans quelques instants.') }}
                                </div>
                    
                                {{-- <div class="row"> --}}
                                    {{-- <div class="col-md-6 mx-auto"> --}}
                                        {!! form($form) !!}
                                    {{-- </div> --}}
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
        </div>
</section>


@endsection
