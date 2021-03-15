<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CrearTablaEventos extends Migration{
        /**
         * Run the migrations.
         * 
         * @return void
         */
        public function up(){
            Schema::create('eventos', function(Blueprint $table){
                $table->increments('id_evento');
                $table->string('titulo', 150);
                $table->text('descripcion');
                $table->date('fecha');
                $table->string('organizador', 200);
                $table->string('pdf');
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
            Schema::dropIfExists('eventos');
        }
    }