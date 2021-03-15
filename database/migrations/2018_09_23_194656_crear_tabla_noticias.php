<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CrearTablaNoticias extends Migration{
        /**
         * Run the migrations.
         * 
         * @return void
         */
        public function up(){
            Schema::create('noticias', function(Blueprint $table){
                $table->increments('id_noticia');
                $table->string('titulo', 150);
                $table->string('subtitulo', 150)->nullable();
                $table->text('descripcion');
                $table->string('fuente', 60);
                $table->string('imagen');
                $table->unsignedInteger('id_usuario');
                $table->string('slug', 255);
				$table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         * 
         * @return void
         */
        public function down(){
            Schema::dropIfExists('noticias');
        }
    }