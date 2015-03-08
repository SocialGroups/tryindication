<?php

use Illuminate\Support\Facades\DB as DB;

class SetEmailIndication extends Eloquent
{

    public function getAllNodes($companyHash,$clientId)
    {

        $client = DB::connection('neo4j')->getClient();

        $queryString = "MATCH (a)-[v:`viewed`]->(b) where a.clientId = '$clientId' AND b.productStatus = 'Activated' AND b.companyHash = '$companyHash'
                        RETURN b.productId,b.productName,b.productImg,b.productPrice,b.productUrl ORDER BY v.created_at DESC LIMIT 3";

        $query  = new \Everyman\Neo4j\Cypher\Query($client, $queryString);
        $result = $query->getResultSet();

        $dataIndications = [];

        foreach ($result as $row) {

            if($row[0] AND $row[1] AND $row[2] AND $row[3]){

                $dataIndications[] = array(

                    'productId' => $row[0], // Get Product Id

                );

            }
        }

        $productsIndication = array();

        foreach ($dataIndications as $product) {

            $productsIndication[$product['productId']] = $this->indication($companyHash,$product['productId']);

        }

        return $productsIndication;

    }

    public function indication($companyHash,$id)
    {

        $redis = Redis::connection();

        return $redis->get($companyHash.'_'.$id);
    }


    public function setRedisData($redis,$productId,$companyHash,$dataIndications)
    {

        $redis->set($companyHash.'_'.$productId, json_encode($dataIndications));

    }

}