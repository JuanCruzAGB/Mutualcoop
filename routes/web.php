<?php
/** * WebController */
    Route::get('/', 'WebController@inicio')->name('web.inicio');
    Route::middleware('auth')->group(function(){
        Route::get('/dashboard', 'WebController@dashboard')->name('web.dashboard');
    });

/** * CorreoController */
    Route::post('/contactar', 'CorreoController@contactar')->name('correo.contactar');
    Route::post('/consultar', 'CorreoController@consultar')->name('correo.consultar');
    Route::get('/gracias', 'CorreoController@gracias')->name('correo.gracias');
    Route::post('/cambiar-clave', 'CorreoController@cambiarClave')->name('correo.cambiarClave');

/** * AuthController */
    Route::post('/registrar', 'AuthController@doRegistrar')->name('auth.doRegistrar');
    Route::get('/ingresar', 'AuthController@showIngresar')->name('auth.showIngresar');
    Route::post('/ingresar', 'AuthController@doIngresar')->name('auth.doIngresar');
    Route::get('/email/{token}/confirm', 'AuthController@doConfirmEmail')->name('auth.doConfirmEmail');
    Route::get('/password/{token}/reset', 'AuthController@showPasswordReset')->name('auth.showPasswordReset');
    Route::post('/password/reset', 'AuthController@doPasswordResetForm')->name('auth.doPasswordResetForm');
    Route::middleware('auth')->group(function(){
        Route::get('/salir', 'AuthController@doSalir')->name('auth.doSalir');
    });

