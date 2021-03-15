<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CrearTablaVinculosEntreGestionYObra extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('vinculos', function(Blueprint $table){
                $table->increments('id_vinculo');
                $table->unsignedInteger('id_gestion');
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
            Schema::dropIfExists('vinculos');
        }
    }