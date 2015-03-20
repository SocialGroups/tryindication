<?php

use Cyphermultiplenodes\Insert;
use Illuminate\Http\Response;
use Request\Product as RequestProduct;
use Illuminate\Support\Facades\DB as DB;

class SetMultipleProducts extends Eloquent
{

    public function prepareProduct(Request\MultipleProducts $data)
    {

        $productsData = json_decode($data->productsData, true);

        $errorSetProduct    = [];
        $sucessSetProduct   = [];
        $sucessGetProduct   = [];

        foreach($productsData as $productData){

            $productRequest = new RequestProduct([
                'companyHash' 	    => $data->companyHash,
                'productId' 		=> $productData['productId'],
                'productPrice' 		=> $productData['productPrice'],
                'productImg' 		=> $productData['productImg'],
                'productStatus' 	=> $productData['productStatus'],
                'productName' 		=> $productData['productName'],
                'productUrl' 		=> $productData['productUrl']
            ]);

            if (! $productRequest->isValid()) {

                $errorSetProduct[$productData['productId']] = $this->errorResponse($productRequest->getError());

            }else{

                $sucessGetProduct[] = $productData['productId'];

                $sucessSetProduct[$productData['productId']] = [
                    'companyHash'   => $data->companyHash,
                    'productId'     => $productData['productId'],
                    'productPrice'  => $productData['productPrice'],
                    'productImg'    => $productData['productImg'],
                    'productStatus' => $productData['productStatus'],
                    'productName'   => $productData['productName'],
                    'productUrl'    => $productData['productUrl']
                ];

            }

        }

        return $this->createProductNode($sucessGetProduct,$sucessSetProduct,$errorSetProduct);

    }

    public function createProductNode($sucessGetProduct,$sucessSetProduct,$errorSetProduct)
    {
        $insertMultipleData = New Insert();
        $queryChypherSetData = $insertMultipleData->indication($sucessSetProduct);

        $client = DB::connection('neo4j')->getClient();
        $query  = new \Everyman\Neo4j\Cypher\Query($client, $queryChypherSetData);
        $query->getResultSet();

        return $sucessGetProduct;

    }

    protected function errorResponse($msg = '')
    {
        $response = new Response();
        $error = json_encode(['error' => $msg]);

        return $response->setContent($error)
            ->setStatusCode(400)
            ->header('Content-Type', 400);
    }

}