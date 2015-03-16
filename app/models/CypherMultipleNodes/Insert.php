<?php

namespace Cyphermultiplenodes;

class Insert
{

    public function Trataments($property)
    {

        return preg_replace('/[^A-Za-z0-9_]+/i', '', $property);

    }

    public function indication($setDataNodes)
    {

        $nodeName = 'product';

        $queryChypher = "CREATE ";

        $array = array();

        foreach($setDataNodes as $nodeData){

            $companyHash    = $nodeData['companyHash'];
            $productId      = $nodeData['productId'];
            $productPrice   = $nodeData['productPrice'];
            $productImg     = $nodeData['productImg'];
            $productStatus  = $nodeData['productStatus'];
            $productName    = $nodeData['productName'];
            $productUrl     = $nodeData['productUrl'];

            //$queryCypher = sprintf('(:%s {companyHash: \'%s\'');
            $queryCypher = "(:$nodeName ";

            $queryCypher .= "{";
            $queryCypher .= "companyHash: '".$companyHash."',";
            $queryCypher .= "productId: '".$productId."',";
            $queryCypher .= "productPrice: '".$productPrice."',";
            $queryCypher .= "productImg: '".$productImg."',";
            $queryCypher .= "productStatus: '".$productStatus."',";
            $queryCypher .= "productName: '".$productName."',";
            $queryCypher .= "productUrl: '".$productUrl."'";
            $queryCypher .= "}";

            $queryCypher .= ")";

            $array[] = $queryCypher;

        }

        $queryChypher = "CREATE " . implode($array,',');

        return $queryChypher;

    }

    public function getIndicationNodeIds($companyHash,$getDataNodes)
    {

        $queryChypher = "MATCH (n:`product`) WHERE n.productId IN ";
        $queryChypher .= "[";

        foreach($getDataNodes as $productNodeId){

            $queryChypher .= "'$productNodeId',";

        }

        $queryChypher = substr($queryChypher,0,-1);

        $queryChypher .= "]";

        $queryChypher .= " AND n.companyHash = '$companyHash' RETURN ID(n),n.productId";

        return $queryChypher;

    }

}