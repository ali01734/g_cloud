<?php

namespace nataalam\Console\Commands;

use Illuminate\Console\Command;

class CreateStorageDirs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nataalam:create_storage_dirs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
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
        $this->info($this->signature);

        $folders = config('app.storage_dirs');

        foreach ($folders as $folder) {
            if(!\File::exists($folder)) {
                \File::makeDirectory($folder, 493, true);
                $this->info("Created $folder");
            } else {
                $this->warn("$folder already exists");
            }
        }

        $this->comment('done');
    }
}
