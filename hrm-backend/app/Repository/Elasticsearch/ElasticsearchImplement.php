<?php

namespace App\Repository\Elasticsearch;

use Elasticsearch\ClientBuilder;
use Exception;

class ElasticsearchImplement implements ElasticsearchInterface
{
  protected $client;

  public function __construct()
  {
    $hosts = [
      [
        'host' => 'elasticsearch',
        'port' => '9200',
        'scheme' => 'http',
      ],
    ];
    $this->client =  ClientBuilder::create()
      ->setSSLVerification(false)
      ->setHosts($hosts)->build();
  }

  public function getInfo(){
    return $this->client->info();
  }
  public function createIndex($params)
  {
    $indexExist = $this->client->indices()->exists($params);

    if (!$indexExist) {
      try {
        //create a index
        $response = $this->client->indices()->create($params);
        return $response;
      } catch (Exception $e) {
        //catch exception
        throw $e;
      }
    } else {
      throw new Exception("Index {$params['index']} exist!");
    }
  }

  public function deleteIndex($params)
  {
    $indexExist = $this->client->indices()->exists($params);
    if($indexExist){
      try{
        return $this->client->indices()->delete($params);
      }catch(Exception $e){
        throw $e;
      }
    } else {
      throw new Exception("Index {$params['index']} not exist!");
    }
  }

  public function createOrUpdateDocument($params)
  {
    try {
      return $this->client->index($params);
    }catch(Exception $e){
      throw $e;
    }
  
  }

  public function updateMultipleDocuemnt($params)
  {
    try{
      return $this->client->bulk($params);
    }catch(Exception $e){
      throw $e;
    }
  }

  public function getDocument($params)
  {
  }

  public function search($params)
  {
  }
}
