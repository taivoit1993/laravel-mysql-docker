<?php

namespace App\Repository\Elasticsearch;

interface ElasticsearchInterface{

  public function getInfo();
  /**
   * Create a index
   * @array [index => "article"]
   * @param $index : string
   */
  public function createIndex($params);

  /**
   * Delete a index
   * @array [index => "article"]
   */
  public function deleteIndex($params);

  /**
   * Update a Index
   * @array ['index' => 'article', 'id' => 1, 'body'=> []]
   */
  public function createOrUpdateDocument($params);

  /**
   * Update Multiple Index
   * @array ['body' => []]
   * @author taivo
   */
  public function updateMultipleDocuemnt($params);

  public function getDocument($params);

  public function search($params);

}