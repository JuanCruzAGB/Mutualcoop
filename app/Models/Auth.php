<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Auth extends Model{
        /** @var array The validation rules & messages. */
        public static $validation = [
            'ingresar' => [
                'rules' => [
                    'ingresar_dato' => 'required',
                    'ingresar_clave' => 'required|min:4|max:40'
                ], 'messages' => [
                    'es' => [
                        'ingresar_dato.required' => 'El Correo o el número de suscriptor son obligatorios.',
                        'ingresar_clave.required' => 'La Contraseña es obligatoria.',
                        'ingresar_clave.min' => 'La Contraseña no puede tener menos de :min caracteres.',
                        'ingresar_clave.max' => 'La Contraseña no puede tener más de :max caracteres.',
                    ],
                ],
            ],'registrar' => [
                'general' => [
                    'rules' => [
                        'registrar_nombre' => 'required|min:2|max:60',
                        'registrar_correo' => 'required|email|max:100|unique:users,correo',
                        'registrar_clave' => 'required|min:4|max:40|confirmed',
                        'registrar_entidad' => 'required|max:300',
                        'registrar_telefono' => 'required|max:100',
                        'registrar_cbu' => 'required|min:22|max:22',
                        'registrar_id_tipo_suscripcion' => 'required',
                        'registrar_obras' => 'required',
                        'registrar_provincia' => 'required|max:100',
                        'registrar_cuit_cuil' => 'nullable|max:200',
                    ], 'messages' => [
                        'es' => [
                            'registrar_nombre.required' => 'El nombre es obligatorio.',
                            'registrar_nombre.min' => 'El nombre no puede tener menos de :min caracteres.',
                            'registrar_nombre.max' => 'El nombre no puede tener más de :max caracteres.',
                            'registrar_correo.required' => 'El correo es obligatorio.',
                            'registrar_correo.email' => 'El correo debe ser formato email (ejemplo@correo.com).',
                            'registrar_correo.max' => 'El correo no puede tener más de :max caracteres.',
                            'registrar_correo.unique' => 'El correo ya está en uso.',
                            'registrar_clave.required' => 'La contraseña es obligatoria.',
                            'registrar_clave.min' => 'La contraseña no puede tener menos de :min caracteres.',
                            'registrar_clave.max' => 'La contraseña no puede tener más de :max caracteres.',
                            'registrar_clave.confirmed' => 'Las contraseñas no coinciden.',
                            'registrar_entidad.required' => 'La entidad es obligatorio.',
                            'registrar_entidad.max' => 'La entidad no puede tener más de :max caracteres.',
                            'registrar_telefono.required' => 'El teléfono es obligatorio.',
                            'registrar_telefono.max' => 'El teléfono no puede tener más de :max caracteres.',
                            'registrar_cbu.required' => 'El CBU es obligatorio.',
                            'registrar_cbu.min' => 'El CBU no puede tener menos de :min caracteres.',
                            'registrar_cbu.max' => 'El CBU no puede tener más de :max caracteres.',
                            'registrar_id_tipo_suscripcion.required' => 'El tipo de suscripción es obligatorio.',
                            'registrar_id_tipo_suscripcion.max' => 'El tipo de suscripción debe ser un valor numérico.',
                            'registrar_obras.required' => 'Al menos 1 obra es necesario seleccionar.',
                            'registrar_provincia.required' => 'La provincia es obligatoria.',
                            'registrar_provincia.max' => 'La provincia no puede tener más de :max caracteres.',
                            'registrar_cuit_cuil.max' => 'El CUIT/CUIL no puede tener más de :max caracteres.',
                        ],
                    ],
                ], 'avanzado' => [
                    //
                ],
            ],'cambiarClave' => [
                'send' => [
                    'rules' => [
                        'cambiarClave_dato' => 'required',
                    ], 'messages' => [
                        'es' => [
                            'cambiarClave_dato.required' => 'El Correo o el número de suscripción son obligatorios.',
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