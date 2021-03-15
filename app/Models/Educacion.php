<?php
    namespace App\Models;

    use App\User;
    use Cviebrock\EloquentSluggable\Sluggable;
    use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
    use Illuminate\Database\Eloquent\Model;

    class Educacion extends Model{
        use Sluggable, SluggableScopeHelpers;

        /** @var string Educacion table name. */
        protected $table = 'educaciones';
        
        /** @var string Educacion primary key. */
        protected $primaryKey = 'id_educacion';

        /** @var array The attributes to be loaded in bulk. */
        protected $fillable = [
            'titulo', 'copete', 'archivo', 'id_usuario', 'slug',
        ];
        
        /** @var array The validation rules & messages. */
        public static $validation = [
            'crear' => [
                'rules' => [
                    'titulo' => 'required|min:3|max:150',
                    'archivo' => 'required|mimetypes:application/pdf,image/jpeg,image/png',
                ], 'messages' => [
                    'es' => [
                        'titulo.required' => 'El título no puede estar vacío.',
                        'titulo.min' => 'El título debe tener al menos :min caracteres.',
                        'titulo.max' => 'El título no puede tener más de :max caracteres.',
                        'archivo.required' => 'El archivo es obligatorio.',
                        'archivo.mimetypes' => 'El archivo debe ser una imagen JPG/JPEG, PNG o un PDF.',
                    ],
                ],
            ],'editar' => [
                'rules' => [
                    'titulo' => 'required|min:3|max:150',
                    'archivo' => 'nullable|mimetypes:application/pdf,image/jpeg,image/png',
                ], 'messages' => [
                    'es' => [
                        'titulo.required' => 'El título no puede estar vacío.',
                        'titulo.min' => 'El título debe tener al menos :min caracteres.',
                        'titulo.max' => 'El título no puede tener más de :max caracteres.',
                        'archivo.mimetypes' => 'El archivo debe ser una imagen JPG/JPEG, PNG o un PDF.',
                        
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