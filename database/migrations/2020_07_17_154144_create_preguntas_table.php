<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreatePreguntasTable extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('preguntas', function (Blueprint $table) {
                $table->bigIncrements('id_pregunta');
                $table->text('pregunta');
                $table->text('respuesta');
                $table->boolean('privado')->default(false);
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('preguntas');
        }
    }