<?php
    namespace App\Models;

    use App\User;
    use Cviebrock\EloquentSluggable\Sluggable;
    use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
    use Illuminate\Database\Eloquent\Model;

    class Noticia extends Model{
        use Sluggable, SluggableScopeHelpers;

        /** @var string Noticia table name. */
        protected $table = 'noticias';
        
        /** @var string Noticia primary key. */
        protected $primaryKey = 'id_noticia';

        /** @var array The attributes to be loaded in bulk. */
        protected $fillable = [
            'titulo', 'subtitulo', 'descripcion', 'fuente', 'archivo', 'id_usuario', 'slug',
        ];
        
        /**
         * * Get the User who match with the foreign key.
         * @return [type]
         */
        public function usuario(){
            return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
        }
        
        /** @var array The validation rules & messages. */
        public static $validation = [
            'crear' => [
                'rules' => [
                    'titulo' => 'required|min:3|max:150',
                    'subtitulo' => 'nullable|min:3|max:150',
                    'descripcion' => 'required',
                    'archivo' => 'required|mimetypes:image/jpeg,image/png',
                ], 'messages' => [
                    'es' => [
                        'titulo.required' => 'El título es obligatorio.',
                        'titulo.min' => 'El título no puede tener menos de :min caracteres.',
                        'titulo.max' => 'El título no puede tener más de :max caracteres.',
                        'subtitulo.required' => 'El subtitulo es obligatorio.',
                        'subtitulo.min' => 'El subtitulo no puede tener menos de :min caracteres.',
                        'subtitulo.max' => 'El subtitulo no puede tener más de :max caracteres.',
                        'descripcion.required' => 'La descripción es obligatoria.',
                        'archivo.required' => 'El archivo es obligatorio.',
                        'archivo.mimetypes' => 'El archivo debe ser una imagen JPG/JPEG o PNG.',
                    ],
                ],
            ],'editar' => [
                'rules' => [
                    'titulo' => 'required|min:3|max:150',
                    'subtitulo' => 'nullable|min:3|max:150',
                    'descripcion' => 'required',
                    'archivo' => 'nullable|mimetypes:image/jpeg,image/png',
                ], 'messages' => [
                    'es' => [
                        'titulo.required' => 'El título es obligatorio.',
                        'titulo.min' => 'El título no puede tener menos de :min caracteres.',
                        'titulo.max' => 'El título no puede tener más de :max caracteres.',
                        'subtitulo.required' => 'El subtitulo es obligatorio.',
                        'subtitulo.min' => 'El subtitulo no puede tener menos de :min caracteres.',
                        'subtitulo.max' => 'El subtitulo no puede tener más de :max caracteres.',
                        'descripcion.required' => 'La descripción es obligatoria.',
                        'archivo.mimetypes' => 'El archivo debe ser una imagen JPG/JPEG o PNG.',
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