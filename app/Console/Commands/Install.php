<?php

namespace App\Console\Commands;

use App\Module;
use App\ModuleGroup;
use Illuminate\Console\Command;

class Install extends Command
{
    private $Groups = [
        1 =>    [
            'title'     =>  'Produtos',
            'icon'      =>  '<i class="material-icons">layers</i>',
            'position'  =>  0
        ],

        2 =>    [
            'title'     =>  'Clientes',
            'icon'      =>  '<i class="material-icons">group</i>',
            'position'  =>  1
        ],

        3 =>    [
            'title'     =>  'Configurações',
            'icon'      =>  '<i class="material-icons">settings</i>',
            'position'  =>  2
        ],

        4 =>    [
            'title'     =>  'Administração',
            'icon'      =>  '<i class="material-icons">build</i>',
            'position'  =>  99
        ],

        5 => [
            'title'     =>  'Sites',
            'icon'      =>  '<i class="material-icons">important_devices</i>',
            'position'  =>  3
        ]
    ];

    private $Modules = [
        'Client'    =>  [
            'group' =>  2
        ],
        'Module'    =>  [
            'group' =>  4
        ],
        'ModuleGroup'   =>  [
            'group' =>  4
        ],
        'Product'   =>  [
            'group' =>  1
        ],
        'Showcase'  =>  [
            'group' =>  3
        ],
        'Store' =>  [
            'group' =>  3
        ],
        'User'  =>  [
            'group' =>  3
        ],
        'WorkGroup' =>  [
            'group' =>  4
        ],
        'WorkGroupModule'   =>  [
            'group' =>  4
        ],
        'WorkGroupUser' =>  [
            'group' =>  4
        ],
        'Website'   =>  [
            'group' =>  5
        ],
        'WebsiteMenu'   =>  [
            'group' =>  5
        ],
        'WebsiteAbout'   =>  [
            'group' =>  5
        ],
        'WebsiteService'   =>  [
            'group' =>  5
        ],
        'WebsitePortfolio'   =>  [
            'group' =>  5
        ],
        'WebsiteContact'   =>  [
            'group' =>  5
        ],
        'WebsitePage'   =>  [
            'group' =>  5
        ],
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert modules in database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo "Start installing...\n";

        echo "Installing groups...\n";
        $this->registerGroups();

        echo "Installing models...\n";
        $this->registerModels();

        echo "Done!\n";
    }

    /**
     * Insert Groups in table Module_Groups
     *
     * @return bool
     * */
    private function registerGroups ()
    {
        foreach ($this->Groups as $id => $Group) {

            if (ModuleGroup::where('title', $Group['title'])->first()) continue;

            echo "Installing group {$Group['title']}...\n";

            $ModuleGroup = new ModuleGroup();

            $ModuleGroup->fill(array_merge($Group, [
                'id'        =>  $id,
                'status'    =>  1
            ]));
            $ModuleGroup->save();
        }
    }

    /**
     * Insert Model in table Modules
     *
     * @return bool
     * */
    private function registerModels ()
    {
        foreach (scandir(app_path()) as $File) {

            if (! strstr($File, '.php')) continue;

            $File = str_replace('.php', '', $File);

            if (Module::where('title', $File)->first()) continue;

            echo "Installing model {$File}...\n";

            $Module = new Module();

            $Data = [
                'status'    =>  1,
                'title'     =>  $File,
                'group'     =>  0,
                'position'  =>  0,
                'show_menu' =>  1,
            ];

            if (isset( $this->Modules[$File] )) {

                $Data = array_merge($Data, $this->Modules[$File]);
            }

            $Module->fill($Data);
            $Module->save();
        }
    }
}
