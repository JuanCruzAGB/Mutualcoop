<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CrearTablaRelacionEntreObraYNormativa extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('relaciones', function(Blueprint $table){
                $table->increments('id_relacion');
                $table->unsignedInteger('id_obra');
                $table->foreign('id_obra')->references('id_obra')->on('obras');
                $table->unsignedInteger('id_normativa');
                $table->foreign('id_normativa')->references('id_normativa')->on('normativas');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('relaciones');
        }
    }