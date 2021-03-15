<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CrearTablaGestiones extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('gestiones', function(Blueprint $table){
                $table->increments('id_gestion');
                $table->unsignedInteger('id_tipo');
                $table->unsignedInteger('id_categoria')->nullable();
                $table->string('titulo', 150);
                $table->text('copete')->nullable();
                $table->string('archivo');
                $table->string('slug', 255);
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
            Schema::dropIfExists('gestiones');
        }
    }