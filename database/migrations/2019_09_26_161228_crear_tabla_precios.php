<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CrearTablaPrecios extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('precios', function(Blueprint $table){
                $table->increments('id_precio');
                $table->integer('anual');
                $table->integer('semestral');
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
            Schema::dropIfExists('precios');
        }
    }