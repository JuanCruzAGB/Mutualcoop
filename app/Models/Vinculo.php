<?php
    namespace App\Models;

    use App\Models\Gestion;
    use App\Models\Obra;
    use Illuminate\Database\Eloquent\Model;

    class Vinculo extends Model{
        /** @var string El nombre de la tabla. */
        protected $table = 'vinculos';
        
        /** @var string El nombre de la PK. */
        protected $primaryKey = 'id_vinculo';

        /** @var array Los atributos que se van a cargar de forma masiva. */
        protected $fillable = [
            'id_gestion', 'id_obra',
        ];
        
        /** Trae la Gestion que coincidan con el PK. */
        public function gestion(){
            return $this->belongsTo(Gestion::class, 'id_gestion', 'id_gestion');
        }
        
        /** Trae la Obra que coincidan con el PK. */
        public function obra(){
            return $this->belongsTo(Obra::class, 'id_obra', 'id_obra');
        }
    }