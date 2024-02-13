<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>

    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Add your custom styles here -->
    <style>
        body {
            background-color: #f8f9fa;
            color: #495057;
            font-family: 'Arial', sans-serif;
            padding-top: 5rem;
            margin-bottom: 5rem;
        }

        h1 {
            color: #007bff;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        form {
            max-width: 400px;
            margin: auto;
        }

        /* Header Styles */
        header {
            color: #ffffff;
            text-align: center;
        }

        /* Footer Styles */
        footer {
            width: 100%;
            color: #ffffff;
            text-align: center;
        }
    </style>
</head>


<body class="container">
    <header>
        <h1 class="mt-4">CABECERA DE LA WEB(MASTER)</h1>
    </header>
    <h1 class="mt-4">Lista de Películas</h1>
    <ul>
        <li><a href="/filmout/oldFilms">Pelis antiguas</a></li>
        <li><a href="/filmout/newFilms">Pelis nuevas</a></li>
        <li><a href="/filmout/filmsByYear">Ordenar Por Año</a></li>
        <li><a href="/filmout/filmsByGenre">Ordenar Por Género</a></li>
        <li><a href="/filmout/listFilms">Listar Pelis</a></li>
        <li><a href="/filmout/sortFilms">Ordenar Pelis</a></li>
        <li><a href="/filmout/countFilms">Contar Pelis</a></li>
    </ul>
    <h1 class="mt-4">Lista de Actores</h1>
    <ul>
        <li><a href="/actorout/actors">List Actors</a></li>
        <div>
            <form action="{{ route('listActorsDecade') }}" method="get">
                <label for="decada">Selecciona una década:</label>
                <select name="decada" id="decada">
                    <option value="1970">1970s</option>
                    <option value="1980">1980s</option>
                    <option value="1990">1990s</option>
                    <option value="2000">2000s</option>
                    <option value="2010">2010s</option>
                    <option value="2020">2020s</option>
                </select>
                <button type="submit">Filtrar</button>
            </form>
        </div>
        <li><a href="/actorout/countActors">Contar Actores</a></li>
    </ul>

    <h1>Create a New Film</h1>
    <form action="{{ route('createFilm') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="year">Año:</label>
            <input type="number" class="form-control" id="year" name="year" required>
        </div>
        <div class="form-group">
            <label for="genre">Género: </label>
            <input type="text" class="form-control" id="genre" name="genre" required>
        </div>
        <div class="form-group">
            <label for="country">País: </label>
            <input type="text" class="form-control" id="country" name="country" required>
        </div>
        <div class="form-group">
            <label for="duration">Duración: </label>
            <input type="text" class="form-control" id="duration" name="duration" required>
        </div>
        <div class="form-group">
            <label for="urlImage">Imagen URL: </label>
            <input type="text" class="form-control" id="urlImage" name="urlImage" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    <footer>
        <h1>PIE DE PAGINA (MASTER)</h1>
    </footer>
    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Include any additional HTML or Blade directives here -->

</body>

</html>