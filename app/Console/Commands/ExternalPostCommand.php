<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use App\Square1\ExternalPost;


class ExternalPostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'external:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to fetch external post';

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
     * @return void
     */
    public function handle()
    {
        $posts = (new ExternalPost())->getExternalPost();
        if(!$posts){
            Log::info('External post run at '. now() . ' was not completed');
        }
    }
}
