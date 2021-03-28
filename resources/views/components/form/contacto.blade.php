<form id="contact-form" class="lg:px-4 rounded w-full" action="/contactar" method="post"
    data-rules="{{json_encode($validation->rules)}}"
    data-messages="{{json_encode($validation->messages)}}">
    @csrf
<!--  <h2 class="text-center text-3xl my-2">Contacto</h2> -->
    <div class="mb-4">
        <!-- <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">Nombre</label> -->
        <input name="nombre" class="form-input appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2 py-3" id="username" type="text" placeholder="Nombre" value="{{old('nombre')}}">
        @if($errors->has('nombre'))
            <span class="support support-box support-nombre error pl-1 font-bold">{{$errors->first('nombre')}}</span>
        @else
            <span class="support support-box support-nombre error pl-1 font-bold"></span>
        @endif
    </div>
    <div class="mb-4">
        <!-- <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">Teléfono</label> -->
        <input name="telefono" class="form-input appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2 py-3" id="username" type="number" placeholder="(011) 44444444" value="{{old('telefono')}}">
        @if($errors->has('telefono'))
            <span class="support support-box support-telefono error pl-1 font-bold">{{$errors->first('telefono')}}</span>
        @else
            <span class="support support-box support-telefono error pl-1 font-bold"></span>
        @endif
    </div>
    <div class="mb-4">
        <!-- <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Email</label> -->
        <input name="correo" class="form-input appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2 py-3" id="email" type="email" placeholder="Email" value="{{old('correo')}}">
        @if($errors->has('correo'))
            <span class="support support-box support-correo error pl-1 font-bold">{{$errors->first('correo')}}</span>
        @else
            <span class="support support-box support-correo error pl-1 font-bold"></span>
        @endif
    </div>
    <div>
        <!--  <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Mensaje</label> -->
        <textarea name="mensaje" class="form-input appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2 resize-none h-24" placeholder="Mensaje" id="consulta-home">{{old('mensaje')}}</textarea>
        @if($errors->has('mensaje'))
            <span class="support support-box support-mensaje error pl-1 font-bold">{{$errors->first('mensaje')}}</span>
        @else
            <span class="support support-box support-mensaje error pl-1 font-bold"></span>
        @endif
    </div>
    {!! app('captcha')->display() !!}
    @if($errors->has('g-recaptcha-response'))
        <span class="support support-box support-g-recaptcha-response error pl-1 font-bold">{{$errors->first('g-recaptcha-response')}}</span>
    @else
        <span class="support support-box support-g-recaptcha-response error pl-1 font-bold"></span>
    @endif
    <div class="flex items-center justify-center lg:justify-start">
        <input class="btn btn-uno p-2 px-8 my-4 form-submit contactar contact-form" type="submit" value="Enviar">
    </div>
</form>