<?php
    use Illuminate\Http\Request;

    Route::middleware('api')->group(function(){
/** AuthController */
        Route::post('ingresar', 'API\AuthController@doIngresar');

/** NoticiaController */
        Route::get('noticias', 'API\NoticiaController@getAll');

        Route::middleware('auth:api')->group(function(){
/** UsuarioController */
            Route::get('usuarios', 'API\UsuarioController@getAll');

/** CategoriaController */
            Route::get('categorias', 'API\CategoriaController@getAll');

/** TemaController */
            Route::get('temas', 'API\TemaController@getAll');

/** EventoController */
            Route::get('eventos', 'API\EventoController@getAll');

/** NormativaController */
            Route::get('normativas', 'API\NormativaController@getAll');
            Route::get('normativas/{id_normativa}', 'API\NormativaController@getAll');

/** GestionController */
            Route::get('gestiones', 'API\GestionController@getAll');
            Route::get('gestiones/{id_gestion}', 'API\GestionController@getAll');

/** EducacionController */
            Route::get('educaciones', 'API\EducacionController@getAll');

/** PrecioController */
            Route::get('precios', 'API\PrecioController@getAll');

/** PreguntaController */
            Route::get('preguntas', 'API\PreguntaController@getAll');

/** SuscripcionController */
            Route::get('suscripciones', 'API\SuscripcionController@getAll');
            Route::get('facturaciones', 'API\SuscripcionController@getFacturaciones');
        });
    });