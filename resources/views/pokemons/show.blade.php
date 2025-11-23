<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($pokemon->name) }} - Tu Lista de Pokémon</title>
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
            max-width: 1200px;
            margin: 0 auto;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
            overflow: hidden;
            background: var(--pokemon-dark-gray);
            border: 2px solid var(--pokemon-gray);
        }
        .pokemon-header {
            background: linear-gradient(135deg, var(--pokemon-black) 0%, var(--pokemon-dark-gray) 100%);
            color: var(--pokemon-yellow);
            padding: 40px;
            text-align: center;
            border-bottom: 3px solid var(--pokemon-yellow);
        }
        .pokemon-sprite-large {
            max-width: 300px;
            max-height: 300px;
            filter: drop-shadow(0 10px 30px rgba(255, 203, 5, 0.5));
            margin: 20px 0;
        }
        .pokemon-name-large {
            font-size: 3rem;
            font-weight: 800;
            text-transform: capitalize;
            margin: 20px 0;
            text-shadow: 2px 2px 6px rgba(0,0,0,0.8);
            color: var(--pokemon-yellow);
        }
        .info-card {
            background: var(--pokemon-black);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid var(--pokemon-yellow);
            border: 2px solid var(--pokemon-gray);
        }
        .info-label {
            font-weight: 600;
            color: var(--pokemon-yellow);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .info-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--pokemon-white);
            margin-top: 5px;
        }
        .btn-back {
            background: var(--pokemon-yellow);
            color: var(--pokemon-black);
            border: 2px solid var(--pokemon-yellow);
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 700;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-back:hover {
            background: var(--pokemon-yellow-dark);
            border-color: var(--pokemon-yellow-dark);
            color: var(--pokemon-black);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 203, 5, 0.5);
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .card-body {
            background: var(--pokemon-dark-gray);
            color: var(--pokemon-white);
        }
        .card.bg-light {
            background: var(--pokemon-black) !important;
            border: 2px solid var(--pokemon-gray);
        }
        .card-title {
            color: var(--pokemon-yellow);
        }
        .btn-primary {
            background: var(--pokemon-yellow);
            border-color: var(--pokemon-yellow);
            color: var(--pokemon-black);
            font-weight: 700;
        }
        .btn-primary:hover {
            background: var(--pokemon-yellow-dark);
            border-color: var(--pokemon-yellow-dark);
            color: var(--pokemon-black);
        }
        .btn-outline-secondary {
            border-color: var(--pokemon-gray);
            color: var(--pokemon-white);
        }
        .btn-outline-secondary:hover {
            background: var(--pokemon-gray);
            border-color: var(--pokemon-gray);
            color: var(--pokemon-white);
        }
        .text-muted {
            color: var(--pokemon-light-gray) !important;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="container">
            <!-- Botón de volver -->
            <div class="mb-4">
                <a href="{{ route('pokemons.index') }}" class="btn btn-back">
                    <i class="bi bi-arrow-left"></i> Volver a la colección
                </a>
            </div>

            <!-- Card principal del Pokémon -->
            <div class="card">
                <div class="pokemon-header">
                    @if($pokemon->sprite_url)
                        <img src="{{ $pokemon->sprite_url }}" alt="{{ $pokemon->name }}" class="pokemon-sprite-large img-fluid">
                    @else
                        <i class="bi bi-question-circle" style="font-size: 10rem; opacity: 0.5;"></i>
                    @endif
                    <h1 class="pokemon-name-large">{{ $pokemon->name }}</h1>
                </div>

                <div class="card-body p-4">
                    <!-- Estadísticas del Pokémon -->
                    <div class="stats-grid">
                        @if($pokemon->base_experience)
                            <div class="info-card">
                                <div class="info-label">
                                    <i class="bi bi-star-fill text-warning"></i> Experiencia Base
                                </div>
                                <div class="info-value">{{ $pokemon->base_experience }}</div>
                                <small class="text-muted">Puntos de experiencia base</small>
                            </div>
                        @endif

                        @if($pokemon->height)
                            <div class="info-card">
                                <div class="info-label">
                                    <i class="bi bi-arrows-vertical"></i> Altura
                                </div>
                                <div class="info-value">{{ $pokemon->height }} dm</div>
                                <small class="text-muted">Decímetros</small>
                            </div>
                        @endif

                        @if($pokemon->weight)
                            <div class="info-card">
                                <div class="info-label">
                                    <i class="bi bi-speedometer2"></i> Peso
                                </div>
                                <div class="info-value">{{ $pokemon->weight }} hg</div>
                                <small class="text-muted">Hectogramos</small>
                            </div>
                        @endif

                        <div class="info-card">
                            <div class="info-label">
                                <i class="bi bi-calendar3"></i> Fecha de Registro
                            </div>
                            <div class="info-value" style="font-size: 1rem;">
                                {{ $pokemon->created_at->format('d/m/Y') }}
                            </div>
                            <small class="text-muted">{{ $pokemon->created_at->format('H:i:s') }}</small>
                        </div>
                    </div>

                    <!-- Información adicional -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="bi bi-info-circle"></i> Información del Pokémon
                                    </h5>
                                    <p class="card-text">
                                        Este Pokémon fue guardado en tu PokeDex el {{ $pokemon->created_at->format('d') }} de {{ $pokemon->created_at->locale('es')->monthName }} de {{ $pokemon->created_at->format('Y') }}.
                                        @if($pokemon->updated_at != $pokemon->created_at)
                                            <br>Última actualización: {{ $pokemon->updated_at->format('d/m/Y H:i:s') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="mt-4 text-center">
                        <a href="{{ route('pokemons.index') }}" class="btn btn-primary btn-lg me-2">
                            <i class="bi bi-house"></i> Volver al inicio
                        </a>
                        <button onclick="window.history.back()" class="btn btn-outline-secondary btn-lg">
                            <i class="bi bi-arrow-left-circle"></i> Atrás
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

