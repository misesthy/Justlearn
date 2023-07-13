<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::create([
            'name' => 'API',
            'description' => 'Interface provided by an application for interacting with other applications',
            'application_id' => '1',
        ]);
        Module::create([
            'name' => 'Agent guide',
            'description' => 'SAP Data Services Agent provides secure connectivity to on-premise sources in your landscape. At design-time, the agent is used to provide metadata',
            'application_id' => '1',
        ]);
        Module::create([
            'name' => 'Installation',
            'description' => 'Installation et configuration de SAP et de la base de données',
            'application_id' => '1',
        ]);
        Module::create([
            'name' => 'Known issues',
            'description' => 'Problem that requires a reaction because it interrupts, or could interrupt, production.',
            'application_id' => '1',
        ]);
        Module::create([
            'name' => 'Releases',
            'description' => 'Service is defined at service operation level in the Enterprise Services Repository. SAP uses this status to inform service consumers about the lifecycle state of an enterprise service.',
            'application_id' => '1',
        ]);
        Module::create([
            'name' => 'Knowledge base',
            'description' => 'Search a variety of repositories; including SAP Notes, SAP Knowledge Base Articles (KBAs), SAP Community content, documentation and more. Or use Expert Search, which retrieves SAP Notes and Knowledge Base Articles based on advanced selection criteria.',
            'application_id' => '1',
        ]);
        Module::create([
            'name' => 'Plugins',
            'description' => 'Add-On that you can install on a SAP Web Application Server or on another product that is based on SAP BASIS 620 and SAP ABA 620 or higher releases of these software components.',
            'application_id' => '1',
        ]);
    
    }
}
