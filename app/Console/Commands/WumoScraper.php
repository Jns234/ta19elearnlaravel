<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;

class WumoScraper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'steal:wumo';

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
        $url = "http://wumo.com/wumo";
        $i = 0;
        while ($i<10) {
            //$response = $guzzle->get('https://xkcd.com/$i/', $guzzle);
            $body = $this->getOrCache($url, $guzzle);
            //var_dump($response);
            $crawler = new Crawler($body);
            $imgEl = $crawler->filter('img')->eq(0);
            var_dump([
                    'img' => $imgEl->attr('src')
                ]
            ); //sleep(1);'
            $prevEl = $crawler->filter('a.prev');
            $url = 'http://wumo.com' . $prevEl->attr('href');
            $i++;
        }

    }

    public function getOrCache($url, Client $guzzle)
    {
        if (Cache::has($url)) {
            return Cache::get($url);

        }
        $response = $guzzle->get($url);
        echo "Made a request";
        $body = $response->getBody()->getContents();
        Cache::put($url, $body);
        return $body;
    }
}
