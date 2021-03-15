<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CrearTablaCategorias extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('categorias', function(Blueprint $table){
                $table->increments('id_categoria');
                $table->unsignedInteger('id_tipo');
                $table->string('nombre', 100);
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
            Schema::dropIfExists('categorias');
        }
    }