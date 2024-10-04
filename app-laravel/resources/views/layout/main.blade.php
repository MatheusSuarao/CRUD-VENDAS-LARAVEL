<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('Laravel CRUD')</title>
      
        <!-- Fonte Google -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap 5 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      

        <!-- CND Jquey mask -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

        <!-- JS -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
        
        @yield("scriptjs")

       


    </head>


    <div class="bg-light">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-evenly py-3 mb-4 border-bottom">
          <div class="col-md-3 mb-2 mb-md-0">
            <span class="fs-3">CRUD Laravel</span>
          </div>
    
          <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 fs-5">
            <li><a href="{{route('Produtos')}}" class="nav-link px-2 text-secondary">Produtos</a></li>
            <li><a href="{{route('Clientes')}}" class="nav-link px-2 text-secondary">Clientes</a></li>
            <li><a href="{{route('Pedidos')}}" class="nav-link px-2 text-secondary">Pedidos</a></li>
          </ul>
    

          <div class="d-flex gap-3 col-md-3 text-end">
        
            

          </div>
        </header>

      </div>

    <body style="background-color: #e5e7eb">

        <main class="container-xxl bd-gutter mt-3 my-md-4 bd-layout">
          @yield('content')
        </main>
    </body>
</html>
