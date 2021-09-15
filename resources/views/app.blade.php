<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/app.css">

    </head>
    <body class="antialiased m-0">

        <div id="app">
            <div class="container mx-auto">
                <nav>
                    <ul class="flex flex-row">
    					<li class="text-sm leading-normal p-4 self-center"><router-link class="text-black" :to="{ name: 'home' }">Home</router-link></li>
                        <li class="text-sm leading-normal p-4 self-center"><router-link class="text-black" :to="{ name: 'customers' }">Customers</router-link></li>
                        <li class="text-sm leading-normal p-4 self-center"><router-link class="text-black" :to="{ name: 'products' }">Products</router-link></li>
    					<li class="text-sm leading-normal p-4 self-center"><router-link class="text-black" :to="{ name: 'quotes' }">Quotes</router-link></li>
                        <div class="text-center p-4">
                            <h1 class="text-4xl">Builder Co.</h1>
                        </div>

                    </ul>
                </nav>
            </div>
            <hr>
            <div class="container mx-auto">

                <router-view></router-view>

            </div>

        </div>

        <script src="/js/app.js" charset="utf-8"></script>

    </body>
</html>
