<?php

namespace App\Http\Controllers;

use App\Repository\Elasticsearch\ElasticsearchInterface;
use Elasticsearch\ClientBuilder;
use Exception;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Http\Request;

class ElasticsearchController extends BaseController
{
  protected $clientElasticsearch;

  public function __construct(ElasticsearchInterface $elasticsearchRepository)
  {
    $this->clientElasticsearch = $elasticsearchRepository;
  }

  public function getInfo()
  {
    try {
      return $this->clientElasticsearch->getInfo();
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
  }

  public function createIndex(Request $request)
  {
    $params = [
      'index' => $request->index
    ];
    try {
      return $this->clientElasticsearch->createIndex($params);
    } catch (Exception $e) {
      return response()->json(['data' => $e->getMessage()]);
    }
  }

  public function deleteIndex($index)
  {
    $params = [
      'index' => $index
    ];
    try {
      return $this->clientElasticsearch->deleteIndex($params);
    } catch (Exception $e) {
      return response()->json(['data' => $e->getMessage()]);
    }
  }

  public function createDocument(Request $request)
  {
    $params = [
      'index' => $request->index,
      'id' => $request->id,
      'type' => $request->type,
      'body' => [
        'title' => $request->title,
        'content' => $request->content
      ]
      ];
    try{
      return $this->clientElasticsearch->createOrUpdateDocument($params);
    }catch(Exception $e){
      return response()->json(['data' => $e->getMessage()]);
    }
  }

  public function createMultipleDocument(Request $request){
    $data = $request->data;
    $body = [];
    foreach ($data as $item)
    {
      $temp = [
        ['index' => ['_index' => $item['index'], '_type' => $item['type']]],
        ['title' => $item['data']['title'],'content' => $item['data']['content']]
      ];
      array_push($body, $temp);
    };
    $params = [
      'body' => $body
    ];
    dd($params);
    try{
      return $this->clientElasticsearch->createOrUpdateDocument($params);
    }catch(Exception $e){
      return response()->json(['data' => $e->getMessage()]);
    }
   
  }
}
