<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function index()
    {
        $users = DB::table('puntos_carga')->get();

        // Convertir a array
        $data = json_decode($users, true);

        // Crear estructura GeoJSON
        $geojson = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );

        // Llenar GeoJSON con datos
        foreach ($data as $item) {
            $feature = array(
                'type' => 'Feature',
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array((float)$item['longitud'], (float)$item['latitud'])
                ),
                // Propiedades adicionales
                'properties' => array(
                    'id' => $item['id'],
                    'ubicacion' => $item['ubicacion'],
                    'potencia' => $item['potencia'],
                    'funciona' => $item['funciona'],
                    'ultimo_mantenimiento' => $item['ultimo_mantenimiento']
                )
            );

            // Añadir al array de características
            array_push($geojson['features'], $feature);
        }

        // Convertir a JSON
        $geojson = json_encode($geojson);

        return $geojson;
    }
}
