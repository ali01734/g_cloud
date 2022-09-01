<?php

namespace nataalam\Console\Commands;

use File;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nataalam:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'creates some necessary folders';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function createStorageFolders()
    {
        \Artisan::call('nataalam:create_storage_dirs');
    }

    private function createStorageFolderSymlink()
    {
        $link = public_path('storage');
        File::delete($link);
        symlink(storage_path('app/public'), $link);
    }

    private function npmInstall()
    {
        $this->comment("Running npm install");
        shell_exec("npm install");
    }

    private function runGulpBuild()
    {
        $this->comment("Running gulp build");
        shell_exec("gulp build");
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->createStorageFolders();
        $this->createStorageFolderSymlink();
        $this->npmInstall();
        $this->runGulpBuild();
    }
}
