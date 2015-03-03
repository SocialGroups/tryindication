<?php

use Illuminate\Support\Facades\Input;
use Vinelab\NeoEloquent\Tests\Functional\Relations\HyperMorphTo\Post;
use Illuminate\Http\Response;
use Request\Product as RequestProduct;

class ProductController extends \BaseController
{

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$productRequest = new RequestProduct([
			'companyHash' 	    => Input::get('companyHash', false),
            'productId' 		=> Input::get('productId', false),
			'productPrice' 		=> Input::get('productPrice', false),
			'productImg' 		=> Input::get('productImg', false),
			'productStatus' 	=> Input::get('productStatus', false),
            'productName' 		=> Input::get('productName', false),
            'productUrl' 		=> Input::get('productUrl', false)
		]);

		if (! $productRequest->isValid()) {
			return $this->errorResponse($productRequest->getError());
		}

		$setProductNeo4j = new SetProduct();
		return json_encode($setProductNeo4j->createProductNode($productRequest));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
     * @param  int  $companyHash
	 * @return Response
	 */
	public function show($companyHash,$id)
	{
        $indication = new GetIndication();

        return $indication->indication($companyHash,$id);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$productRequest = new RequestProduct([
			'companyHash' 	    => Input::get('companyHash', false),
            'productId' 		=> Input::get('productId', false),
			'productPrice' 		=> Input::get('productPrice', false),
			'productImg' 		=> Input::get('productImg', false),
			'productStatus' 	=> Input::get('productStatus', false),
            'productName' 		=> Input::get('productName', false),
            'productUrl' 		=> Input::get('productUrl', false)
		]);

		if (! $productRequest->isValid()) {
			return $this->errorResponse($productRequest->getError());
		}

        $setProductNeo4j = new SetProduct();
        $setProductNeo4j->updateProduct($id,$productRequest);
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
