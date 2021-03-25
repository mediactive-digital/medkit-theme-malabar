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


    {!! MDAsset::addCss('back.light') !!}

    <!-- Custom styles -->
    @stack('styles')

    {{-- {!! MDAsset::addCss(['main']) !!} --}}

    @stack('post-styles')

    <!-- Scripts -->
    <script>
        window.Laravel =
        <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<body>
    <main role="main" class="h-100">
        @yield('content')
    </main>
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
