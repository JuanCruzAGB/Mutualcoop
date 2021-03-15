<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CrearTablaNormativas extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('normativas', function(Blueprint $table){
                $table->increments('id_normativa');
                $table->string('titulo', 150);
                $table->text('copete');
                $table->date('fecha');
                $table->string('pdf');
                $table->unsignedInteger('id_tipo');
                $table->unsignedInteger('id_organismo');
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
            Schema::dropIfExists('normativas');
        }
    }