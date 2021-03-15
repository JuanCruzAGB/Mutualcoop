<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CrearTablaUnionesEntreCategoriaYObra extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('uniones', function(Blueprint $table){
                $table->increments('id_union');
                $table->unsignedInteger('id_categoria');
                $table->unsignedInteger('id_obra');
				$table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('uniones');
        }
    }