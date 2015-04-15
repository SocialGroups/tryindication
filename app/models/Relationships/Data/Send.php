<?php

namespace Relationships\Data;

class Send extends \Eloquent
{

    public function __construct()
    {

        $this->connection   = \DB::connection('neo4j')->getClient();

    }

    private function prepareMaths($data)
    {

        $countNode = 0;

        $array = [];

        foreach($data as $mathData){

            $countNode++;

            $maths = "(client".$countNode.":client{clientid: ".$mathData->clientId."}), ";
            $maths .= "(product".$countNode.":product{productId: '".$mathData->productId."'})";

            $array[] = $maths;

        }

        $queryMathsChypher = "Match " . implode($array,',');

        return $queryMathsChypher;
    }

    private function prepareCreates($data)
    {

        $countNode = 0;

        $array = [];

        foreach($data as $createData){

            $countNode++;

            $creats = 'CREATE (client'.$countNode.')-[:amanda222]->(product'.$countNode.')';

            $array[] = $creats;

        }

        $queryCreatsChypher = implode($array,' ');

        return $queryCreatsChypher;
    }

    public function set($prepareMaths,$prepareCreates)
    {

        $cypherQuery = $prepareMaths.' '.$prepareCreates;

        $query  = new \Everyman\Neo4j\Cypher\Query($this->connection, $cypherQuery);
        $query->getResultSet();

        return true;

    }

    public function _prepareCollection(array $data)
    {

        $prepareMaths   = $this->prepareMaths(json_decode($data['relationships']));

        $prepareCreates = $this->prepareCreates(json_decode($data['relationships']));

        return $this->set($prepareMaths,$prepareCreates);

    }
}