
@include('layouts.header')

<main class="container"></main>
    <h1>soy una vista</h1>
    nombre: {{ $nombre }}
    <hr>
    numero: {{ $numero }}
    <hr>
    @if ($numero < 100)
        es menor
    @else
        no es menor
    @endif

    <ul>
        @foreach($datos as $clave => $elemento)
        <li>{{ $elemento }}</li>
        @endforeach
    </ul>
</main>

@include ('layouts.footer')
