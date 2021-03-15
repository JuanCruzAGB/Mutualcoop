<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class AgregarIdUsuarioAEventos extends Migration{
        /**
         * Run the migrations.
         * 
         * @return void
         */
        public function up(){
            Schema::table('eventos', function(Blueprint $table){
                $table->foreign('id_usuario')->references('id_usuario')->on('users');
            });
        }

        /**
         * Reverse the migrations.
         * 
         * @return void
         */
        public function down(){
            //
        }
    }