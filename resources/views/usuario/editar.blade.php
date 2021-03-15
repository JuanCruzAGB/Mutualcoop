@extends('layout.panel')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/poncho/icono-arg.css') }}">
    <link href={{ asset('css/datepicker/datepicker.min.css') }} rel="stylesheet" />
    <link href={{ asset('css/tw.css') }} rel="stylesheet" />
    <link href={{ asset('css/auth/auth.css') }} rel="stylesheet" />
    <link href={{ asset('css/usuario/editar.css') }} rel="stylesheet">
@endsection

@section('nav')
@component('components.nav.panel', ['current' => 'panel'])
@endcomponent
@endsection

@section('title')
    Editar "{{$usuario->nombre}}"
@endsection

@section('main')
    <header class="md:flex md:justify-center background background-dos w-full">
        <section class="form-container mx-auto w-10/12 md:w-6/12 lg:w-5/12 background background-dos px-6">
            <form id="usuario-editar" class="px-4 my-12 rounded-lg lg:px-4 rounded w-full bg-white none" action="/usuario/{{$usuario->id_usuario}}/editar" method="post"
                data-rules="{{json_encode($validation->rules)}}"
                data-messages="{{json_encode($validation->messages)}}">
                <header>
                    <h2 class="text-2xl text-center py-8">Editar "{{$usuario->nombre}}"</h2>
                </header>
                @csrf
                @method('PUT')
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input name="id_suscriptor"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="number" placeholder="Número de Suscriptor" value="{{old('id_suscriptor', $usuario->id_suscriptor)}}">
                    @if($errors->has('id_suscriptor'))
                        <span class="support support-box support-id_suscriptor error pl-1 font-bold w-full">{{$errors->first('id_suscriptor')}}</span>
                    @else
                        <span class="support support-box support-id_suscriptor error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input name="nombre"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="text" placeholder="Nombre *" title="Campo obligatorio" value="{{old('nombre', $usuario->nombre)}}">
                    @if($errors->has('nombre'))
                        <span class="support support-box support-nombre error pl-1 font-bold w-full">{{$errors->first('nombre')}}</span>
                    @else
                        <span class="support support-box support-nombre error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input name="correo"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="email" placeholder="Email *" title="Campo obligatorio" value="{{old('correo', $usuario->correo)}}">
                    @if($errors->has('correo'))
                        <span class="support support-box support-correo error pl-1 font-bold w-full">{{$errors->first('correo')}}</span>
                    @else
                        <span class="support support-box support-correo error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input id="clave" name="clave" placeholder="Contraseña"
                        class="form-input confirmation w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="password">
                    <label for="clave" class="ver-password">
                        <i class="fas fa-eye"></i>
                    </label>
                    @if($errors->has('clave'))
                        <span class="support support-box support-clave error pl-1 font-bold w-full">{{$errors->first('clave')}}</span>
                    @else
                        <span class="support support-box support-clave error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                    <input id='clave_confirmation' name="clave_confirmation" placeholder="Repite tu contraseña"
                        class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="password">
                    <label for="clave_confirmation" class="ver-password">
                        <i class="fas fa-eye"></i>
                    </label>
                    @if($errors->has('clave_confirmation'))
                        <span class="support support-box support-clave_confirmation error pl-1 font-bold w-full">{{$errors->first('clave_confirmation')}}</span>
                    @else
                        <span class="support support-box support-clave_confirmation error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="mb-4 flex justify-center flex-wrap mb-8 outline-none">
                    <select class="form-input p-3 outline-none bg-white" name="id_nivel" title="Campo obligatorio">
                        <option {{ !old("id_nivel", $usuario->id_nivel) ? 'selected' : '' }} disabled>Nivel de Usuario</option>
                            <option {{ old('id_nivel', $usuario->id_nivel) == 1 ? 'selected' : '' }} value="1">Suscriptor</option>
                            <option {{ old('id_nivel', $usuario->id_nivel) == 2 ? 'selected' : '' }} value="2">Administrador</option>
                    </select>
                    @if($errors->has('id_nivel'))
                        <span class="support support-box support-id_nivel error pl-1 font-bold w-full">{{$errors->first('id_nivel')}}</span>
                    @else
                        <span class="support support-box support-id_nivel error pl-1 font-bold w-full"></span>
                    @endif
                </div>
                <div class="suscriptor hidden">
                    <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                        <input name="entidad"
                            class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text" placeholder="Entidad *" title="Campo obligatorio" value="{{old('entidad', $usuario->entidad)}}">
                    @if($errors->has('entidad'))
                        <span class="support support-box support-entidad error pl-1 font-bold w-full">{{$errors->first('entidad')}}</span>
                    @else
                        <span class="support support-box support-entidad error pl-1 font-bold w-full"></span>
                    @endif
                    </div>
                    <div class="mb-4 flex justify-center flex-wrap mb-8 outline-none">
                        <select class="form-input p-3 outline-none bg-white w-full" title="Campo obligatorio" name="provincia">
                            <option {{ !old("provincia") ? 'selected' : '' }} disabled>Provincia</option>
                        </select>
                    @if($errors->has('provincia'))
                        <span class="support support-box support-provincia error pl-1 font-bold w-full">{{$errors->first('provincia')}}</span>
                    @else
                        <span class="support support-box support-provincia error pl-1 font-bold w-full"></span>
                    @endif
                    </div>
                    <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                        <input name="direccion"
                            class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text" placeholder="Dirección" value="{{old('direccion', $usuario->direccion)}}">
                    @if($errors->has('direccion'))
                        <span class="support support-box support-direccion error pl-1 font-bold w-full">{{$errors->first('direccion')}}</span>
                    @else
                        <span class="support support-box support-direccion error pl-1 font-bold w-full"></span>
                    @endif
                    </div>
                    <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                        <input name="telefono"
                            class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text" placeholder="Teléfono *" title="Campo obligatorio" value="{{old('telefono', $usuario->telefono)}}">
                    @if($errors->has('telefono'))
                        <span class="support support-box support-telefono error pl-1 font-bold w-full">{{$errors->first('telefono')}}</span>
                    @else
                        <span class="support support-box support-telefono error pl-1 font-bold w-full"></span>
                    @endif
                    </div>
                    <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                        <input name="cbu"
                            class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="number" placeholder="CBU" value="{{old('cbu', $usuario->cbu)}}">
                    @if($errors->has('cbu'))
                        <span class="support support-box support-cbu error pl-1 font-bold w-full">{{$errors->first('cbu')}}</span>
                    @else
                        <span class="support support-box support-cbu error pl-1 font-bold w-full"></span>
                    @endif
                    </div>
                    <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                        <input name="cuit_cuil"
                            class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="number" placeholder="CUIT / CUIL" value="{{old('cuit_cuil', $usuario->cuit_cuil)}}">
                    @if($errors->has('cuit_cuil'))
                        <span class="support support-box support-cuit_cuil error pl-1 font-bold w-full">{{$errors->first('cuit_cuil')}}</span>
                    @else
                        <span class="support support-box support-cuit_cuil error pl-1 font-bold w-full"></span>
                    @endif
                    </div>
                    <div class="mb-4 flex justify-center flex-wrap mb-8 outline-none">
                        <select class="form-input p-3 outline-none bg-white" title="Campo obligatorio" name="id_tipo_suscripcion">
                            <option {{ !old("id_tipo_suscripcion", $usuario->id_tipo_suscripcion) ? 'selected' : '' }} disabled>Tipo de Suscripción</option>
                                <option {{ old('id_tipo_suscripcion', $usuario->id_tipo_suscripcion) == 1 ? 'selected' : '' }} value="1">Debito</option>
                                <option {{ old('id_tipo_suscripcion', $usuario->id_tipo_suscripcion) == 2 ? 'selected' : '' }} value="2">Semestral</option>
                                <option {{ old('id_tipo_suscripcion', $usuario->id_tipo_suscripcion) == 3 ? 'selected' : '' }} value="3">Anual</option>
                        </select>
                    @if($errors->has('id_tipo_suscripcion'))
                        <span class="support support-box support-id_tipo_suscripcion error pl-1 font-bold w-full">{{$errors->first('id_tipo_suscripcion')}}</span>
                    @else
                        <span class="support support-box support-id_tipo_suscripcion error pl-1 font-bold w-full"></span>
                    @endif
                    </div>
                    <div class="checkbox-obras w-8/12 mx-auto xl:w-6/12">
                        <ul class="obras my-8">
                            @foreach($obras as $obra)
                                <li class="checkbox mx-auto w-8/12 md:w-7/12 lg:w-10/12">
                                    @if(is_array(old('obras', $usuario->obras)) && in_array($obra->id_obra, old('obras', $usuario->obras)))
                                        <input class="form-input obra" value="{{$obra->id_obra}}" name="obras[{{$obra->slug}}]" checked id="{{$obra->slug}}" type="checkbox">
                                    @else
                                        <input class="form-input obra" value="{{$obra->id_obra}}" name="obras[{{$obra->slug}}]" id="{{$obra->slug}}" type="checkbox">
                                    @endif
                                    <label class="mt-2" for="{{$obra->slug}}">{{$obra->nombre}}</label>
                                </li>
                            @endforeach
                        </ul>
                    @if($errors->has('obras'))
                        <span class="support support-box support-obras error pl-1 font-bold w-full">{{$errors->first('obras')}}</span>
                    @else
                        <span class="support support-box support-obras error pl-1 font-bold w-full"></span>
                    @endif
                    </div>
                    <div class="flex items-center justify-center lg:justify-center py-4">
                        <a class="avanzado-button btn btn-dos p-2 px-8 my-4" >Avanzado</a>
                    </div>
                    <div class="avanzado hidden">
                        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                            <input name="correo_facturacion"
                                class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="email" placeholder="Correo de facturación" value="{{old('correo_facturacion', $usuario->correo_facturacion)}}">
                    @if($errors->has('correo_facturacion'))
                        <span class="support support-box support-correo_facturacion error pl-1 font-bold w-full">{{$errors->first('correo_facturacion')}}</span>
                    @else
                        <span class="support support-box support-correo_facturacion error pl-1 font-bold w-full"></span>
                    @endif
                        </div>
                        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                            <input name="correo_informacion"
                                class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="email" placeholder="Correo de información" value="{{old('correo_informacion', $usuario->correo_informacion)}}">
                    @if($errors->has('correo_informacion'))
                        <span class="support support-box support-correo_informacion error pl-1 font-bold w-full">{{$errors->first('correo_informacion')}}</span>
                    @else
                        <span class="support support-box support-correo_informacion error pl-1 font-bold w-full"></span>
                    @endif
                        </div>
                        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                            <input name="whatsapp"
                                class="form-input w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" placeholder="WhatsApp" value="{{old('whatsapp', $usuario->whatsapp)}}">
                    @if($errors->has('whatsapp'))
                        <span class="support support-box support-whatsapp error pl-1 font-bold w-full">{{$errors->first('whatsapp')}}</span>
                    @else
                        <span class="support support-box support-whatsapp error pl-1 font-bold w-full"></span>
                    @endif
                        </div>
                        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                            <input id="alta" type='text' name="alta" class='form-input datepicker-here w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline' 
                                data-language='es' data-position="bottom center" placeholder="Fecha Alta" value="{{old('alta', $usuario->alta)}}"/>
                            <label class="alta" for="alta">
                                <i class="icono-arg-calendario-2"></i>
                            </label>
                    @if($errors->has('alta'))
                        <span class="support support-box support-alta error pl-1 font-bold w-full">{{$errors->first('alta')}}</span>
                    @else
                        <span class="support support-box support-alta error pl-1 font-bold w-full"></span>
                    @endif
                        </div>
                        <div class="input-group mb-4 lg:flex lg:justify-center lg:flex-wrap">
                            <input id="baja" type='text' name="baja" class='form-input datepicker-here w-full appearance-none border-none p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline' 
                                data-language='es' data-position="bottom center" placeholder="Fecha Baja" value="{{old('baja', $usuario->baja)}}"/>
                            <label class="baja" for="baja">
                                <i class="icono-arg-calendario-2"></i>
                            </label>
                            @if($errors->has('baja'))
                                <span class="support support-box support-baja error pl-1 font-bold w-full">{{$errors->first('baja')}}</span>
                            @else
                                <span class="support support-box support-baja error pl-1 font-bold w-full"></span>
                            @endif
                        </div>
                        <div class="mb-4 flex justify-center flex-wrap mb-8 outline-none">
                            <select class="form-input p-3 outline-none bg-white" name="estado">
                                <option {{ !old("estado", $usuario->estado) ? 'selected' : '' }} disabled>Estado</option>
                                    <option {{ old('estado', $usuario->estado) === 0 ? 'selected' : '' }} value="0">Dado de baja</option>
                                    <option {{ old('estado', $usuario->estado) == 1 ? 'selected' : '' }} value="1">Pendiente de Confirmación</option>
                                    <option {{ old('estado', $usuario->estado) == 2 ? 'selected' : '' }} value="2">Pendiente de Aprobación</option>
                                    <option {{ old('estado', $usuario->estado) == 3 ? 'selected' : '' }} value="3">Activo</option>
                            </select>
                            @if($errors->has('estado'))
                                <span class="support support-box support-estado error pl-1 font-bold w-full">{{$errors->first('estado')}}</span>
                            @else
                                <span class="support support-box support-estado error pl-1 font-bold w-full"></span>
                            @endif
                        </div>
                        <div class="mb-4 flex justify-center flex-wrap my-8 outline-none">
                            <textarea class="form-input ckeditor descripcion resize-none" id="detalles" name="detalles" placeholder="Detalles"
                                cols="100" rows="10">{!!old('detalles', $usuario->detalles)!!}</textarea>
                    @if($errors->has('detalles'))
                        <span class="support support-box support-detalles error pl-1 font-bold w-full">{{$errors->first('detalles')}}</span>
                    @else
                        <span class="support support-box support-detalles error pl-1 font-bold w-full"></span>
                    @endif
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-center lg:justify-center py-4">
                    <input class="form-submit usuario-editar btn btn-dos p-2 px-8 my-4" type="submit" value="Editar Usuario">
                </div>
            </form>
        </section>
    </header>
