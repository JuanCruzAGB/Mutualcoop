<?php
    namespace App\Models;

    use App\User;
    use Cviebrock\EloquentSluggable\Sluggable;
    use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
    use Illuminate\Database\Eloquent\Model;

    class Pregunta extends Model{
        use Sluggable, SluggableScopeHelpers;

        /** @var string El nombre de la tabla. */
        protected $table = 'preguntas';
        
        /** @var string El nombre de la PK. */
        protected $primaryKey = 'id_pregunta';

        /** @var array Los atributos que se van a cargar de forma masiva. */
        protected $fillable = [
            'pregunta', 'respuesta', 'privado', 'id_usuario', 'slug',
        ];
        
        /** @var array The validation rules & messages. */
        public static $validation = [
            'crear' => [
                'rules' => [
                    'pregunta' => 'required',
                    'respuesta' => 'required',
                ], 'messages' => [
                    'es' => [
                        'pregunta.required' => 'La pregunta es obligatoria.',
                        'respuesta.required' => 'La respuesta es obligatoria.',
                    ],
                ],
            ],'editar' => [
                'rules' => [
                    'pregunta' => 'required',
                    'respuesta' => 'required',
                ], 'messages' => [
                    'es' => [
                        'pregunta.required' => 'La pregunta es obligatoria.',
                        'respuesta.required' => 'La respuesta es obligatoria.',
                    ],
                ],
            ]
        ];
        
        /**
         * Devuelve la configuracion del slug del modelo.
         * 
         * @return array
         */
        public function sluggable(){
            return [
                'slug' => [
                    'source'	=> 'pregunta',
                    'onUpdate'	=> true,
                ]
            ];
        }
    }