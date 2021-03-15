<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class EditNoticiasTable extends Migration{
        /**
         * Run the migrations.
         * 
         * @return void
         */
        public function up(){
            Schema::table('noticias', function (Blueprint $table){
                $table->string('fuente', 60)->nullable()->change();
                $table->renameColumn('imagen', 'archivo');
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