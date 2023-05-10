<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'JULMAR_AGENT') }}</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="{{ asset('/lapis.css') }}" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <br />
        <br />
        <center>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <form action="{{ route('user_credential')}}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    @csrf
                    <div class="form-group">
                        {{-- <input type="file" name="user_image" required class="form-control">
                        <br /> --}}
                        <input type="number" placeholder="Salesman ID" min="0" class="form-control" name="user_id" required>
                        <br />
                        <input type="text" placeholder="Full Name" class="form-control" name="agent_name" required>
                    </div>
                    <button type="submit" class="btn btn-block btn-success">SUBMIT AGENT CREDENTIALS</button>
                    
                </form>
            </div>
        </div>
        </center>
    </body>
</html>