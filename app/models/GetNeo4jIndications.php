<?php

use Illuminate\Support\Facades\DB as DB;

class GetNeo4jIndications extends Eloquent
{

    public function indication($id)
    {

        $client = DB::connection('neo4j')->getClient();

        $queryString = "MATCH (product { productId: '$id' })-[:viewed*2..2]-(friend_of_friend)
                        WHERE NOT (product)-[:viewed]-(friend_of_friend)
                        RETURN friend_of_friend.productId, COUNT(*)
                        ORDER BY COUNT(*) DESC , friend_of_friend.productId
                       ";
        $query  = new \Everyman\Neo4j\Cypher\Query($client, $queryString);
        $result = $query->getResultSet();

        $dataIndications = [];
        foreach ($result as $row) {

            $dataIndications[] = $row['productId'];
        }

        return $dataIndications;

    }

}