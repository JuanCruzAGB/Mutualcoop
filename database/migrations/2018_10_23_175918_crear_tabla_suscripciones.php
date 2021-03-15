<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CrearTablaSuscripciones extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('suscripciones', function(Blueprint $table){
                $table->increments('id_suscripcion');
                $table->unsignedInteger('id_obra');
                $table->unsignedInteger('id_usuario');
				$table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('suscripciones');
        }
    }