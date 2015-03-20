<?php

namespace Cyphermultiplenodes;

class Insert
{

    public function Trataments($property)
    {

        $string = str_replace('"','',$property);
        $string = str_replace("'","",$string);

        return $string;

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

            $queryCypher = "(:$nodeName ";

            $queryCypher .= "{";
            $queryCypher .= "companyHash: '".$companyHash."',";
            $queryCypher .= "productId: '".$productId."',";
            $queryCypher .= "productPrice: '".$this->Trataments($productPrice)."',";
            $queryCypher .= "productImg: '".$this->Trataments($productImg)."',";
            $queryCypher .= "productStatus: '".$this->Trataments($productStatus)."',";
            $queryCypher .= "productName: '".$this->Trataments($productName)."',";
            $queryCypher .= "productUrl: '".$this->Trataments($productUrl)."'";
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