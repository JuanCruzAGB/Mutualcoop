<?php
    namespace App\Models;

    use App\Models\Normativa;
    use App\Models\Tema;
    use Illuminate\Database\Eloquent\Model;

    class Organismo extends Model{
        /** @var string El nombre de la tabla. */
        protected $table = 'organismos';
        
        /** @var string El nombre de la PK. */
        protected $primaryKey = 'id_organismo';

        /** @var array Los atributos que se van a cargar de forma masiva. */
        protected $fillable = [
            'nombre',
        ];
        
        /** Trae todos las Normativas que coincidan con el PK. */
        public function normativas(){
            return $this->hasMany(Normativa::class, 'id_organismo', 'id_organismo');
        }
        
        /** Trae todos las Temas que coincidan con el PK. */
        public function temas(){
            return $this->hasMany(Tema::class, 'id_organismo', 'id_organismo');
        }
    }