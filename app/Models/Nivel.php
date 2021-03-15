<?php
    namespace App\Models;

    use App\User;
    use Illuminate\Database\Eloquent\Model;

    class Nivel extends Model{
        /** @var string El nombre de la tabla. */
        protected $table = 'niveles';
        
        /** @var string El nombre de la PK. */
        protected $primaryKey = 'id_nivel';

        /** @var array Los atributos que se van a cargar de forma masiva. */
        protected $fillable = [
            'nombre',
        ];
        
        /** Trae todos los Usuarios que coincidan con el PK. */
        public function usuarios(){
            return $this->hasMany(User::class, 'id_nivel', 'id_nivel');
        }
    }