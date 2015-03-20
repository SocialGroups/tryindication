<?php

use Illuminate\Support\Facades\Input;
use Vinelab\NeoEloquent\Tests\Functional\Relations\HyperMorphTo\Post;
use Illuminate\Http\Response;
use Request\MultipleProducts as RequestMultipleProducts;

class MultipleProductsController extends \BaseController
{

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$productMultipleRequest = new RequestMultipleProducts([
			'companyHash' 	    => Input::get('companyHash', false),
            'productsData' 		=> Input::get('productsData', false)
		]);

		if (! $productMultipleRequest->isValid()) {
			return $this->errorResponse($productMultipleRequest->getError());
		}

		$setProductNeo4j = new SetMultipleProducts();
		return json_encode($setProductNeo4j->prepareProduct($productMultipleRequest));
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
