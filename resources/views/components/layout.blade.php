<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
{{$head}}
<body>
       <x-navbar/>

        <main>
            {{$slot}}
        </main>


        <x-footer/>
        <script src="{{ asset('js/app.js') }}" ></script>
        @stack('scripts')
</body>
</html>
