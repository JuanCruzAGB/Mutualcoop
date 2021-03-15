<?php
    namespace App\Models;

    use App\Models\Enlace;
    use App\Models\Organismo;
    use App\Models\Nexo;
    use Cviebrock\EloquentSluggable\Sluggable;
    use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
    use Illuminate\Database\Eloquent\Model;

    class Tema extends Model{
        use Sluggable, SluggableScopeHelpers;

        /** @var string Tema table name. */
        protected $table = 'temas';
        
        /** @var string Tema primary key. */
        protected $primaryKey = 'id_tema';

        /** @var array The attributes to be loaded in bulk. */
        protected $fillable = [
            'nombre', 'id_organismo', 'id_usuario', 'slug',
        ];
        
        /**
         * * Get the Organismo who match with the foreign key.
         * @return [type]
         */
        public function organismo(){
            return $this->belongsTo(Organismo::class, 'id_organismo', 'id_organismo');
        }

        /**
         * * Get all the Enlaces who match with the primary key.
         * @return [type]
         */
        public function enlaces(){
            return $this->hasMany(Enlace::class, 'id_tema', 'id_tema');
        }

        /**
         * * Get all the Nexos who match with the primary key.
         * @return [type]
         */
        public function nexos(){
            return $this->hasMany(Nexo::class, 'id_tema', 'id_tema');
        }
        
        /** @var array The validation rules & messages. */
        public static $validation = [
            'crear' => [
                'rules' => [
                    'nombre' => 'required|max:100',
                    'id_organismo' => 'required',
                    'obras' => 'required',
                ], 'messages' => [
                    'es' => [
                        'nombre.required' => 'El nombre del tema no puede estar vacío.',
                        'nombre.max' => 'El nombre del tema no puede tener más de :max caracteres.',
                        'id_organismo.required' => 'El organismo del tema es obligatorio.',
                        'obras.required' => 'Una obra tiene que estar seleccionada.',
                    ],
                ],
            ],'editar' => [
                'rules' => [
                    'nombre' => 'required|max:100',
                    'id_organismo' => 'required',
                    'obras' => 'required',
                ], 'messages' => [
                    'es' => [
                        'nombre.required' => 'El nombre del tema no puede estar vacío.',
                        'nombre.max' => 'El nombre del tema no puede tener más de :max caracteres.',
                        'id_organismo.required' => 'El organismo del tema es obligatorio.',
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