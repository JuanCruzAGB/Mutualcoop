<?php
    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder{
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run(){
            $this->call(NivelesTableSeeder::class);
            $this->call(UsuariosTableSeeder::class);
            $this->call(ObrasTableSeeder::class);
            $this->call(TiposTableSeeder::class);
            $this->call(OrganismosTableSeeder::class);
            $this->call(TemasTableSeeder::class);
            $this->call(SuscripcionesTableSeeder::class);
            $this->call(CategoriasTableSeeder::class);
            $this->call(GestionesTableSeeder::class);
            $this->call(EducacionesTableSeeder::class);
            $this->call(VinculosTableSeeder::class);
            $this->call(UnionesTableSeeder::class);
            $this->call(NexosTableSeeder::class);
            $this->call(ConexionesTableSeeder::class);
            $this->call(NormativasTableSeeder::class);
            $this->call(EnlacesTableSeeder::class);
            $this->call(RelacionesTableSeeder::class);
            $this->call(PreciosTableSeeder::class);
            $this->call(NoticiasTableSeeder::class);
            $this->call(EventosTableSeeder::class);
        }
    }