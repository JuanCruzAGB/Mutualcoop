<?php
    namespace App\Models;

    use App\Models\Categoria;
    use App\Models\Obra;
    use Illuminate\Database\Eloquent\Model;

    class Union extends Model{
        /** @var string El nombre de la tabla. */
        protected $table = 'uniones';
        
        /** @var string El nombre de la PK. */
        protected $primaryKey = 'id_union';

        /** @var array Los atributos que se van a cargar de forma masiva. */
        protected $fillable = [
            'id_categoria', 'id_obra',
        ];
        
        /** Trae la Categoria que coincidan con el PK. */
        public function categoria(){
            return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
        }
        
        /** Trae la Obra que coincidan con el PK. */
        public function obra(){
            return $this->belongsTo(Obra::class, 'id_obra', 'id_obra');
        }
    }