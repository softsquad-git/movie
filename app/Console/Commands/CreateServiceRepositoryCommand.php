<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateServiceRepositoryCommand extends Command
{

    /**
     * @var string $signature
     */
    protected $signature = 'make:repo:service {className} {dir?} {--type=} {--interface=}';

    /**
     * @var string $description
     */
    protected $description = 'Create Service and Repository class';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return bool|null
     */
    public function handle()
    {
        $repositoryDir = base_path() . '/app/Repositories/';
        $serviceDir = base_path() . '/app/Services/';
        $interfaceDir = base_path() . '/app/Interfaces/';
        $type = $this->option('type');

        if ($this->option('interface') == "true") {
            if (!is_dir($interfaceDir)) {
                mkdir($interfaceDir);
            }
        }
        if ($type == 'repo') {
            if (!is_dir($repositoryDir)) {
                mkdir($repositoryDir);
            }
            $this->saveInterface($interfaceDir, 'Repository');
            return $this->saveRepo($repositoryDir);
        } elseif ($type == 'serv') {
            if (!is_dir($serviceDir)) {
                mkdir($serviceDir);
            }
            $this->saveInterface($interfaceDir, 'Service');
            return $this->saveServ($serviceDir);
        } else {
            if (!is_dir($repositoryDir)) {
                mkdir($repositoryDir);
            }
            $this->saveRepo($repositoryDir);
            if (!is_dir($serviceDir)) {
                mkdir($serviceDir);
            }
            $this->saveServ($serviceDir);
            $this->saveInterface($interfaceDir, 'Repository');
            $this->saveInterface($interfaceDir, 'Service');
        }
        return null;
    }

    /**
     * @param string $serviceDir
     */
    private function saveServ(string $serviceDir)
    {
        if ($this->argument('dir')) {
            if (!is_dir($serviceDir.$this->argument('dir'))) {
                mkdir($serviceDir.$this->argument('dir'));
            }
            $serviceDir = $serviceDir.$this->argument('dir').'/';
        }
        $file = $serviceDir.$this->argument('className').'Service.php';
        if (File::exists($file)) {
            $this->error('Service class already exists');
            return false;
        }
        file_put_contents($file, '<?php ?>');
        $this->info('Success created service class');
        return true;
    }

    /**
     * @param string $interfaceDir
     * @param string $type
     * @return bool
     */
    private function saveInterface(string $interfaceDir, string $type)
    {
        if ($this->option('interface') == "true") {
            if ($this->argument('dir')) {
                if (!is_dir($interfaceDir.$this->argument('dir'))) {
                    mkdir($interfaceDir.$this->argument('dir'));
                }
                $interfaceDir = $interfaceDir.$this->argument('dir').'/';
            }
            $file = $interfaceDir.$this->argument('className').$type.'Interface.php';
            if (File::exists($file)) {
                $this->error('Interface class already exists');
                return false;
            }
            file_put_contents($file, '<?php ?>');
            $this->info('Success created interface class');
            return true;
        }
        return true;
    }

    /**
     * @param string $repositoryDir
     */
    private function saveRepo(string $repositoryDir)
    {
        if ($this->argument('dir')) {
            if (!is_dir($repositoryDir.$this->argument('dir'))) {
                mkdir($repositoryDir.$this->argument('dir'));
            }
            $repositoryDir = $repositoryDir.$this->argument('dir').'/';
        }
        $file = $repositoryDir.$this->argument('className').'Repository.php';
        if (File::exists($file)) {
            $this->error('Repository class already exists');
            return false;
        }
        file_put_contents($file, '<?php ?>');
        $this->info('Success created repository class');
        return true;
    }
}
