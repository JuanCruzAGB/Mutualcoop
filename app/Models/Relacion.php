<?php
    namespace App\Models;

    use App\Models\Normativa;
    use App\Models\Obra;
    use Illuminate\Database\Eloquent\Model;

    class Relacion extends Model{
        /** @var string El nombre de la tabla. */
        protected $table = 'relaciones';
        
        /** @var string El nombre de la PK. */
        protected $primaryKey = 'id_relacion';

        /** @var array Los atributos que se van a cargar de forma masiva. */
        protected $fillable = [
            'id_obra', 'id_normativa',
        ];
        
        /** Trae el Normativa que coincidan con el PK. */
        public function normativa(){
            return $this->belongsTo(Normativa::class, 'id_normativa', 'id_normativa');
        }
        
        /** Trae el Obra que coincidan con el PK. */
        public function obra(){
            return $this->belongsTo(Obra::class, 'id_obra', 'id_obra');
        }
    }