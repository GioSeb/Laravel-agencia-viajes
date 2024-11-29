<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

//Route::view('peticion','nombreVista)
Route::view('/vista', 'vista');

//para ejecutar codigo
//route::get('peticion', accion);
Route::get('/mensaje.html', function(){
    return 'hola mundo desde laravel';
}
);
Route::get('/vista', function(){
    $nombre = 'sebastian';
    $numero = 50;
    $datos = [
        'curso'=>'Desarrollo con laravel',
        'codigo'=>71994,
        'inicio'=>'04/11/2024',
        'fin'=>'16/12/2024'
    ];
    return view('vista', ['nombre'=>$nombre,
                            'numero'=>10,
                            'datos'=>$datos]);
});

Route::view('/nav', 'navbar');
Route::view('/hero', 'hero');
Route::get('/proveedores', function(){
    //obtenemos el listado de proveedores
    $proveedores = DB::select('SELECT * FROM proveedores');
    //retornamos la vista
    return view('proveedores', [ 'proveedores' => $proveedores]);
});

Route::view('/', 'plantilla');

#CRUD de regiones
Route::get('/regiones', function(){
    //Obtenemos el listado de regiones
    /*$regiones=DB::select('SELECT * FROM regiones ORDER BY idRegion DESC');*/
    $regiones = DB::table('regiones')->orderBy('idRegion', 'DESC')->get();
    //retornamos la vista regiones
    return view('regiones', ['regiones'=>$regiones]);
});

Route::get('/destinos', function(){
    //obtenemos listado de destinos
    $destinos = DB::table('destinos as d')
    ->join('regiones as r', 'd.idRegion', '=', 'r.idRegion')
    ->orderBy('idDestino')
    ->get();
    //retornamos la vista destinos
    return view('destinos', [ 'destinos'=>$destinos ]);
    /*dd($destinos);*/
});

Route::get('/destino/create', function(){
    //obtenemos listado de regiones
    $regiones = DB::table('regiones')->get();

    return view('destinoCreate', ['regiones'=>$regiones]);
});

Route::post('/destino/store', function(){
    //Capturamos datos enviados por el form
    //$aeropuerto = request()->aeropuerto;
    $aeropuerto = request('aeropuerto');
    $precio = request('precio');
    $idRegion = request('idRegion');
    try {
        //raw sql
        /*DB::insert('INSERT INTO destinos
                            ( aeropuerto, precio, idRegion )
                            VALUE
                            (:aeropuerto, :precio, :idRegion)',
                            [ $aeropuerto, $precio, $idRegion] //bindings por orden
        );*/
        DB::table('destinos')
        ->insert([
            'aeropuerto'=>$aeropuerto,
            'precio'=>$precio,
            'idRegion'=>$idRegion,
            'activo'=>1
        ]);
        return redirect('/destinos')
                        ->with(
                            [
                                'css'=>'green',
                                'mensaje'=>'Destino:' .$aeropuerto. ' agregado correctamente',
                            ]
                            );
    } catch(Throwable $th) {
        return redirect('/destinos')
        ->with(
            [
                'css'=>'red',
                'mensaje'=>'No se pudo agregar el destino: '.$aeropuerto
            ]
            );
};

});

Route::get('/region/create', function(){
    return view('regionCreate');
});

Route::post('/region/store', function () {
    $nombre = request('nombre');

    try {
        DB::table('regiones')
        ->insert([
            'nombre'=>$nombre
        ]);
        return redirect('/regiones')
        ->with(
            [
                'css'=>'green',
                'mensaje'=>'Region:' .$nombre. ' agregado correctamente',
            ]
            );
    } catch (\Throwable $th) {
        return redirect('/regiones')
        ->with(
            [
                'css'=>'red',
                'mensaje'=>'No se pudo agregar el destino: '.$nombre
            ]
            );
    }
});

Route::get('/destino/edit/{idDestino}', function($idDestino)
{
    //Obtenemos listado de regiones
    $regiones = DB::table('regiones')->get();
    //Obtenemos datos de destino por id
    $destino = DB::table('destinos')
                        ->where('idDestino', $idDestino)
                        ->first();
    //Retornamos la vista pasandole estos datos
    return view('destinoEdit', [
        'regiones'=>$regiones,
        'destino'=>$destino
    ]);
});
