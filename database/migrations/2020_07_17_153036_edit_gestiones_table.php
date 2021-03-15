<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class EditGestionesTable extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::table('gestiones', function (Blueprint $table){
                $table->dropForeign('gestiones_id_tipo_foreign');
                $table->dropColumn('id_tipo');
                $table->unsignedInteger('id_tipo_gestion');
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