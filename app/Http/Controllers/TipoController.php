<?php
    namespace App\Http\Controllers;

    use App\Models\Categoria;
    use App\Models\Gestion;
    use App\Models\Obra;
    use App\Models\Tipo;
    use App\Models\Vinculo;
    use App\Models\Conexion;
    use Auth;
    use Cviebrock\EloquentSluggable\Services\SlugService;
    use Illuminate\Http\Request;
    use Intervention\Image\ImageManagerStatic as Image;
    use Illuminate\Support\Facades\File;
    use Illuminate\Support\Facades\Validator;
    use Storage;

    class TipoController extends Controller{
        /** @var string - Controller idiom. */
        protected $idiom = 'es';

        static public function getOne($id_tipo = null, $slug = null){
            if($id_tipo != null){
                return Tipo::find($id_tipo);
            }else{
                $tipo = Tipo::where('slug', '=', $slug)->get();
                return $tipo[0];
            }
        }
    }