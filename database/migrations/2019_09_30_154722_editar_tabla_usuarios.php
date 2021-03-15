<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class EditarTablaUsuarios extends Migration{
        /**
         * Run the migrations.
         * 
         * @return void
         */
        public function up(){
            Schema::table('users', function (Blueprint $table){
                $table->renameColumn('suscriptor', 'id_suscriptor');
                $table->string('entidad', 300)->nullable()->change();
                $table->renameColumn('id_suscripcion', 'id_tipo');
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