@extends('medKitTheme::_layouts.back.notlogged')
@section('content')
<section>
    <div class="row">
        <div id="bg_joli_a_mettre" class="bg-primary col-lg-6 h-100 text-light p-0">
            <div class="d-flex flex-column">
                <div class="align-self-center">
                    <p class="h1 mb-5">Joli titre </p>
                    <h1 class="bg-primary d-inline p-2 ">de mon joli back a mettre</h1>
                    <p class="mt-5 h2">avec une jolie  date<br> par exemple c'est pas mal non ?</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 h-100">
            <div class="card w-50 mx-auto">
                
                <img src="" class="img-fluid" alt="Logo pour thème malabar">
                <div class="card-header">{{ _i('Connexion') }}</div>
                <div class="card-body">
                    {!! form($form) !!}
                </div>
                <div class="card-footer bg-transparent border-transparent text-right">
                    <a href="{{ route('back.password.request') }}">{{ _i('Mot de passe oublié ?') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>


</body>
</html>

@endsection
