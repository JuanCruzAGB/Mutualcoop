<?php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateUsersTable extends Migration{
        /**
         * Run the migrations.
         * 
         * @return void
         */
        public function up(){
            Schema::create('users', function(Blueprint $table){
                $table->increments('id_usuario');
                $table->biginteger('suscriptor')->unique()->nullable();
                $table->string('correo', 100)->unique();
                $table->string('nombre', 60);
                $table->string('clave');
                $table->unsignedInteger('id_nivel');
                $table->string('entidad', 300);
                $table->string('direccion', 160)->nullable();
                $table->string('provincia', 100)->nullable();
                $table->string('cuit', 200)->nullable();
                $table->string('telefono', 100)->nullable();
                $table->integer('id_suscripcion')->nullable();
                $table->boolean('cliente')->default(true);
                $table->date('alta')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         * 
         * @return void
         */
        public function down(){
            Schema::dropIfExists('users');
        }
    }