@endsection

@section('js')
    <script>
        const suscriptions = [];
        const oldNivel = @json(old('id_nivel', $usuario->id_nivel));
        let oldAvanzado = false;
        let oldProvincia = @json(old('provincia', $usuario->provincia));
        if(@json(old('correo_facturacion', $usuario->correo_facturacion)) || @json(old('correo_informacion', $usuario->correo_informacion))|| @json(old('whatsapp', $usuario->whatsapp)) || @json(old('baja', $usuario->baja)) || @json(old('alta', $usuario->alta)) || @json(old('estado', $usuario->estado)) || @json(old('detalles', $usuario->detalles))){
            oldAvanzado = true;
        }
        @if(old('alta', $usuario->alta))
        const alta = @json(old('alta', $usuario->alta));
        @else
        const alta = '';
        @endif
        @if(old('baja', $usuario->baja))
        const baja = @json(old('baja', $usuario->baja));
        @else
        const baja = '';
        @endif
        const validation = @json($validation);
    </script>
    <script type="module" src={{ asset('js/datepicker/datepicker.min.js') }}></script>
    <script type="module" src={{ asset('js/datepicker/idioma/datepicker.es.js') }}></script>
    <script src={{ asset('/vendors/ckeditor/ckeditor.js') }}></script>
    <script type="module" src={{ asset('js/usuario/editar.js') }}></script>
@endsection

@section('footer')
    @component('components.footer.global')
    @endcomponent
@endsection
