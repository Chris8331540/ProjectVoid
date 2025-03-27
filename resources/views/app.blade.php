<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta id="metaViewport" name="viewport" content="width=device-width">
        {{-- Si en algún momento fallan escalados, poner intial-scale=1 y usar el js --}}
        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @routes
        @vite(['resources/js/app.ts'])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
        {{-- <!-- Aquí va el script -->
        <script>
            function adjustViewport() {
                var viewport = document.getElementById('metaViewport');
                
                if (window.innerWidth < 768) {
                    // Cambiar el initial-scale a 0.8 para pantallas pequeñas (móviles)
                    viewport.setAttribute('content', 'width=device-width, initial-scale=0.8');
                } else {
                    // En pantallas más grandes (desktop), establecer initial-scale=1
                    viewport.setAttribute('content', 'width=device-width, initial-scale=1');
                }
            }

            // Llamar la función al cargar la página
            window.addEventListener('load', adjustViewport);

            // Llamar la función cuando la ventana cambie de tamaño
            window.addEventListener('resize', adjustViewport);
        </script> --}}
    </body>
</html>
