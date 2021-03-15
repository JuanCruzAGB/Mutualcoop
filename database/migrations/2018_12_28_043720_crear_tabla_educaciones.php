<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CrearTablaEducaciones extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('educaciones', function(Blueprint $table){
                $table->increments('id_educacion');
                $table->string('titulo', 150);
                $table->text('copete', 100);
                $table->string('archivo');
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
            Schema::dropIfExists('educaciones');
        }
    }