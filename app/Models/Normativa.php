<?php
    namespace App\Models;

    use App\Models\Enlace;
    use App\Models\Organismo;
    use App\Models\Relacion;
    use App\Models\Tipo;
    use App\User;
    use Cviebrock\EloquentSluggable\Sluggable;
    use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
    use Illuminate\Database\Eloquent\Model;

    class Normativa extends Model{
        use Sluggable, SluggableScopeHelpers;

        /** @var string Normativa table name. */
        protected $table = 'normativas';
        
        /** @var string Normativa primary key. */
        protected $primaryKey = 'id_normativa';

        /** @var array The attributes to be loaded in bulk. */
        protected $fillable = [
            'titulo', 'copete', 'fecha', 'id_tipo_normativa', 'id_organismo', 'archivo', 'id_usuario', 'slug',
        ];
        
        /**
         * * Get the Tipo who match with the foreign key.
         * @return [type]
         */
        public function tipo(){
            return $this->belongsTo(Tipo::class, 'id_tipo_normativa', 'id_tipo');
        }
        
        /**
         * * Get the Oreganismo who match with the foreign key.
         * @return [type]
         */
        public function organismo(){
            return $this->belongsTo(Organismo::class, 'id_organismo', 'id_organismo');
        }
        
        /**
         * * Get the Usuario who match with the foreign key.
         * @return [type]
         */
        public function usuario(){
            return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
        }
        
        /**
         * * Get all the Enlaces who match with the primary key.
         * @return [type]
         */
        public function enlaces(){
            return $this->hasMany(Enlace::class, 'id_normativa', 'id_normativa');
        }

        /**
         * * Get all the Relaciones who match with the primary key.
         * @return [type]
         */
        public function relaciones(){
            return $this->hasMany(Relacion::class, 'id_normativa', 'id_normativa');
        }

        /**
         * * Scope a query to only include Normativas by the id_tipo_normativa.
         * @param  \Illuminate\Database\Eloquent\Builder  $query
         * @param  int  $id_user
         * @return \Illuminate\Database\Eloquent\Builder
         */
        public function scopeByTipo ($query, int $id_tipo_normativa) {
            return $query->where('id_tipo_normativa', $id_tipo_normativa);
        }

        /**
         * * Scope a query to only include Normativas by the User.
         * @param  \Illuminate\Database\Eloquent\Builder  $query
         * @param  int  $id_user
         * @return \Illuminate\Database\Eloquent\Builder
         */
        public function scopeByUser ($query, int $id_user) {
            return $query->Join('relaciones', 'relaciones.id_normativa', '=', 'normativas.id_normativa')
                ->Join('obras', 'relaciones.id_obra', '=', 'obras.id_obra')
                ->Join('suscripciones', 'obras.id_obra', '=', 'suscripciones.id_obra')
                ->Join('users', 'suscripciones.id_usuario', '=', 'users.id_usuario')
                ->where('users.id_usuario', $id_user);
        }
        
        /** @var array The validation rules & messages. */
        public static $validation = [
            'crear' => [
                'rules' => [
                    'titulo' => 'required|min:3|max:150',
                    'copete' => 'required',
                    'fecha' => 'required|date',
                    'id_tipo_normativa' => 'required',
                    'id_organismo' => 'required',
                    'archivo' => 'required|mimetypes:image/jpeg,image/png,application/pdf',
                    'temas' => 'required',
                    'obras' => 'required',
                ], 'messages' => [
                    'es' => [
                        'titulo.required' => 'El título es obligatorio.',
                        'titulo.min' => 'El título no puede tener menos de :min caracteres.',
                        'titulo.max' => 'El título no puede tener más de :max caracteres.',
                        'copete.required' => 'El copete es obligatorio.',
                        'fecha.required' => 'La fecha es obligatoria.',
                        'fecha.date' => 'La fecha debe ser formato fecha (2020/01/24).',
                        'id_tipo_normativa.required' => 'El tipo de la normativa es obligatorio.',
                        'id_organismo.required' => 'El organismo de la normativa es obligatorio.',
                        'archivo.required' => 'El archivo es obligatorio.',
                        'archivo.mimetypes' => 'El archivo debe ser una imagen JPG/JPEG, PNG o un PDF.',
                        'temas.required' => 'Al menos 1 Tema es necesario seleccionar.',
                        'obras.required' => 'Al menos 1 Obra es necesario seleccionar.',
                    ],
                ],
            ],'editar' => [
                'rules' => [
                    'titulo' => 'required|min:3|max:150',
                    'copete' => 'required',
                    'fecha' => 'required|date',
                    'id_tipo_normativa' => 'required',
                    'id_organismo' => 'required',
                    'archivo' => 'nullable|mimetypes:image/jpeg,image/png,application/pdf',
                    'temas' => 'required',
                    'obras' => 'required',
                ], 'messages' => [
                    'es' => [
                        'titulo.required' => 'El título es obligatorio.',
                        'titulo.min' => 'El título no puede tener menos de :min caracteres.',
                        'titulo.max' => 'El título no puede tener más de :max caracteres.',
                        'copete.required' => 'El copete es obligatorio.',
                        'fecha.date' => 'La fecha debe ser formato fecha (2020/01/24).',
                        'id_tipo_normativa.required' => 'El tipo de la normativa es obligatorio.',
                        'id_organismo.required' => 'El organismo de la normativa es obligatorio.',
                        'archivo.mimetypes' => 'El archivo debe ser una imagen JPG/JPEG, PNG o un PDF.',
                        'temas.required' => 'Al menos 1 Tema es necesario seleccionar.',
                        'obras.required' => 'Al menos 1 Obra es necesario seleccionar.',
                    ],
                ],
            ],
        ];
        
        /**
         * * The Sluggable configuration for the Model.
         * @return array
         */
        public function sluggable(){
            return [
                'slug' => [
                    'source'	=> 'titulo',
                    'onUpdate'	=> true,
                ]
            ];
        }
    }