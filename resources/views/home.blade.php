<x-guest-layout>
    <div class="flex justify-around">
        @auth
            <a href="{{ url('/dashboard') }}">Dashboard</a>
        @else
            <a href="{{ route('login') }}">Entrar</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Registrar</a>
            @endif
        @endauth
    </div>
</x-guest-layout>
