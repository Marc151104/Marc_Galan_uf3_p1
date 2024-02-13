<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\Configuration\Merger;

class FilmController extends Controller
{
    /**
     * Read films from storage
     */
    public static function readFilms(): array
    {
        $filmsjson = Storage::json('/public/films.json');
        $filmsbbdd = DB::table("films")->select('name', 'year', 'genre', 'country', 'duration', 'img_url')->get();
        $actorsArray = json_decode(json_encode($filmsbbdd), true);
        $films = array_merge($filmsjson, $actorsArray);
        return $films;
    }
    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {
        $old_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Antiguas (Antes de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year and genre are null
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year or genre informed
        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            } else if ((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)) {
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            } else if (!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x categoria y año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    public function listFilmsByYear($year = null)
    {
        $title = "Listado de Pelis por Año";

        $films = FilmController::readFilms();
        foreach ($films as $film) {
            if (strtolower($film['year']) == strtolower($year)) {
                $films_filtered[] = $film;
            }

            return view('films.list', ['films' => $films_filtered, "title" => $title]);
        }
    }
    public function listFilmsByGenre($genre = null)
    {
        $title = "Listado de Pelis por Género";
        $films = FilmController::readFilms();
        $films_filtered = [];

        foreach ($films as $film) {
            if (strtolower($film['genre']) == strtolower($genre)) {
                $films_filtered[] = $film;
            }
        }

        // Ordenar películas por título alfabéticamente
        usort($films_filtered, function ($a, $b) {
            return strcasecmp($a['genre'], $b['genre']);
        });


        return view('films.list', ['films' => $films_filtered, 'title' => $title]);
    }



    public function sortFilms()
    {

        $title = "Ordenar Pelis por Año";
        $films = FilmController::readFilms();
        usort($films, function ($a, $b) {
            return $b['year'] - $a['year'];
        });
        return view('films.list', ['films' => $films, "title" => $title]);
    }

    public function countFilms()
    {
        $Films = FilmController::readFilms();
        $totalFilms = count($Films);
        return view('films.counter', ['totalFilms' => $totalFilms]);
    }


    public function createFilm()
    {
        $source = env('Base_Data', 'database');
        $filmExis = FilmController::isFilm($_POST["name"]);
        if ($filmExis) {
            return view('welcome', ["Error" => "Sorry but this film exists"]);
        } else {
            $films = FilmController::readFilms();
            $film = [
                "name" => $_POST["name"],
                "country" => $_POST["country"],
                "duration" => $_POST["duration"],
                "year" => $_POST["year"],
                "genre" => $_POST["genre"],
                "img_url" => $_POST["urlImage"]
            ];
            if ($filmExis) {
                return view('welcome', ["Error" => "Sorry but this film exists"]);
            } else {
                if ($source === 'json') {
                    $films[] = $film;
                    $jsonFilm = json_encode($films, JSON_PRETTY_PRINT);
                    Storage::put('public/films.json', $jsonFilm);
                } else {
                    DB::table('films')->insert($film);
                }
                $title = "Listado de Pelis";
                $films = FilmController::readFilms();
                return view('films.list', ["films" => $films, "title" => $title]);
            }
        }
    }
    public function isFilm($name = null): bool
    {
        $films = FilmController::readFilms();
        $filmExist = false;
        foreach ($films as $film) {

            if ($film["name"] == $name) {

                $filmExist = true;
            }
        }
        return $filmExist;
    }
}
