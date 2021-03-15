<?php
    namespace App\Models;

    use App\Models\Normativa;
    use App\Models\Tema;
    use Illuminate\Database\Eloquent\Model;

    class Enlace extends Model{
        /** @var string El nombre de la tabla. */
        protected $table = 'enlaces';
        
        /** @var string El nombre de la PK. */
        protected $primaryKey = 'id_enlace';

        /** @var array Los atributos que se van a cargar de forma masiva. */
        protected $fillable = [
            'id_normativa', 'id_tema',
        ];
        
        /** Trae la Normativa que coincidan con el PK. */
        public function normativa(){
            return $this->belongsTo(Normativa::class, 'id_normativa', 'id_normativa');
        }
        
        /** Trae el Tema que coincidan con el PK. */
        public function tema(){
            return $this->belongsTo(Tema::class, 'id_tema', 'id_tema');
        }
    }