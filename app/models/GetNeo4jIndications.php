<?php

use Illuminate\Support\Facades\DB as DB;

class GetNeo4jIndications extends Eloquent
{

    public function __construct()
    {

        $this->redis = Redis::connection();
        $this->neo4j = DB::connection('neo4j')->getClient();

    }

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

        $queryString = "MATCH (product { productId: '$id' })-[:viewed*2..2]-(friend_of_friend)
                        WHERE NOT (product)-[:viewed]-(friend_of_friend) AND product.companyHash = '$companyHash'
                        RETURN friend_of_friend.productId,friend_of_friend.productPrice, friend_of_friend.productImg, friend_of_friend.productName,
                        friend_of_friend.productUrl, COUNT(*)
                        ORDER BY COUNT(*) DESC , friend_of_friend.productId
                       ";

        $query  = new \Everyman\Neo4j\Cypher\Query($this->neo4j, $queryString);
        $result = $query->getResultSet();

        $dataIndications = [];

        foreach ($result as $row) {

            $dataIndications[] = array(
                'productId'     => $row[0],
                'productPrice'  => $row[1],
                'productImg'    => $row[2],
                'productName'   => $row[3],
                'productUrl'    => $row[4]
            );
        }

        if($dataIndications){

            return $this->setRedisData($id,$companyHash,$dataIndications);

        }

    }


    protected function setRedisData($productId,$companyHash,$dataIndications)
    {

        $this->redis->set($companyHash.'_'.$productId, json_encode($dataIndications));

    }

}