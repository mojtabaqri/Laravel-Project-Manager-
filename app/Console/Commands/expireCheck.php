<?php

namespace App\Console\Commands;

use App\Library\Helpers;
use App\Project;
use Carbon\Carbon;
use Illuminate\Console\Command;

class expireCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this is will be check all project that expired  ';

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
      //  $now_time
        $data=Project::all();
        foreach ($data as $item){
            $item->expired_text=Helpers::getDayNum($item);
            $item->save();
        }

        echo 'all project checked Please Check expire_text column : ) ';


    }
}
