<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Abraham\TwitterOAuth\TwitterOAuth;

class announceTweetBatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:announcetweet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * The batch name of laravel log.
     *
     * @var string
     */
    protected $log_name = 'Announce Tweet Batch : ';

    /**
     * Twitter Key.
     *
     * @var string
     */
    protected $twitter_api_key;
    protected $twitter_api__secret_key;
    protected $twitter_access_key;
    protected $twitter_access_key_secret;

    /**
     * Twitter Client.
     *
     * @var TwitterOAuth
     */

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->twitter_api_key = getenv('TWITTER_API_KEY');
        $this->twitter_api_secret_key = getenv('TWITTER_API_SECRET_KEY');
        $this->twitter_access_token = getenv('TWITTER_ACCESS_TOKEN');
        $this->twitter_access_token_secret = getenv('TWITTER_ACCESS_TOKEN_SECRET');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Log::info($this->log_name.'Start Announce Tweet batch.');

        $twitterClient = new TwitterOAuth($this->twitter_api_key,
                                          $this->twitter_api_secret_key,
                                          $this->twitter_access_token,
                                          $this->twitter_access_token_secret);




        \Log::info($this->log_name.'Finish Announce Tweet batch.');
    }

    protected function makeSql(){

    }

    protected function postTweet($twitterClient,$message){
        $result = $twitterClient->post('statuses/update',array('status' => $message));
        if(isset($result->errors)){
            \Log::error($this->log_name.'Twitter  Error. StatusCode  code: '.$result->errors[0]->code.' description: '.$result->errors[0]->message);
        }
    }
}
