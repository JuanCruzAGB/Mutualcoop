<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class EditEventosTable extends Migration{
        /**
         * Run the migrations.
         * 
         * @return void
         */
        public function up(){
            Schema::table('eventos', function (Blueprint $table){
                $table->string('organizador', 200)->nullable()->change();
                $table->string('video', 200)->nullable();
                $table->string('url_inscripcion', 200)->nullable();
                $table->renameColumn('pdf', 'archivo');
                $table->boolean('privado')->default(false);
                $table->text('detalles')->nullable();
                $table->string('slug', 255);
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