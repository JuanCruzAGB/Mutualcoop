<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CrearTablaNexos extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('nexos', function(Blueprint $table){
                $table->increments('id_nexo');
                $table->unsignedInteger('id_obra');
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
            Schema::dropIfExists('nexos');
        }
    }