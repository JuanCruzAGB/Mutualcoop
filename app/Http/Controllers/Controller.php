<?php
    namespace App\Http\Controllers;

    use Carbon\Carbon;
    use Illuminate\Foundation\Bus\DispatchesJobs;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Foundation\Validation\ValidatesRequests;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class Controller extends BaseController{
        use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
        /** @var string - The suscriber Tabs from TabMenu. */
        protected $subsTabs = [];

        public function __construct(){
            ini_set('max_execution_time', 300);
        }

        public function getAdminTabs(){
            return [(object)[
                'url' => '#',
                'icon' => '',
                'name' => 'Suscripción',
                'slug' => 'Suscripción',
                'tabs' => [(object)[
                    'url' => '/normativas',
                    'icon' => 'fas fa-bookmark',
                    'name' => 'Normativas',
                    'slug' => 'normativas',
                    'target' => '',
                    'tabs' => [(object)[
                        'url' => '/normativas/ley',
                        'target' => '',
                        'icon' => 'fas fa-gavel',
                        'name' => 'Ley',
                    ], (object)[
                        'url' => '/normativas/decreto',
                        'target' => '',
                        'icon' => 'fas fa-book-reader',
                        'name' => 'Decreto',
                    ], (object)[
                        'url' => '/normativas/resolucion',
                        'target' => '',
                        'icon' => 'fas fa-book-open',
                        'name' => 'Resolución',
                ], ], ], (object)[
                    'url' => '/gestiones',
                    'icon' => 'fas fa-users-cog',
                    'name' => 'Gestiones',
                    'slug' => 'gestiones',
                    'target' => '',
                    'tabs' => [(object)[
                        'url' => '/gestiones/administrativo-contable',
                        'target' => '',
                        'icon' => 'fas fa-sort-numeric-up',
                        'name' => 'Administrativo Contable',
                    ], (object)[
                        'url' => '/gestiones/analisis-de-la-reglamentacion',
                        'target' => '',
                        'icon' => 'fas fa-search',
                        'name' => 'Análisis de la Reglamentación',
                    ], (object)[
                        'url' => '/gestiones/impositivo',
                        'target' => '',
                        'icon' => 'fas fa-percentage',
                        'name' => 'Impositivo',
                    ], (object)[
                        'url' => '/gestiones/informacion-complementaria',
                        'target' => '',
                        'icon' => 'fas fa-layer-group',
                        'name' => 'Información Complementaria',
                    ], (object)[
                        'url' => '/gestiones/jurisprudencia',
                        'target' => '',
                        'icon' => 'fas fa-code-branch',
                        'name' => 'Jurisprudencia',
                    ], (object)[
                        'url' => '/gestiones/previsional',
                        'target' => '',
                        'icon' => 'fas fa-briefcase',
                        'name' => 'Previsional',
                    ], (object)[
                        'url' => '/gestiones/recursos',
                        'target' => '',
                        'icon' => 'fas fa-folder-open',
                        'name' => 'Recursos',
                ], ], ], (object)[
                    'url' => '#',
                    'icon' => '',
                    'name' => 'Otros',
                    'slug' => 'otros',
                    'target' => '',
                    'tabs' => [(object)[
                        'url' => 'https://www.afip.gob.ar/aplicativos/',
                        'target' => '_blank',
                        'icon' => 'fab fa-app-store',
                        'name' => 'Aplicativos vigentes',
                    ], (object)[
                        'url' => 'http://servicios.infoleg.gob.ar/infolegInternet/anexos/15000-19999/18462/texact.htm',
                        'target' => '_blank',
                        'icon' => 'fab fa-cuttlefish',
                        'name' => 'Ley de Cooperativas',
                    ], (object)[
                        'url' => 'http://servicios.infoleg.gob.ar/infolegInternet/anexos/25000-29999/25392/norma.htm',
                        'target' => '_blank',
                        'icon' => 'fab fa-medium-m',
                        'name' => 'Ley de Mutuales',
                    ], (object)[
                        'url' => '/educaciones',
                        'target' => '',
                        'icon' => 'fas fa-rss',
                        'name' => 'Notas de Interés',
            ] ], ] ], ], (object)[
                'url' => '#',
                'icon' => '',
                'name' => 'Administración',
                'slug' => 'administración',
                'target' => '',
                'tabs' => [(object)[
                    'url' => '/panel/eventos',
                    'target' => '',
                    'icon' => 'fas fa-calendar',
                    'name' => 'Eventos',
                ], (object)[
                    'url' => '/panel/gestiones',
                    'target' => '',
                    'icon' => 'fas fa-users-cog',
                    'name' => 'Gestiones',
                ], (object)[
                    'url' => '/panel/normativas',
                    'target' => '',
                    'icon' => 'fas fa-bookmark',
                    'name' => 'Normativas',
                ], (object)[
                    'url' => '/panel/noticias',
                    'target' => '',
                    'icon' => 'fas fa-newspaper',
                    'name' => 'Noticias',
                ], (object)[
                    'url' => '/panel/educaciones',
                    'target' => '',
                    'icon' => 'fas fa-rss',
                    'name' => 'Notas de Interés',
                ], (object)[
                    'url' => '/panel/precios',
                    'target' => '',
                    'icon' => 'fas fa-dollar-sign',
                    'name' => 'Precios',
                ], (object)[
                    'url' => '/panel/preguntas',
                    'target' => '',
                    'icon' => 'fas fa-question',
                    'name' => 'Preguntas Frecuantes',
                ], (object)[
                    'url' => '/panel/usuarios',
                    'target' => '',
                    'icon' => 'fas fa-users',
                    'name' => 'Usuarios',
            ] ], ], (object)[
                'url' => '#',
                'icon' => '',
                'name' => 'Vistas',
                'slug' => 'vistas',
                'target' => '',
                'tabs' => [(object)[
                    'url' => '/panel/facturaciones',
                    'target' => '',
                    'icon' => 'fas fa-file-invoice-dollar',
                    'name' => 'Facturaciones',
                ], (object)[
                    'url' => '/panel/suscriptores',
                    'target' => '',
                    'icon' => 'fas fa-users',
                    'name' => 'Suscriptores',
            ] ], ], ];
        }

        public function getSubsTabs(){
            return [(object)[
                'url' => '/normativas',
                'icon' => 'fas fa-bookmark',
                'name' => 'Normativas',
                'slug' => 'normativas',
                'target' => '',
                'tabs' => [(object)[
                    'url' => '/normativas/ley',
                    'target' => '',
                    'icon' => 'fas fa-gavel',
                    'name' => 'Ley',
                ], (object)[
                    'url' => '/normativas/decreto',
                    'target' => '',
                    'icon' => 'fas fa-book-reader',
                    'name' => 'Decreto',
                ], (object)[
                    'url' => '/normativas/resolucion',
                    'target' => '',
                    'icon' => 'fas fa-book-open',
                    'name' => 'Resolución',
            ], ], ], (object)[
                'url' => '/gestiones',
                'icon' => 'fas fa-users-cog',
                'name' => 'Gestiones',
                'slug' => 'gestiones',
                'target' => '',
                'tabs' => [(object)[
                    'url' => '/gestiones/administrativo-contable',
                    'target' => '',
                    'icon' => 'fas fa-sort-numeric-up',
                    'name' => 'Administrativo Contable',
                ], (object)[
                    'url' => '/gestiones/analisis-de-la-reglamentacion',
                    'target' => '',
                    'icon' => 'fas fa-search',
                    'name' => 'Análisis de la Reglamentación',
                ], (object)[
                    'url' => '/gestiones/impositivo',
                    'target' => '',
                    'icon' => 'fas fa-percentage',
                    'name' => 'Impositivo',
                ], (object)[
                    'url' => '/gestiones/informacion-complementaria',
                    'target' => '',
                    'icon' => 'fas fa-layer-group',
                    'name' => 'Información Complementaria',
                ], (object)[
                    'url' => '/gestiones/jurisprudencia',
                    'target' => '',
                    'icon' => 'fas fa-code-branch',
                    'name' => 'Jurisprudencia',
                ], (object)[
                    'url' => '/gestiones/previsional',
                    'target' => '',
                    'icon' => 'fas fa-briefcase',
                    'name' => 'Previsional',
                ], (object)[
                    'url' => '/gestiones/recursos',
                    'target' => '',
                    'icon' => 'fas fa-folder-open',
                    'name' => 'Recursos',
            ], ], ], (object)[
                'url' => '#',
                'icon' => '',
                'name' => 'Otros',
                'slug' => 'otros',
                'target' => '',
                'tabs' => [(object)[
                    'url' => 'https://www.afip.gob.ar/aplicativos/',
                    'target' => '_blank',
                    'icon' => 'fab fa-app-store',
                    'name' => 'Aplicativos vigentes',
                ], (object)[
                    'url' => 'http://servicios.infoleg.gob.ar/infolegInternet/anexos/15000-19999/18462/texact.htm',
                    'target' => '_blank',
                    'icon' => 'fab fa-cuttlefish',
                    'name' => 'Ley de Cooperativas',
                ], (object)[
                    'url' => 'http://servicios.infoleg.gob.ar/infolegInternet/anexos/25000-29999/25392/norma.htm',
                    'target' => '_blank',
                    'icon' => 'fab fa-medium-m',
                    'name' => 'Ley de Mutuales',
                ], (object)[
                    'url' => '/educaciones',
                    'target' => '',
                    'icon' => 'fas fa-rss',
                    'name' => 'Notas de Interés',
            ] ], ] ];
        }

        /**
         * Create the a date format text.
         * @param $idiom - The date idiom.
         * @param $obj - The object.
         */
        public function createDate($idiom, $date){
            Carbon::setLocale($idiom);
            $date = new Carbon($date);
            $date = $date->diffForHumans();
            return $date;
        }

        /**
         * * Create inputs in the Request dividing them according to a String.
         * @param Request $request
         * @param string $string
         * @return object
         */
        public function makeInputsByExplode(Request $request, $string){
            $object = (object) $request->input();
            $input = [];
            foreach ($object as $name => $value) {
                if(preg_match("/$string/", $name)){
                    $input[explode("$string", $name)[1]] = $value;
                }
            }
            return (object) $input;
        }

        /**
         * * Create error messages in the validation by editing the Key according to a String.
         * @param mixed $validator
         * @param string $string
         * @return object
         */
        public function joinErrors($validator, $string){
            foreach($validator->errors()->messages() as $key => $value){
                $validator->errors()->add("$string" . $key, $value[0]);
            }
            return (object) $validator->errors();
        }

        /**
         * * Return the Minified month traslated.
         * @return [type]
         */
        public function getTranslatedMinifiedMonth(){
            return [
                'Jan' => 'Ene',
                'Feb' => 'Feb',
                'Mar' => 'Mar',
                'Apr' => 'Abr',
                'May' => 'May',
                'Jun' => 'Jun',
                'Jul' => 'Jul',
                'Aug' => 'Ago',
                'Oct' => 'Oct',
                'Nov' => 'Nov',
                'Dec' => 'Dic',
            ];
        }

        /**
         * * Escape the HTML tags.
         * @param mixed $string - The string.
         * @return [type]
         */
        public function escapeTags($string){
            return preg_replace("/<(.*?)>/", "", $string);
        }

        /**
         * * Minific a text.
         * @param mixed $string - The string.
         * @param mixed $length - The max length.
         * @return [type]
         */
        public function minific($string, $length){
            return substr($this->escapeTags($string), 0, $length) . '...';
        }

        /**
         * * Replace a string with another.
         * @param mixed $string
         * @param mixed $regexp
         * @param mixed $newString
         * @return [type]
         */
        public function replaceString($string, $regexp, $newString){
            return preg_replace("/$regexp/", $newString, $string);
        }
    }