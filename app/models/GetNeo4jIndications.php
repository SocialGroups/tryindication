<?php

use Illuminate\Support\Facades\DB as DB;

class GetNeo4jIndications extends Eloquent
{

    public function getAllNodes($companyHash)
    {

        $products  = SetGraphProduct::with('productId')->get();

        foreach ($products as $product) {

            if($product->productId){

                $this->indication($companyHash,$product->productId);

            }

        }

    }

    public function indication($companyHash,$id)
    {

        $redis = Redis::connection();

        $client = DB::connection('neo4j')->getClient();

        $queryString = "MATCH (product { productId: '$id' })-[:viewed*2..2]-(friend_of_friend)
                        WHERE NOT (product)-[:viewed]-(friend_of_friend) AND product.companyHash = '$companyHash'
                        RETURN friend_of_friend.productId, COUNT(*)
                        ORDER BY COUNT(*) DESC , friend_of_friend.productId
                       ";

        $query  = new \Everyman\Neo4j\Cypher\Query($client, $queryString);
        $result = $query->getResultSet();

        $dataIndications = [];

        foreach ($result as $row) {

            $dataIndications[] = $row['productId'];
        }

        if($dataIndications){

            return $this->setRedisData($redis,$id,$companyHash,$dataIndications);

        }

    }


    protected function setRedisData($redis,$productId,$companyHash,$dataIndications)
    {

        $redis->set($companyHash.'_'.$productId, json_encode($dataIndications));

    }

}