<?php
    namespace App\Models;
   
    use App\User;
    use Cviebrock\EloquentSluggable\Sluggable;
    use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
    use Illuminate\Database\Eloquent\Model;

    class Evento extends Model{
        use Sluggable, SluggableScopeHelpers;

        /** @var string Evento table name. */
        protected $table = 'eventos';
        
        /** @var string Evento primary key. */
        protected $primaryKey = 'id_evento';

        /** @var array The attributes to be loaded in bulk. */
        protected $fillable = [
            'titulo', 'descripcion', 'fecha', 'organizador', 'video', 'url_inscripcion', 'archivo', 'privado', 'detalles', 'id_usuario', 'slug',
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
                    'fecha' => 'required|date',
                    'organizador' => 'nullable|min:2|max:200',
                    'video' => 'nullable|url',
                    'url_inscripcion' => 'nullable|url',
                    'archivo' => 'required|mimetypes:application/pdf,image/jpeg,image/png',
                ], 'messages' => [
                    'es' => [
                        'titulo.required' => 'El título es obligatorio.',
                        'titulo.min' => 'El título no puede tener menos de :min caracteres.',
                        'titulo.max' => 'El título no puede tener más de :max caracteres.',
                        'fecha.required' => 'La fecha es obligatoria.',
                        'fecha.date' => 'La fecha debe ser formato fecha (2020/01/24).',
                        'organizador.min' => 'El organizador no puede tener menos de :min caracteres.',
                        'organizador.max' => 'El organizador no puede tener más de :max caracteres.',
                        'video.url' => 'El video debe ser una URL válida (https://ejemplo.com).',
                        'url_inscripcion.url' => 'La URL de inscripción debe ser una URL válida (https://ejemplo.com).',
                        'archivo.required' => 'El archivo es obligatorio.',
                        'archivo.mimetypes' => 'El archivo debe ser una imagen JPG/JPEG, PNG o un PDF.',
                    ],
                ],
            ],'editar' => [
                'rules' => [
                    'titulo' => 'required|min:3|max:150',
                    'fecha' => 'nullable|date',
                    'organizador' => 'nullable|min:2|max:200',
                    'video' => 'nullable|url',
                    'url_inscripcion' => 'nullable|url',
                    'archivo' => 'nullable|mimetypes:application/pdf,image/jpeg,image/png',
                ], 'messages' => [
                    'es' => [
                        'titulo.required' => 'El título es obligatorio.',
                        'titulo.min' => 'El título no puede tener menos de :min caracteres.',
                        'titulo.max' => 'El título no puede tener más de :max caracteres.',
                        'fecha.date' => 'La fecha debe ser formato fecha (2020/01/24).',
                        'organizador.min' => 'El organizador no puede tener menos de :min caracteres.',
                        'organizador.max' => 'El organizador no puede tener más de :max caracteres.',
                        'video.url' => 'El video debe ser una URL válida (https://ejemplo.com).',
                        'url_inscripcion.url' => 'La URL de inscripción debe ser una URL válida (https://ejemplo.com).',
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