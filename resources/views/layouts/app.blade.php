<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name','LSAPP')}}</title>
        {{-- <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> --}}
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" >

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>    
        
        <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    </head>
    <body>
        
        @include('/layouts/inc.navbar')
        <div class="container">
            @include('/layouts/inc.message')
        @yield('content')
        </div>

        <script>
            CKEDITOR.replace( 'summary-ckeditor' );
        </script>
    </body>
</html>
