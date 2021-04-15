<!DOCTYPE doctype html>
<html>
    <head>
        <!-- App Meta -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="app-name" content="{{ config('app.name') }}"/>
        <meta name="layout-key" content="{{ $layoutKey }}"/>
        <link rel="icon" href="http://coderoj.com/file/site_metarial/favicon.png" type="image/gif" sizes="16x16">
        <title>@yield('title') - {{config('app.name')}}</title>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
        <script type="text/javascript" src="{{mix('js/app.js')}}"></script>
        @include('includes.head')
    </head>
    <body>
        <!-- <div id="pre-loader">@include('includes.preload')</div> -->
        <div id="body-area">
            <div id="modal-area">@include('includes.modal')</div>
            <div class="container-fluid content-body">
                <div id="app-body">
                    @include('includes.header')
                    @yield('content')
                    @include('includes.footer')
                </div>
            </div>
        </div>
    </body>
    
</html>
