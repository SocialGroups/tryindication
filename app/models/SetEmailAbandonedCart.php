<?php

use Illuminate\Support\Facades\DB as DB;

class SetEmailAbandonedCart extends Eloquent
{

    public function __construct()
    {

        $this->connection = DB::connection('neo4j')->getClient();

    }

    public function senderEmail($clientEmail,$productData)
    {

        $productDecondeData = [];

        foreach($productData as $key => $value) {

            $productDecondeData[$key] = json_decode($value);

        }

        Mail::send('emails.hello', array('productData' => $productDecondeData), function($message) use ($clientEmail)
        {

            $message->from('tryindication@gmail.com', 'Lucas Santos');

            $message->to($clientEmail, 'Lucas Santos')
                ->subject('Fala mestre, vamos jogar bola amanhã ?');
        });

    }

    public function getClinetEmail($clientId)
    {

        $queryString = "MATCH (c:`client`) where c.clientId = '$clientId' RETURN c.clientEmail LIMIT 25";

        $query  = new \Everyman\Neo4j\Cypher\Query($this->connection, $queryString);
        $result = $query->getResultSet();

        foreach ($result as $row) {

            return $clientEmail = $row[0]; // Get Client Email

        }

    }

    public function getAllNodes($companyHash,$clientId)
    {

        $queryString = "MATCH (a)-[v:`viewed`]->(b) where a.clientId = '$clientId' AND b.productStatus = 'Activated' AND b.companyHash = '$companyHash'
                        RETURN b.productId,b.productName,b.productImg,b.productPrice,b.productUrl ORDER BY v.created_at DESC LIMIT 3";

        $query  = new \Everyman\Neo4j\Cypher\Query($this->connection, $queryString);
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

        $this->senderEmail($this->getClinetEmail($clientId),$productsIndication);

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