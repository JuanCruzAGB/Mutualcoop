<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Auth extends Model{
        /** @var array The validation rules & messages. */
        public static $validation = [
            'ingresar' => [
                'rules' => [
                    'dato' => 'required',
                    'clave' => 'required|min:4|max:40',
                    'g-recaptcha-response' => 'required',
                ], 'messages' => [
                    'es' => [
                        'dato.required' => 'El Correo o el número de suscriptor son obligatorios.',
                        'clave.required' => 'La Contraseña es obligatoria.',
                        'clave.min' => 'La Contraseña no puede tener menos de :min caracteres.',
                        'clave.max' => 'La Contraseña no puede tener más de :max caracteres.',
                        'g-recaptcha-response.required' => 'Verifica que eres un humano.',
                        'g-recaptcha-response.captcha' => 'La verificación falló!.'
                    ],
                ],
            ],'registrar' => [
                'general' => [
                    'rules' => [
                        'nombre' => 'required|min:2|max:60',
                        'correo' => 'required|email|max:100|unique:users,correo',
                        'clave' => 'required|min:4|max:40|confirmed',
                        'entidad' => 'required|max:300',
                        'telefono' => 'required|max:100',
                        'cbu' => 'required|min:22|max:22',
                        'id_tipo_suscripcion' => 'required',
                        'obras' => 'required',
                        'provincia' => 'required|max:100',
                        'cuit_cuil' => 'nullable|max:200',
                    ], 'messages' => [
                        'es' => [
                            'nombre.required' => 'El nombre es obligatorio.',
                            'nombre.min' => 'El nombre no puede tener menos de :min caracteres.',
                            'nombre.max' => 'El nombre no puede tener más de :max caracteres.',
                            'correo.required' => 'El correo es obligatorio.',
                            'correo.email' => 'El correo debe ser formato email (ejemplo@correo.com).',
                            'correo.max' => 'El correo no puede tener más de :max caracteres.',
                            'correo.unique' => 'El correo ya está en uso.',
                            'clave.required' => 'La contraseña es obligatoria.',
                            'clave.min' => 'La contraseña no puede tener menos de :min caracteres.',
                            'clave.max' => 'La contraseña no puede tener más de :max caracteres.',
                            'clave.confirmed' => 'Las contraseñas no coinciden.',
                            'entidad.required' => 'La entidad es obligatorio.',
                            'entidad.max' => 'La entidad no puede tener más de :max caracteres.',
                            'telefono.required' => 'El teléfono es obligatorio.',
                            'telefono.max' => 'El teléfono no puede tener más de :max caracteres.',
                            'cbu.required' => 'El CBU es obligatorio.',
                            'cbu.min' => 'El CBU no puede tener menos de :min caracteres.',
                            'cbu.max' => 'El CBU no puede tener más de :max caracteres.',
                            'id_tipo_suscripcion.required' => 'El tipo de suscripción es obligatorio.',
                            'id_tipo_suscripcion.max' => 'El tipo de suscripción debe ser un valor numérico.',
                            'obras.required' => 'Al menos 1 obra es necesario seleccionar.',
                            'provincia.required' => 'La provincia es obligatoria.',
                            'provincia.max' => 'La provincia no puede tener más de :max caracteres.',
                            'cuit_cuil.max' => 'El CUIT/CUIL no puede tener más de :max caracteres.',
                        ],
                    ],
                ], 'avanzado' => [
                    //
                ],
            ],'cambiar-clave' => [
                'send' => [
                    'rules' => [
                        'dato' => 'required',
                    ], 'messages' => [
                        'es' => [
                            'dato.required' => 'El Correo o el número de suscripción son obligatorios.',
                        ],
                    ],
                ], 'show' => [
                    'rules' => [
                        'token' => 'required',
                    ], 'messages' => [
                        'es' => [
                            'token.required' => 'Token inválido.',
                        ],
                    ],
                ], 'reset' => [
                    'rules' => [
                        'token' => 'required',
                        'clave' => 'required|min:4|max:40|confirmed',
                    ], 'messages' => [
                        'es' => [
                            'token.required' => 'Token inválido.',
                            'clave.required' => 'La Contraseña es obligatoria.',
                            'clave.min' => 'La Contraseña no puede tener menos de :min caracteres.',
                            'clave.max' => 'La Contraseña no puede tener más de :max caracteres.',
                            'clave.confirmed' => 'Las Contraseñas no coinciden.',
                        ],
                    ],
                ],
            ],
        ];
    }