<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CrearTablaEnlaces extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('enlaces', function(Blueprint $table){
                $table->increments('id_enlace');
                $table->unsignedInteger('id_normativa');
                $table->unsignedInteger('id_tema');
				$table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('enlaces');
        }
    }