<?php
    namespace App\Models;

    use App\Models\Obra;
    use App\Models\Tema;
    use Illuminate\Database\Eloquent\Model;

    class Nexo extends Model{
        /** @var string El nombre de la tabla. */
        protected $table = 'nexos';
        
        /** @var string El nombre de la PK. */
        protected $primaryKey = 'id_nexo';

        /** @var array Los atributos que se van a cargar de forma masiva. */
        protected $fillable = [
            'id_tema', 'id_obra',
        ];
        
        /** Trae la Obra que coincidan con el PK. */
        public function obra(){
            return $this->belongsTo(Obra::class, 'id_obra', 'id_obra');
        }
        
        /** Trae la Tema que coincidan con el PK. */
        public function tema(){
            return $this->belongsTo(Tema::class, 'id_organismo', 'id_organismo');
        }
    }