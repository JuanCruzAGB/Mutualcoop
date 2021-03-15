<?php
    namespace App;

    use App\Models\Categoria;
    use App\Models\Evento;
    use App\Models\Gestion;
    use App\Models\Nivel;
    use App\Models\Normativa;
    use App\Models\Noticia;
    use App\Models\Obra;
    use App\Models\Suscripcion;
    use Cviebrock\EloquentSluggable\Sluggable;
    use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Laravel\Passport\HasApiTokens;

    class User extends Authenticatable{
        use HasApiTokens, Notifiable, Sluggable, SluggableScopeHelpers;
        
        /** @var string User primary key. */
        protected $primaryKey = 'id_usuario';

        /** @var array The attributes to be loaded in bulk. */
        protected $fillable = [
            'id_suscriptor', 'correo', 'correo_facturacion', 'correo_informacion', 'clave', 'id_nivel', 'entidad', 'provincia', 'localidad', 'direccion', 'nombre', 'telefono', 'whatsapp', 'cuit_cuil', 'cbu', 'id_tipo_suscripcion', 'alta', 'estado', 'baja', 'detalles', 'slug', 'remember_token',
        ];

        /** @var array The attributes to hidde. */
        protected $hidden = [
            'clave', 'remember_token',
        ];
        
        /**
         * * Get the Nivel who match with the foreign key.
         * @return [type]
         */
        public function nivel(){
            return $this->belongsTo(Nivel::class, 'id_nivel', 'id_nivel');
        }

        /**
         * * Get all the Suscripciones who match with the primary key.
         * @return [type]
         */
        public function suscripciones(){
            return $this->hasMany(Suscripcion::class, 'id_usuario', 'id_usuario');
        }

        /**
         * * Get all the Obras who match with the primary key.
         * @return [type]
         */
        static public function obras($user){
            $obras = collect([]);
            $suscripciones = Suscripcion::where('id_usuario', '=', $user->id_usuario)->get();
            foreach($suscripciones as $suscripcion){
                $obras_segun_suscripcion = Obra::where('id_obra', "=", $suscripcion->id_obra)->get();
                foreach($obras_segun_suscripcion as $obra){
                    $obras->push($obra);
                }
            }
            return $obras;
        }
        
        /** @var array The validation rules & messages. */
        public static $validation = [
            'crear' => [
                'general' => [
                    'rules' => [
                        'id_suscriptor' => 'nullable|numeric|unique:users',
                        'nombre' => 'required|min:2|max:60',
                        'correo' => 'required|email|max:100|unique:users',
                        'clave' => 'required|min:4|max:40|confirmed',
                        'id_nivel' => 'required',
                    ], 'messages' => [
                        'es' => [
                            'id_suscriptor.numeric' => 'El número de suscriptor debe ser formato numérico.',
                            'id_suscriptor.unique' => 'El número de suscriptor ya está en uso.',
                            'nombre.required' => 'El nombre es obligatorio.',
                            'nombre.min' => 'El nombre no puede tener menos de :min caracteres.',
                            'nombre.max' => 'El nombre no puede tener más de :max caracteres.',
                            'correo.required' => 'El correo es obligatorio.',
                            'correo.email' => 'El correo debe ser formato email (ejemplo@correo.com).',
                            'correo.unique' => 'El correo ya está en uso.',
                            'clave.required' => 'La contraseña es obligatoria.',
                            'clave.min' => 'La contraseña no puede tener menos de :min caracteres.',
                            'clave.max' => 'La contraseña no puede tener más de :max caracteres.',
                            'clave.confirmed' => 'Las contraseñas no coinciden.',
                            'id_nivel.required' => 'El nivel de usuario es obligatorio.',
                        ],
                    ],
                ], 'suscriptor' => [
                    'rules' => [
                        'entidad' => 'required|max:300',
                        'provincia' => 'required|max:100',
                        'localidad' => 'nullable|max:100',
                        'direccion' => 'nullable|max:160',
                        'telefono' => 'required|max:100',
                        'cuit_cuil' => 'nullable|max:200',
                        'cbu' => 'nullable|max:100',
                        'id_tipo_suscripcion' => 'required',
                        'obras' => 'required',
                    ], 'messages' => [
                        'es' => [
                            'entidad.required' => 'La entidad es obligatoria.',
                            'entidad.max' => 'La entidad no puede tener más de :max caracteres.',
                            'provincia.required' => 'La provincia es obligatoria.',
                            'provincia.max' => 'La provincia no puede tener más de :max caracteres.',
                            'localidad.max' => 'La localidad no puede tener más de :max caracteres.',
                            'direccion.max' => 'La dirección no puede tener más de :max caracteres.',
                            'telefono.required' => 'El teléfono es obligatorio.',
                            'telefono.max' => 'El teléfono no puede tener más de :max caracteres.',
                            'cuit_cuil.max' => 'El CUIT/CUIL no puede tener más de :max caracteres.',
                            'cbu.max' => 'El CBU no puede tener más de :max caracteres.',
                            'id_tipo_suscripcion.required' => 'El tipo de suscripción es obligatorio.',
                            'obras.required' => 'Al menos 1 obra es necesario seleccionar.',
                        ],
                    ],
                ], 'avanzado' => [
                    'rules' => [
                        'correo_facturacion' => 'nullable|email|max:100|unique:users',
                        'correo_informacion' => 'nullable|email|max:100|unique:users',
                        'whatsapp' => 'nullable|max:100',
                        'alta' => 'nullable|date',
                        'baja' => 'nullable|date',
                    ], 'messages' => [
                        'es' => [
                            'correo_facturacion.email' => 'El correo de facturación debe ser formato email (ejemplo@correo.com).',
                            'correo_informacion.required' => 'El correo de información es obligatorio.',
                            'correo_informacion.email' => 'El correo de información debe ser formato email (ejemplo@correo.com).',
                            'correo_informacion.unique' => 'El correo de información ya está en uso.',
                            'whatsapp.max' => 'El WhatsApp no puede tener más de :max caracteres.',
                            'alta.date' => 'La fecha de alta debe ser formato fecha (2020/01/24).',
                            'baja.date' => 'La fecha de baja debe ser formato fecha (2020/01/24).',
                        ],
                    ],
                ],
            ],'editar' => [
                'general' => [
                    'rules' => [
                        'id_suscriptor' => "nullable|numeric|unique:users,id_suscriptor,{id_usuario},id_usuario",
                        'nombre' => 'required|min:2|max:60',
                        'correo' => "required|email|max:100|unique:users,correo,{id_usuario},id_usuario",
                        'clave' => 'nullable|min:4|max:40|confirmed',
                        'id_nivel' => 'required',
                    ], 'messages' => [
                        'es' => [
                            'id_suscriptor.numeric' => 'El número de suscriptor debe ser formato numérico.',
                            'id_suscriptor.unique' => 'El número de suscriptor ya está en uso.',
                            'nombre.required' => 'El nombre es obligatorio.',
                            'nombre.min' => 'El nombre no puede tener menos de :min caracteres.',
                            'nombre.max' => 'El nombre no puede tener más de :max caracteres.',
                            'correo.required' => 'El correo es obligatorio.',
                            'correo.email' => 'El correo debe ser formato email (ejemplo@correo.com).',
                            'correo.unique' => 'El correo ya está en uso.',
                            'clave.min' => 'La contraseña no puede tener menos de :min caracteres.',
                            'clave.max' => 'La contraseña no puede tener más de :max caracteres.',
                            'clave.confirmed' => 'Las contraseñas no coinciden.',
                            'id_nivel.required' => 'El nivel de usuario es obligatorio.',
                        ],
                    ],
                ], 'suscriptor' => [
                    'rules' => [
                        'entidad' => 'required|max:300',
                        'provincia' => 'required|max:100',
                        'localidad' => 'nullable|max:100',
                        'direccion' => 'nullable|max:160',
                        'telefono' => 'required|max:100',
                        'cuit_cuil' => 'nullable|max:200',
                        'cbu' => 'nullable|max:100',
                        'id_tipo_suscripcion' => 'required',
                        'obras' => 'required',
                    ], 'messages' => [
                        'es' => [
                            'entidad.required' => 'La entidad es obligatoria.',
                            'entidad.max' => 'La entidad no puede tener más de :max caracteres.',
                            'provincia.required' => 'La provincia es obligatoria.',
                            'provincia.max' => 'La provincia no puede tener más de :max caracteres.',
                            'localidad.max' => 'La localidad no puede tener más de :max caracteres.',
                            'direccion.max' => 'La dirección no puede tener más de :max caracteres.',
                            'telefono.required' => 'El teléfono es obligatorio.',
                            'telefono.max' => 'El teléfono no puede tener más de :max caracteres.',
                            'cuit_cuil.max' => 'El CUIT/CUIL no puede tener más de :max caracteres.',
                            'cbu.max' => 'El CBU no puede tener más de :max caracteres.',
                            'id_tipo_suscripcion.required' => 'El tipo de suscripción es obligatorio.',
                            'obras.required' => 'Al menos 1 obra es necesario seleccionar.',
                        ],
                    ],
                ], 'avanzado' => [
                    'rules' => [
                        'correo_facturacion' => "nullable|email|max:100|unique:users,correo_facturacion,{id_usuario},id_usuario",
                        "correo_informacion' => 'nullable|email|max:100|unique:users,correo_informacion,{id_usuario},id_usuario",
                        'whatsapp' => 'nullable|max:100',
                        'alta' => 'nullable|date',
                        'baja' => 'nullable|date',
                    ], 'messages' => [
                        'es' => [
                            'correo_facturacion.email' => 'El correo de facturación debe ser formato email (ejemplo@correo.com).',
                            'correo_informacion.required' => 'El correo de información es obligatorio.',
                            'correo_informacion.email' => 'El correo de información debe ser formato email (ejemplo@correo.com).',
                            'correo_informacion.unique' => 'El correo de información ya está en uso.',
                            'whatsapp.max' => 'El WhatsApp no puede tener más de :max caracteres.',
                            'alta.date' => 'La fecha de alta debe ser formato fecha (2020/01/24).',
                            'baja.date' => 'La fecha de baja debe ser formato fecha (2020/01/24).',
                        ],
                    ],
                ],
            ],
        ];

        /**
         * * Change the password field.
         * @return [type]
         */
        public function getAuthPassword(){
            return $this->clave;
        }
        
        /**
         * * The Sluggable configuration for the Model.
         * @return array
         */
        public function sluggable(){
            return [
                'slug' => [
                    'source'	=> 'nombre',
                    'onUpdate'	=> true,
                ]
            ];
        }
    }