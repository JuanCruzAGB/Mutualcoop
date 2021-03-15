<?php
    namespace App\Models;

    use App\Models\Obra;
    use App\User;
    use Illuminate\Database\Eloquent\Model;

    class Suscripcion extends Model{
        /** @var string El nombre de la tabla. */
        protected $table = 'suscripciones';
        
        /** @var string El nombre de la PK. */
        protected $primaryKey = 'id_suscripcion';

        /** @var array Los atributos que se van a cargar de forma masiva. */
        protected $fillable = [
            'id_obra', 'id_usuario',
        ];
        
        /** Trae la Obra que coincidan con el PK. */
        public function obra(){
            return $this->belongsTo(Obra::class, 'id_obra', 'id_obra');
        }
        
        /** Trae el Usuario que coincidan con el PK. */
        public function usuario(){
            return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
        }
    }