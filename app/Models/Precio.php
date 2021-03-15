<?php
    namespace App\Models;

    use App\Models\Obra;
    use App\User;
    use Illuminate\Database\Eloquent\Model;

    class Precio extends Model{
        /** @var string Precio table name. */
        protected $table = 'precios';
        
        /** @var string Precio primary key. */
        protected $primaryKey = 'id_precio';

        /** @var array The attributes to be loaded in bulk. */
        protected $fillable = [
            'valor_anual', 'valor_semestral', 'id_obra', 'id_usuario',
        ];
        
        /**
         * * Get the Obra who match with the foreign key.
         * @return [type]
         */
        public function obra(){
            return $this->belongsTo(Obra::class, 'id_obra', 'id_obra');
        }
        
        /** @var array The validation rules & messages. */
        public static $validation = [
            'editar' => [
                'rules' => [
                    'valor_anual' => 'required|numeric',
                    'valor_semestral' => 'required|numeric',
                ], 'messages' => [
                    'es' => [
                        'valor_anual.required' => 'El valor anual es obligatorio.',
                        'valor_anual.numeric' => 'El valor anual debe ser un valor numérico.',
                        'valor_semestral.required' => 'El valor semestral es obligatorio.',
                        'valor_semestral.numeric' => 'El valor semestral debe ser un valor numérico.',
                    ],
                ],
            ],
        ];
    }