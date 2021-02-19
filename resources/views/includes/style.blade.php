@php
    $styleList = [
        //<!-- Font Lib -->
        'https://fonts.googleapis.com/css?family=Exo 2',
        'http://fonts.googleapis.com/css?family=Open+Sans:400,700',
        'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        'https://use.fontawesome.com/releases/v5.4.2/css/all.css',

        //<!-- Cuatom Lib -->
        asset('lib/font-awesome/css/font-awesome.css'),

        
        //<!-- Bootstrap CSS -->
        asset('lib/bootstrap/css/bootstrap.min.css'),
        
        //<!-- Custom Script -->
        asset('css/style.css'),
        asset('css/includes/navbar.css'),
        asset('css/includes/modal.css'),
        asset('css/includes/toast.css'),
        asset('css/includes/top_loader.css'),
    ];
@endphp

@foreach($styleList as $style)
<link rel="stylesheet" type="text/css" href="{{$style}}">
@endforeach
