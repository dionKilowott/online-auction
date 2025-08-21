<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome</title>
    </head>
    <body>
        <header>
            <nav>
                <a href="{{ route('register') }}">Register</a>
                <a href="{{ route('login') }}">Log in</a>

             

            </nav>
        </header>
     
           @auth
                   <span>
                        Hi There, {{ Auth::user()->name }}  <!-- uses the auth facade to acess the current user (model) and gets the attribute name -->
                    </span>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @endauth
    </body>
</html>
