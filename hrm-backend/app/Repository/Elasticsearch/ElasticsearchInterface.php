<?php

namespace App\Repository\Elasticsearch;

interface ElasticsearchInterface{
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
  public function updateDocument($params);

  /**
   * Update Multiple Index
   * @array ['body' => []]
   * @author taivo
   */
  public function updateMulDocument($params);

  public function getDocument($params);

  public function search($params);

}