/** * NoticiaController */
    Route::get('/noticias', 'NoticiaController@listado')->name('noticia.listado');
    Route::get('/noticia/{slug}', 'NoticiaController@detalles')->name('noticia.detalles');
    Route::middleware('auth')->group(function(){
        Route::middleware('admin')->group(function(){
            Route::get('/panel/noticias', 'NoticiaController@panel')->name('noticia.panel');
            Route::get('/panel/noticia/crear', 'NoticiaController@showCrear')->name('noticia.showCrear');
            Route::post('/noticia/crear', 'NoticiaController@doCrear')->name('noticia.doCrear');
            Route::get('/panel/noticia/{slug}/editar', 'NoticiaController@showEditar')->name('noticia.showEditar');
            Route::put('/noticia/{id_noticia}/editar', 'NoticiaController@doEditar')->name('noticia.doEditar');
            Route::delete('/noticia/{id_noticia}/eliminar', 'NoticiaController@doEliminar')->name('noticia.doEliminar');

/** * EventoController */
            Route::get('/panel/eventos', 'EventoController@panel')->name('evento.panel');
            Route::get('/panel/evento/crear', 'EventoController@showCrear')->name('evento.showCrear');
            Route::post('/evento/crear', 'EventoController@doCrear')->name('evento.doCrear');
            Route::get('/panel/evento/{id_evento}/editar', 'EventoController@showEditar')->name('evento.showEditar');
            Route::put('/evento/{id_evento}/editar', 'EventoController@doEditar')->name('evento.doEditar');
            Route::delete('/evento/{id_evento}/eliminar', 'EventoController@doEliminar')->name('evento.doEliminar');

        });

/** * NormativaController */
        Route::get('/normativas', 'NormativaController@listado')->name('normativa.listado');
        Route::get('/normativas/{tipo_slug}', 'NormativaController@listado')->name('normativa.listadoPorTipo');
        Route::middleware('admin')->group(function(){
            Route::get('/panel/normativas', 'NormativaController@panel')->name('normativa.panel');
            Route::get('/panel/normativa/crear', 'NormativaController@showCrear')->name('normativa.showCrear');
            Route::post('/normativa/crear', 'NormativaController@doCrear')->name('normativa.doCrear');
            Route::get('/panel/normativa/{slug}/editar', 'NormativaController@showEditar')->name('normativa.showEditar');
            Route::put('/normativa/{id_normativa}/editar', 'NormativaController@doEditar')->name('normativa.doEditar');
            Route::delete('/normativa/{id_normativa}/eliminar', 'NormativaController@doEliminar')->name('normativa.doEliminar');
        
/** * UsuarioController */
            Route::get('/panel/usuarios', 'UsuarioController@panel')->name('usuario.panel');
            Route::get('/panel/usuario/crear', 'UsuarioController@showCrear')->name('usuario.showCrear');
            Route::post('/usuario/crear', 'UsuarioController@doCrear')->name('usuario.doCrear');
            Route::get('/panel/usuario/{slug}/editar', 'UsuarioController@showEditar')->name('usuario.showEditar');
            Route::put('/usuario/{id_usuario}/editar', 'UsuarioController@doEditar')->name('usuario.doEditar');
            Route::delete('/usuario/{id_usuario}/eliminar', 'UsuarioController@doEliminar')->name('usuario.doEliminar');

/** * SuscripcionController */
            Route::get('/panel/suscriptores', 'SuscripcionController@suscriptores')->name('usuario.suscriptores');
            Route::get('/panel/facturaciones', 'SuscripcionController@facturaciones')->name('usuario.facturaciones');
            Route::post('/usuario/{id_usuario}/aprobar', 'SuscripcionController@aprobar')->name('usuario.showEditar');

        });

/** * GestionController */
        Route::get('/gestiones', 'GestionController@listado')->name('gestion.listado');
        Route::get('/gestiones/{tipo_slug}', 'GestionController@listado')->name('gestion.listadoPorTipo');
        Route::middleware('admin')->group(function(){
            Route::get('/panel/gestiones', 'GestionController@panel')->name('gestion.panel');
            Route::get('/panel/gestion/crear', 'GestionController@showCrear')->name('gestion.showCrear');
            Route::post('/gestion/crear', 'GestionController@doCrear')->name('gestion.doCrear');
            Route::get('/panel/gestion/{slug}/editar', 'GestionController@showEditar')->name('gestion.showEditar');
            Route::put('/gestion/{id_gestion}/editar', 'GestionController@doEditar')->name('gestion.doEditar');
            Route::delete('/gestion/{id_gestion}/eliminar', 'GestionController@doEliminar')->name('gestion.doEliminar');
            
/** * CategoriaController */
            Route::get('/panel/categorias', 'CategoriaController@panel')->name('categoria.panel');
            Route::get('/panel/categoria/crear', 'CategoriaController@showCrear')->name('categoria.showCrear');
            Route::post('/categoria/crear', 'CategoriaController@doCrear')->name('categoria.doCrear');
            Route::get('/panel/categoria/{slug}/editar', 'CategoriaController@showEditar')->name('categoria.showEditar');
            Route::put('/categoria/{id_categoria}/editar', 'CategoriaController@doEditar')->name('categoria.doEditar');
            Route::delete('/categoria/{id_categoria}/eliminar', 'CategoriaController@doEliminar')->name('categoria.doEliminar');

/** * TemaController */
            Route::get('/panel/temas', 'TemaController@panel')->name('tema.panel');
            Route::get('/panel/tema/crear', 'TemaController@showCrear')->name('tema.showCrear');
            Route::post('/tema/crear', 'TemaController@doCrear')->name('tema.doCrear');
            Route::get('/panel/tema/{slug}/editar', 'TemaController@showEditar')->name('tema.showEditar');
            Route::put('/tema/{id_tema}/editar', 'TemaController@doEditar')->name('tema.doEditar');
            Route::delete('/tema/{id_tema}/eliminar', 'TemaController@doEliminar')->name('tema.doEliminar');
        
        });

/** * EducacionController */
        Route::get('/educaciones', 'EducacionController@listado')->name('educacion.listado');
        Route::middleware('admin')->group(function(){
            Route::get('/panel/educaciones', 'EducacionController@panel')->name('educacion.panel');
            Route::get('/panel/educacion/crear', 'EducacionController@showCrear')->name('educacion.showCrear');
            Route::post('/educacion/crear', 'EducacionController@doCrear')->name('educacion.doCrear');
            Route::get('/panel/educacion/{slug}/editar', 'EducacionController@showEditar')->name('educacion.showEditar');
            Route::put('/educacion/{id_educacion}/editar', 'EducacionController@doEditar')->name('educacion.doEditar');
            Route::delete('/educacion/{id_educacion}/eliminar', 'EducacionController@doEliminar')->name('educacion.doEliminar');
        
/** * PrecioController */
            Route::get('/panel/precios', 'PrecioController@panel')->name('precio.panel');
            Route::get('/panel/precio/{id_precio}/editar', 'PrecioController@showEditar')->name('precio.showEditar');
            Route::put('/precio/{id_educacion}/editar', 'PrecioController@doEditar')->name('precio.doEditar');
        
/** * PreguntaController */
            Route::get('/panel/preguntas', 'PreguntaController@panel')->name('pregunta.panel');
            Route::get('/panel/pregunta/crear', 'PreguntaController@showCrear')->name('pregunta.showCrear');
            Route::post('/pregunta/crear', 'PreguntaController@doCrear')->name('pregunta.doCrear');
            Route::get('/panel/pregunta/{id_pregunta}/editar', 'PreguntaController@showEditar')->name('pregunta.showEditar');
            Route::put('/pregunta/{id_educacion}/editar', 'PreguntaController@doEditar')->name('pregunta.doEditar');
            Route::delete('/pregunta/{id_pregunta}/eliminar', 'PreguntaController@doEliminar')->name('pregunta.doEliminar');
        });
    });
