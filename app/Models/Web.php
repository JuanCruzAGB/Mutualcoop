<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Web extends Model{
        /** @var array The validation rules & messages. */
        public static $validation = [
            'contactar' => [
                'rules' => [
                    'nombre' => 'required|min:2|max:60',
                    'correo' => 'required|email|max:100',
                    'telefono' => 'required|numeric',
                    'mensaje' => 'required',
                    'g-recaptcha-response' => 'required',
                ], 'messages' => [
                    'es' => [
                        'nombre.required' => 'El nombre es obligatorio.',
                        'nombre.min' => 'El nombre no puede tener menos de :min caracteres.',
                        'nombre.max' => 'El nombre no puede tener más de :max caracteres.',
                        'correo.required' => 'El correo es obligatorio.',
                        'correo.email' => 'El correo debe tener un formato de mail valido (ejemplo@correo.com)',
                        'correo.max' => 'El correo no puede tener más de :max caracteres.',
                        'telefono.required' => 'El teléfono es obligatorio.',
                        'telefono.numeric' => 'El teléfono debe ser un valor numérico.',
                        'mensaje.required' => 'El mensaje es obligatorio.',
                        'g-recaptcha-response.required' => 'Verifica que eres un humano.',
                        'g-recaptcha-response.captcha' => 'La verificación falló!.'
                    ],
                ],
            ],'consultar' => [
                'rules' => [
                    'consulta' => 'required',
                ], 'messages' => [
                    'es' => [
                        'consulta.required' => 'La consulta es obligatoria.',
                    ],
                ],
            ],'cambiarClave' => [
                'rules' => [
                    'dato' => 'required',
                ], 'messages' => [
                    'es' => [
                        'dato.required' => 'El correo o el número de suscripción son obligatorios.',
                    ],
                ],
            ],
        ];
    }