<?php

use Illuminate\Support\Facades\DB as DB;

class SetEmailIndication extends Eloquent
{

    public function getAllNodes($companyHash,$clientId)
    {

        $client = DB::connection('neo4j')->getClient();

        $queryString = "MATCH (a)-[v:`viewed`]->(b) where a.clientId = '$clientId' AND b.productStatus = 'Activated' AND b.companyHash = '$companyHash'
                        RETURN b.productName,b.productImg,b.productPrice,b.productUrl ORDER BY v.created_at DESC LIMIT 3";

        $query  = new \Everyman\Neo4j\Cypher\Query($client, $queryString);
        $result = $query->getResultSet();

        $dataIndications = [];

        foreach ($result as $row) {

            if($row[0] AND $row[1] AND $row[2] AND $row[3]){

                $dataIndications[] = array(

                    'name'  => $row[0], // Get Product Name
                    'img'   => $row[1], // Get Product Url Img
                    'price' => $row[2], // Get Product price
                    'url'   => $row[3]  // Get Product url

                );

            }
        }

        foreach ($dataIndications as $product) {


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
                        WHERE NOT (product)-[:viewed]-(friend_of_friend) AND product.companyHash = '$companyHash' AND b.productStatus = 'Activated'
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


    public function setRedisData($redis,$productId,$companyHash,$dataIndications)
    {

        $redis->set($companyHash.'_'.$productId, json_encode($dataIndications));

    }

}