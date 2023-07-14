<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Application::create([
            'name' => 'SAP',
            'description' => 'Solution ERP, éditeurs de logiciels de gestion de processus métier au monde. SAP offre des solutions qui permettent un traitement des données et des flux d\'informations efficaces au sein des entreprises.',
        ]);

        Application::create([
            'name' => 'Odoo',
            'description' => 'Outil ERP le plus polyvalent qui vous aide dans la gestion de votre entreprise. Il est personnalisable avec ses nombreux modules et s\'ajuste à toute sorte de structures. Grâce à lui, vous gagnerez du temps et vous verrez croître votre entreprise.',
        ]);
    
    }
}
