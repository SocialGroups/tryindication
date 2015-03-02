<?php

use Illuminate\Support\Facades\Input;
use Vinelab\NeoEloquent\Tests\Functional\Relations\HyperMorphTo\Post;
use Illuminate\Http\Response;
use Request\Product as RequestProduct;

class ProductController extends \BaseController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$productRequest = new RequestProduct([
			'companyHash' 	=> 'Input:companyHash',
			'id' 			=> 'Input:id',
			'price' 		=> 'Input:price',
			'img' 			=> 'Input:img',
			'status' 		=> 'Input:status'
		]);

		if (! $productRequest->isValid()) {
			return $this->errorResponse($productRequest->getError());
		}

		die('FIM!');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// @TODO   
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$productRequest = new RequestProduct([
			'companyHash' 	=> Input::get('companyHash', false),
			'id' 			=> Input::get('productId', false),
			'price' 		=> Input::get('productPrice', false),
			'img' 			=> Input::get('productImg', false),
			'status' 		=> Input::get('productStatus', false)
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
	 * @return Response
	 */
	public function show($id)
	{
        $indication = new GetIndication();
        return $indication->indication($id);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$productRequest = new RequestProduct([
			'companyHash' 	=> Input::get('companyHash', false),
			'id' 			=> Input::get('productId', false),
			'price' 		=> Input::get('productPrice', false),
			'img' 			=> Input::get('productImg', false),
			'status' 		=> Input::get('productStatus', false)
		]);

        $setProductNeo4j = new SetProduct();
        $setProductNeo4j->updateProduct($productRequest);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
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
