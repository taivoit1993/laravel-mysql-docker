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
        throw $e->getMessage();
      }
    } else {
      throw "Index {$params['index']} exist!";
    }
  }

  public function deleteIndex($params)
  {
  }

  public function updateDocument($params)
  {
  }

  public function updateMulDocument($params)
  {
  }

  public function getDocument($params)
  {
  }

  public function search($params)
  {
  }
}
