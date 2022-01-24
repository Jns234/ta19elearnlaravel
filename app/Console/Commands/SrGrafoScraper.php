<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use http\Message\Body;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;


class SrGrafoScraper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'steal:SrGrafo';

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
        $guzzle = new Client();
        for($i =434; $i>424; $i--) {
            //$response = $guzzle->get("https://deathbulge.com/comics/$i/", $guzzle);
            $body = $this->getOrCache("https://deathbulge.com/comics/$i", $guzzle);
            //var_dump($body);

            $crawler = new Crawler($body);

                $imgEl = $crawler->filter('img')->eq(5);
                var_dump($imgEl->attr('src'));
                var_dump([
                'img' => $imgEl->attr('src'),
                'title' => $imgEl->attr('alt'),
                'text' => $imgEl->attr('title')
            ]);

            //sleep(1);
        }
    }

    public function getOrCache($url, Client $guzzle){
        if(Cache::has($url)){
            return Cache::get($url);
        }
        $response = $guzzle->get($url);
        //echo "made a request";
        $body = $response->getBody()->getContents();
        Cache::put($url, $body);
        return $body;
    }
}
