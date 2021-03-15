<?php
    namespace App\Models;

    use App\Models\Obra;
    use App\Models\Tipo;
    use Illuminate\Database\Eloquent\Model;

    class Conexion extends Model{
        /** @var string El nombre de la tabla. */
        protected $table = 'conexiones';
        
        /** @var string El nombre de la PK. */
        protected $primaryKey = 'id_conexion';

        /** @var array Los atributos que se van a cargar de forma masiva. */
        protected $fillable = [
            'id_tipo', 'id_obra',
        ];
        
        /** Trae la Tipo que coincidan con el PK. */
        public function tipo(){
            return $this->belongsTo(Tipo::class, 'id_tipo', 'id_tipo');
        }
        
        /** Trae la Obra que coincidan con el PK. */
        public function obra(){
            return $this->belongsTo(Obra::class, 'id_obra', 'id_obra');
        }
    }