<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
    /**
     * Read Actors from storage
     */
    public static function readActors()
    {
        $actors = DB::table("actors")->select('name', 'surename', 'birtdate', 'country', 'img_url')->get();
        $actorsArray = json_decode(json_encode($actors), true);
        return $actorsArray;
    }
    /**
     * Lista TODOS los actores
     */
    public function listActors()
    {
        $title = "Listado de todas los actores";
        $actors = ActorController::readActors();

        return view("actors.list", ["actors" => $actors, "title" => $title]);
    }

    public function listActorsDecade()
    {

        $decadaSeleccionada = $_GET['decada'];

        $decadaInicio = $decadaSeleccionada;
        $decadaFin = $decadaInicio + 10;

        $actorsList = ActorController::readActors();

        $actors = array();

        foreach ($actorsList as $actor) {
            $añoNacimiento = $actor['birtdate'];
            if ($añoNacimiento >= $decadaInicio && $añoNacimiento <= $decadaFin) {
                $actors[] = $actor;
            }
        }
        $decadaFin = $decadaInicio + 9;
        $title = "Listado de Actores por Década ($decadaInicio - $decadaFin)";
        return view('actors.list', ['actors' => $actors, 'title' => $title]);
    }

    public function countActors()
    {
        $Actors = ActorController::readActors();
        $totalActors = count($Actors);
        return view('actors.counter', ['totalActors' => $totalActors]);
    }

    public function deleteActors($id)
    {
        $actorToDelete = DB::table('actors')
            ->where('id', $id)
            ->delete();
        if ($actorToDelete) {
            return response()->json(['action' => $actorToDelete, 'status' => 'True']);
        }else{
            return response()->json(['action' => $actorToDelete, 'status' => 'False']);
        }

    }
}
