<?php
    namespace App\Models;

    use App\Models\Tipo;
    use App\Models\Union;
    use App\User;
    use Cviebrock\EloquentSluggable\Sluggable;
    use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
    use Illuminate\Database\Eloquent\Model;

    class Categoria extends Model{
        use Sluggable, SluggableScopeHelpers;

        /** @var string Categoria table name. */
        protected $table = 'categorias';
        
        /** @var string Categoria primary key. */
        protected $primaryKey = 'id_categoria';

        /** @var array The attributes to be loaded in bulk. */
        protected $fillable = [
            'nombre', 'id_tipo_gestion', 'id_usuario', 'slug',
        ];
        
        /**
         * * Get the Tipo who match with the foreign key.
         * @return [type]
         */
        public function tipo(){
            return $this->belongsTo(Tipo::class, 'id_tipo_gestion', 'id_tipo');
        }

        /**
         * * Get all the Uniones who match with the primary key.
         * @return [type]
         */
        public function uniones(){
            return $this->hasMany(Union::class, 'id_categoria', 'id_categoria');
        }
        
        /** @var array The validation rules & messages. */
        public static $validation = [
            'crear' => [
                'rules' => [
                    'nombre' => 'required|max:100',
                    'id_tipo_gestion' => 'required',
                    'obras' => 'required',
                ], 'messages' => [
                    'es' => [
                        'nombre.required' => 'El nombre de la categoría no puede estar vacío.',
                        'nombre.max' => 'El nombre de la categoría no puede tener más de :max caracteres.',
                        'id_tipo_gestion.required' => 'El tipo de la categoría es obligatorio.',
                        'obras.required' => 'Una obra tiene que estar seleccionada.',
                    ],
                ],
            ],'editar' => [
                'rules' => [
                    'nombre' => 'required|max:100',
                    'id_tipo_gestion' => 'required',
                    'obras' => 'required',
                ], 'messages' => [
                    'es' => [
                        'nombre.required' => 'El nombre de la categoría no puede estar vacío.',
                        'nombre.max' => 'El nombre de la categoría no puede tener más de :max caracteres.',
                        'id_tipo_gestion.required' => 'El tipo de la categoría es obligatorio.',
                        'obras.required' => 'Una obra tiene que estar seleccionada.',
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
                    'source'	=> 'nombre',
                    'onUpdate'	=> true,
                ]
            ];
        }
    }