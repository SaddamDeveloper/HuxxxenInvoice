<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Huxxxen Invoice 1.0</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">

        <!-- Optional theme -->
        <link rel="stylesheet" href="{{asset('public/css/bootstrap-theme.min.css')}}">

        <!-- Font awsome -->
        <link href="{{asset('public/css/all.min.css')}}" rel="stylesheet">
        <style>
            @media print {
                #three-button {
                    display :  none;
                }
                table tr.highlighted > td {
                    background-color: rgba(247, 202, 24, 0.3) !important;
                }
                table tr.highlighteddescription > td {
                    background-color: rgba(247, 202, 24, 0.3) !important;
                }
            }
        </style>
    </head>
    <body>
        <div class="container" style="margin-top: 20px;">
            @yield('content')
        </div>
        @stack('scripts')
    </body>
</html>
