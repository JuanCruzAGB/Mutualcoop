<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class EditNormativasTable extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::table('normativas', function (Blueprint $table){
                $table->renameColumn('pdf', 'archivo');
                $table->dropForeign('normativas_id_tipo_foreign');
                $table->dropColumn('id_tipo');
                $table->unsignedInteger('id_tipo_normativa');
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