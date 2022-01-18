<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Utils;
use Illuminate\Console\Command;

class ChuckNorrisJoke extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'joke:chuck';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $guzzle = new Client(['verify' => false]);
        $response = $guzzle->get('https://api.chucknorris.io/jokes/random');
        $body = $response->getBody()->getContents();
        //var_dump( $body);
        $joke = Utils::jsonDecode($body);
        echo $joke->value."\n";
    }
}
