@extends('medKitTheme::_layouts.back.notlogged')
@section('content')

<section class="h-100">
        <div class="row h-100">
                <div id="bg_joli_a_mettre" class="bg-primary d-none d-lg-block col-lg-6 h-100 text-light p-0">
                        <div class="d-flex h-100  justify-content-center">
                            <div class="align-self-center">
                                <p class="h1 mb-5">{{ _i('Réinitialiser le mot de passe') }} </p>
                                {{-- <h1 class="bg-primary d-inline p-2 ">de votre mot de passe</h1> --}}
                                {{-- <p class="mt-5 h2">avec une jolie  date<br> par exemple c'est pas mal non ?</p> --}}
                            </div>
                        </div>
                </div>
                <div class="col-lg-6 h-100">
                        <div class="d-flex h-100  justify-content-center">
                            <div class="align-self-center w-50 mx-auto">
                            
                                <div class="card">
                                        <div class="card-header">{{ _i('Réinitialiser le mot de passe') }}</div>
                                
                                        <div class="card-body">
                                                    {!! form($form) !!}
                                        </div>
                                    </div>
                            </div>
                        </div>
                        
                    </div>
        </div>
</section>

@endsection
