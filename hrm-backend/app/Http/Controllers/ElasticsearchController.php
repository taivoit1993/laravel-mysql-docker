<?php

namespace App\Http\Controllers;


use Elasticsearch\ClientBuilder;
use Exception;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client as HttpClient;
class ElasticsearchController extends BaseController
{
    public function createIndex()
    {
      $data = [
        'index' => 'Article',
        'id' => 'test',
        'body' => [
          "title" => "A",
          "body" => "B"
        ],
      ];
      $hosts = [
        [
            'host' => 'elasticsearch',        
            'port' => '9200',
            'scheme' => 'http',
        ],
    
    ];
      try{
        $client = ClientBuilder::create()
        ->setSSLVerification(false)
        ->setHosts($hosts)->build();
        $info = $client->info();
        return $info;
        var_dump($info);
        dd();
        $client = new HttpClient(['base_uri' => 'https://0406-2001-ee0-4f80-8e20-f490-732-5305-1f71.ap.ngrok.io']);

        $test = $client->request('GET','/');
        dd($test);
      }catch(Exception $e){
        return response()->json(['data'=>$e->getMessage()]);
      }
    
    }
}
