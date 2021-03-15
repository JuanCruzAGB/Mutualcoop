<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CrearTablaObras extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('obras', function(Blueprint $table){
                $table->increments('id_obra');
                $table->string('nombre', 60);
                $table->text('descripcion');
                $table->string('imagen');
                $table->string('slug', 255);
                $table->string('anual', 255)->nullable();
                $table->string('semestral', 255)->nullable();
                $table->string('mensual', 255);
				$table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('obras');
        }
    }