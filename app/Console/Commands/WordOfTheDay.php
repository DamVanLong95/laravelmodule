<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Mail,Config;
class WordOfTheDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Daily email to all users with a word and its meaning';

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
//        dd(Config::get('mail');

            Mail::raw('Hi everyone', function ($message) {
                $message->from('longquanhi95@gmail.com', 'Laravel-v8');

                $message->to('longdam95@gmail.com');
            });
    }
}
