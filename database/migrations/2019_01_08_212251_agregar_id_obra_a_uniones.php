<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class AgregarIdObraAUniones extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::table('uniones', function(Blueprint $table){
                $table->foreign('id_obra')->references('id_obra')->on('obras');
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