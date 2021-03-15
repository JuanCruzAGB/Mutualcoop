<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class EditUsersTable extends Migration{
        /**
         * Run the migrations.
         * 
         * @return void
         */
        public function up(){
            Schema::table('users', function (Blueprint $table){
                $table->string('correo_facturacion', 100)->unique()->nullable();
                $table->string('correo_informacion', 100)->unique()->nullable();
                $table->string('localidad', 100)->nullable();
                $table->string('nombre', 60)->nullable()->change();
                $table->string('whatsapp', 100)->nullable();
                $table->renameColumn('cuit', 'cuit_cuil');
                $table->string('cbu', 100)->nullable();
                $table->renameColumn('id_tipo', 'id_tipo_suscripcion');
                $table->integer('cliente')->default(2)->change();
                $table->renameColumn('cliente', 'estado');
                $table->date('baja')->nullable();
                $table->text('detalles')->nullable();
                $table->unsignedInteger('id_nivel')->default(1)->change();
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