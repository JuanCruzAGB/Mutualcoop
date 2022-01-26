<?php
    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder{
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run () {
            $this->call(\Database\Seeders\ConexionesSeeder::class);
            $this->call(\Database\Seeders\GestionesSeeder::class);
        }
    }