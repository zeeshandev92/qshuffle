<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a repository and interface.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        // Determine the file paths
        $repositoryPath = app_path("Repositories/{$name}Repository.php");
        $interfacePath = app_path("Interfaces/{$name}RepositoryInterface.php");

        File::ensureDirectoryExists(app_path('Interfaces'));
        File::ensureDirectoryExists(app_path('Repositories'));


        // Check if the files already exist
        if (File::exists($repositoryPath) || File::exists($interfacePath)) {
            $this->error("Repository or Interface file for '{$name}' already exists!");
            return;
        }

        // Generate interface file
        $interfaceContent = "<?php\n\nnamespace App\Interfaces;\n\ninterface {$name}RepositoryInterface\n{\n}\n";
        File::put($interfacePath, $interfaceContent);

        // Generate repository file
        $repositoryContent = "<?php\n\nnamespace App\Repositories;\nuse App\Interfaces\\{$name}RepositoryInterface;\n\nclass {$name}Repository implements {$name}RepositoryInterface\n{\n}\n";
        File::put($repositoryPath, $repositoryContent);

        $this->info("Repository and Interface created successfully!");
    }
}
