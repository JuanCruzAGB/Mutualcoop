<?php
    namespace App\Models;

    use App\Models\Categoria;
    use App\Models\Tipo;
    use App\Models\Vinculo;
    use App\User;
    use Cviebrock\EloquentSluggable\Sluggable;
    use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
    use Illuminate\Database\Eloquent\Model;

    class Gestion extends Model{
        use Sluggable, SluggableScopeHelpers;

        /** @var string Gestion table name. */
        protected $table = 'gestiones';
        
        /** @var string Gestion primary key. */
        protected $primaryKey = 'id_gestion';

        /** @var array The attributes to be loaded in bulk. */
        protected $fillable = [
            'titulo', 'copete', 'id_tipo_gestion', 'id_categoria', 'archivo', 'id_usuario', 'slug',
        ];
        
        /**
         * * Get the Tipo who match with the foreign key.
         * @return [type]
         */
        public function tipo(){
            return $this->belongsTo(Tipo::class, 'id_tipo_gestion', 'id_tipo');
        }
        
        /**
         * * Get the Categoria who match with the foreign key.
         * @return [type]
         */
        public function categoria(){
            return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
        }
        
        /**
         * * Get the Usuario who match with the foreign key.
         * @return [type]
         */
        public function usuario(){
            return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
        }

        /**
         * * Get all the Vinculos who match with the primary key.
         * @return [type]
         */
        public function vinculos(){
            return $this->hasMany(Vinculo::class, 'id_gestion', 'id_gestion');
        }

        /**
         * * Scope a query to only include Gestiones by the id_tipo_gestion.
         * @param  \Illuminate\Database\Eloquent\Builder  $query
         * @param  int  $id_user
         * @return \Illuminate\Database\Eloquent\Builder
         */
        public function scopeByTipo ($query, int $id_tipo_gestion) {
            return $query->where('id_tipo_gestion', $id_tipo_gestion);
        }

        /**
         * * Scope a query to only include Gestiones by the User.
         * @param  \Illuminate\Database\Eloquent\Builder  $query
         * @param  int  $id_user
         * @return \Illuminate\Database\Eloquent\Builder
         */
        public function scopeByUser ($query, int $id_user) {
            return $query->Join('vinculos', 'vinculos.id_gestion', '=', 'gestiones.id_gestion')
                ->Join('obras', 'vinculos.id_obra', '=', 'obras.id_obra')
                ->Join('suscripciones', 'obras.id_obra', '=', 'suscripciones.id_obra')
                ->Join('users', 'suscripciones.id_usuario', '=', 'users.id_usuario')
                ->where('users.id_usuario', $id_user);
        }
        
        /** @var array The validation rules & messages. */
        public static $validation = [
            'crear' => [
                'rules' => [
                    'titulo' => 'required|min:3|max:150',
                    'id_tipo_gestion' => 'required',
                    'archivo' => 'required|mimetypes:image/jpeg,image/png,application/pdf',
                    'obras' => 'required',
                ], 'messages' => [
                    'es' => [
                        'titulo.required' => 'El título es obligatorio.',
                        'titulo.min' => 'El título no puede tener menos de :min caracteres.',
                        'titulo.max' => 'El título no puede tener más de :max caracteres.',
                        'id_tipo_gestion.required' => 'El tipo de la gestión es obligatorio.',
                        'archivo.required' => 'El archivo es obligatorio.',
                        'archivo.mimetypes' => 'El archivo debe ser una imagen JPG/JPEG, PNG o un PDF.',
                        'obras.required' => 'Al menos 1 Obra es necesario seleccionar.',
                    ],
                ],
            ],'editar' => [
                'rules' => [
                    'titulo' => 'required|min:3|max:150',
                    'id_tipo_gestion' => 'required',
                    'archivo' => 'nullable|mimetypes:image/jpeg,image/png,application/pdf',
                    'obras' => 'required',
                ], 'messages' => [
                    'es' => [
                        'titulo.required' => 'El título es obligatorio.',
                        'titulo.min' => 'El título no puede tener menos de :min caracteres.',
                        'titulo.max' => 'El título no puede tener más de :max caracteres.',
                        'id_tipo_gestion.required' => 'El tipo de la gestión es obligatorio.',
                        'archivo.mimetypes' => 'El archivo debe ser una imagen JPG/JPEG, PNG o un PDF.',
                        'obras.required' => 'Al menos 1 obra es necesario seleccionar.',
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