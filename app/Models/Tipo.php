<?php
    namespace App\Models;

    use App\Models\Categoria;
    use App\Models\Conexion;
    use App\Models\Gestion;
    use App\Models\Normativa;
    use Cviebrock\EloquentSluggable\Sluggable;
    use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
    use Illuminate\Database\Eloquent\Model;

    class Tipo extends Model{
        use Sluggable, SluggableScopeHelpers;

        /** @var string El nombre de la tabla. */
        protected $table = 'tipos';
        
        /** @var string El nombre de la PK. */
        protected $primaryKey = 'id_tipo';

        /** @var array Los atributos que se van a cargar de forma masiva. */
        protected $fillable = [
            'nombre', 'slug',
        ];

        /** Trae todas las Categorias que coincidan con el PK. */
        public function categorias(){
            return $this->hasMany(Categoria::class, 'id_tipo_gestion', 'id_tipo');
        }
        
        /** Trae todas las Gestiones que coincidan con el PK. */
        public function gestiones(){
            return $this->hasMany(Gestion::class, 'id_tipo_gestion', 'id_tipo');
        }
        
        /** Trae todas las Normativas que coincidan con el PK. */
        public function normativas(){
            return $this->hasMany(Normativa::class, 'id_tipo_normativa', 'id_tipo');
        }
        
        /** Trae todas las conexiones que coincidan con el PK. */
        public function conexiones(){
            return $this->hasMany(Conexion::class, 'id_tipo', 'id_tipo');
        }
        
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
    }