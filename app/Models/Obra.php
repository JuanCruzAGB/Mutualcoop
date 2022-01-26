<?php
    namespace App\Models;

    use App\Models\Conexion;
    use App\Models\Gestion;
    use App\Models\Nexo;
    use App\Models\Relacion;
    use App\Models\Suscripcion;
    use App\Models\Union;
    use App\Models\Vinculo;
    use Cviebrock\EloquentSluggable\Sluggable;
    use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
    use Illuminate\Database\Eloquent\Model;

    class Obra extends Model{
        use Sluggable, SluggableScopeHelpers;

        /** @var string El nombre de la tabla. */
        protected $table = 'obras';
        
        /** @var string El nombre de la PK. */
        protected $primaryKey = 'id_obra';

        /** @var array Los atributos que se van a cargar de forma masiva. */
        protected $fillable = [
            'nombre', 'descripcion', 'imagen', 'slug', 'anual', 'semestral', 'mensual',
        ];
        
        /**
         * Devuelve la configuracion del slug del modelo.
         * 
         * @return array
         */
        public function sluggable(){
            return [
                'slug' => [
                    'source'	=> 'nombre',
                    'onUpdate'	=> true,
                ]
            ];
        }

        /**
         * * Get all of the Gestiones for the Obra.
         * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
         */
        public function gestiones () {
            return $this->hasManyThrough(Gestion::class, Vinculo::class, 'id_obra', 'id_gestion', 'id_obra', 'id_gestion');
        }

        /**
         * * Get all of the Normativas for the Obra.
         * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
         */
        public function normativas () {
            return $this->hasManyThrough(Normativa::class, Relacion::class, 'id_obra', 'id_normativa', 'id_obra', 'id_normativa');
        }
    }