<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Lista de Pokémon - PokeDex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --pokemon-black: #1a1a1a;
            --pokemon-dark-gray: #2d2d2d;
            --pokemon-gray: #4a4a4a;
            --pokemon-light-gray: #6b6b6b;
            --pokemon-white: #ffffff;
            --pokemon-yellow: #ffcb05;
            --pokemon-yellow-dark: #ffb300;
            --pokemon-yellow-light: #ffe082;
        }
        
        body {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            min-height: 100vh;
            padding: 20px 0;
            color: var(--pokemon-white);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
            margin-bottom: 30px;
            background: var(--pokemon-dark-gray);
            border: 2px solid var(--pokemon-gray);
        }
        .card-header {
            background: linear-gradient(135deg, var(--pokemon-black) 0%, var(--pokemon-dark-gray) 100%);
            color: var(--pokemon-yellow);
            border-radius: 15px 15px 0 0 !important;
            padding: 30px;
            border-bottom: 3px solid var(--pokemon-yellow);
        }
        .card-header h1 {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
            font-weight: 800;
            letter-spacing: 1px;
        }
        .pokemon-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
            cursor: pointer;
            background: var(--pokemon-dark-gray);
            border: 2px solid var(--pokemon-gray);
        }
        .pokemon-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 50px rgba(255, 203, 5, 0.3);
            border-color: var(--pokemon-yellow);
        }
        .pokemon-sprite-container {
            background: linear-gradient(135deg, var(--pokemon-black) 0%, var(--pokemon-dark-gray) 100%);
            padding: 30px;
            text-align: center;
            min-height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 2px solid var(--pokemon-gray);
        }
        .pokemon-sprite-container img {
            max-width: 100%;
            max-height: 200px;
            filter: drop-shadow(0 5px 20px rgba(255, 203, 5, 0.4));
            transition: transform 0.3s;
        }
        .pokemon-card:hover .pokemon-sprite-container img {
            transform: scale(1.1);
        }
        .pokemon-name {
            font-size: 1.4rem;
            font-weight: 700;
            text-transform: capitalize;
            color: var(--pokemon-yellow);
            margin-bottom: 15px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
        }
        .pokemon-info-badge {
            background: var(--pokemon-black);
            border: 1px solid var(--pokemon-yellow);
            border-radius: 8px;
            padding: 8px 12px;
            margin: 5px;
            display: inline-block;
            font-size: 0.9rem;
            color: var(--pokemon-white);
        }
        .pokemon-info-badge i {
            color: var(--pokemon-yellow);
        }
        .search-section {
            background: var(--pokemon-dark-gray);
            border-radius: 15px;
            padding: 40px;
            margin-bottom: 30px;
            border: 2px solid var(--pokemon-gray);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .search-form-container {
            max-width: 800px;
            width: 100%;
        }
        .form-label {
            color: var(--pokemon-yellow);
            font-weight: 600;
        }
        .form-control {
            background: var(--pokemon-black);
            border: 2px solid var(--pokemon-gray);
            color: var(--pokemon-white);
            border-radius: 8px;
            font-size: 1.2rem;
            padding: 15px 20px;
        }
        .form-control:focus {
            background: var(--pokemon-black);
            border-color: var(--pokemon-yellow);
            color: var(--pokemon-white);
            box-shadow: 0 0 0 0.2rem rgba(255, 203, 5, 0.25);
        }
        .form-control::placeholder {
            color: var(--pokemon-light-gray);
        }
        .btn-search {
            background: linear-gradient(135deg, var(--pokemon-yellow) 0%, var(--pokemon-yellow-dark) 100%);
            border: none;
            padding: 15px 40px;
            font-weight: 700;
            border-radius: 8px;
            color: var(--pokemon-black);
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
            font-size: 1.1rem;
            height: 100%;
        }
        .btn-search:hover {
            background: linear-gradient(135deg, var(--pokemon-yellow-dark) 0%, var(--pokemon-yellow) 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 203, 5, 0.5);
            color: var(--pokemon-black);
        }
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: var(--pokemon-light-gray);
        }
        .empty-state i {
            font-size: 5rem;
            margin-bottom: 20px;
            opacity: 0.5;
            color: var(--pokemon-yellow);
        }
        .empty-state h3 {
            color: var(--pokemon-yellow);
        }
        .badge {
            background: var(--pokemon-yellow);
            color: var(--pokemon-black);
            font-weight: 600;
        }
        .alert {
            background: var(--pokemon-dark-gray);
            border: 2px solid var(--pokemon-gray);
            color: var(--pokemon-white);
        }
        .alert-success {
            border-color: #28a745;
        }
        .alert-danger {
            border-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="container">
            <!-- Header Card -->
            <div class="card mb-4">
                <div class="card-header text-center">
                    <h1 class="mb-2"><i class="bi bi-collection-fill"></i> Tu Lista de Pokémon</h1>
                    <p class="mb-0">Busca y guarda información de tus Pokémon favoritos</p>
                </div>
                <div class="card-body">
                    <!-- Mensajes de éxito/error -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Formulario de búsqueda -->
                    <div class="search-section">
                        <div class="search-form-container">
                            <form action="{{ route('pokemons.store') }}" method="POST">
                                @csrf
                                <div class="text-center mb-4">
                                    <label for="name" class="form-label fw-bold" style="font-size: 1.3rem; color: var(--pokemon-yellow);">Buscar Pokémon</label>
                                </div>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-9">
                                        <input 
                                            type="text" 
                                            name="name" 
                                            id="name"
                                            class="form-control" 
                                            placeholder="Escribe el nombre del Pokémon (ej: pikachu, bulbasaur, charizard)"
                                            required
                                            value="{{ old('name') }}"
                                        >
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary btn-search w-100">
                                            <i class="bi bi-search"></i> Buscar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid de Pokémon -->
            @if($pokemons->isEmpty())
                <div class="card">
                    <div class="card-body">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <h3>No hay Pokémon guardados aún</h3>
                            <p class="lead">Busca un Pokémon usando el formulario de arriba para comenzar tu colección.</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0"><i class="bi bi-collection"></i> Mi Colección ({{ $pokemons->count() }})</h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            @foreach($pokemons as $pokemon)
                                <div class="col-md-3 col-lg-3">
                                    <a href="{{ route('pokemons.show', $pokemon->id) }}" class="text-decoration-none">
                                        <div class="card pokemon-card h-100">
                                            <div class="pokemon-sprite-container">
                                                @if($pokemon->sprite_url)
                                                    <img src="{{ $pokemon->sprite_url }}" alt="{{ $pokemon->name }}" class="img-fluid">
                                                @else
                                                    <i class="bi bi-question-circle" style="font-size: 5rem; color: #ccc;"></i>
                                                @endif
                                            </div>
                                            <div class="card-body text-center">
                                                <h5 class="pokemon-name">{{ $pokemon->name }}</h5>
                                                <div class="d-flex flex-wrap justify-content-center">
                                                    @if($pokemon->base_experience)
                                                        <span class="pokemon-info-badge">
                                                            <i class="bi bi-star-fill text-warning"></i> {{ $pokemon->base_experience }} XP
                                                        </span>
                                                    @endif
                                                    @if($pokemon->height)
                                                        <span class="pokemon-info-badge">
                                                            <i class="bi bi-arrows-vertical"></i> {{ $pokemon->height }} dm
                                                        </span>
                                                    @endif
                                                    @if($pokemon->weight)
                                                        <span class="pokemon-info-badge">
                                                            <i class="bi bi-speedometer2"></i> {{ $pokemon->weight }} hg
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="mt-3">
                                                    <span class="badge bg-primary">Ver detalles <i class="bi bi-arrow-right"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
