@php
    $user = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page.title', env('APP_NAME'))</title>

    <!-- Meta -->
    <meta name="description" content="@yield('page.meta_description', env('APP_NAME') )">
    <meta name="author" content="@yield('page.meta_author', env('APP_AUTHOR', 'Mediactive Digital') )">
    @yield('pages.metas')

    <!-- Styles -->
    {{-- {!! MDAsset::addCss(['bootstrap', 'fontawesome', 'swal']) !!} --}}
    {{-- {!! MDAsset::addCss('back.theme.default') !!} --}}

    <!-- Custom styles -->
    @stack('styles')

    @php
        // $styles = ['main', 'sidebar'];

        if ($user) {

            $styles[] = 'back.' . ($user->theme ? 'dark' : 'light');
        }
    @endphp

    {!! MDAsset::addCss($styles) !!}

    @stack('post-styles')

    {{-- @routes --}}

    <!-- Scripts -->
    <script>
        window.Laravel =
        <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<body>
    @include('medKitTheme::_layouts.back.partials.header')
    <div class="wrapper position-relative">
        @include('medKitTheme::_layouts.back.partials.sidebar')
        <main role="main" id="content" class="col main-admin">
                
                <div class="container-fluid">
                    <div class="col-12">
                        <div id="flash-messages">
                            @include('medKitTheme::_layouts.back.partials.flash_messages')
                        </div>
                    </div>
                    
                </div>

                @yield('content')
                
                
        </main>
        {{-- a prevoir deuxième emplacement de sidebar si besoin...--}}
        <div id="sidebar-right" class="d-sm-block">
            <div class="sticky-top pt-5">
                <button type="button" id="sidebar-rightCollapse" class="btn btn-info navbar-btn d-sm-block">
                    <span>Message</span>
                </button>
                <div class="sidebar-header p-4">
                    Seconde Sidebar        
                </div>
                
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">



        </div>
    </div>

    @include('medKitTheme::_layouts.back.partials.footer')
	@if ($jsTranslations = Format::getJsTranslations())

    <!-- Translations -->
    <script src="{{ $jsTranslations }}" type="text/javascript"></script>
    @endif
    @if ($jsRoutes = Format::getJsRoutes())

    <!-- Routes -->
    <script src="{{ $jsRoutes }}" type="text/javascript"></script>
    @endif
   
    <!-- General Theme script -->
    {!! MDAsset::addJs('back.default') !!}

    <!-- Custom scripts required -->
    @stack('scripts')
</body>
</html>
