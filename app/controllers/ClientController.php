<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Testing\Client;
use Vinelab\NeoEloquent\Tests\Functional\Relations\HyperMorphTo\Post;
use Illuminate\Http\Response;
use Request\Client as RequestClient;

class ClientController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        //
	}

	public function store()
	{

        $clientRequest = new RequestClient([
            'companyHash' 	    => Input::get('companyHash', false),
            'clientName'        => Input::get('clientName', false),
            'clientEmail' 		=> Input::get('clientEmail', false)
        ]);

        if (! $clientRequest->isValid()) {
            return $this->errorResponse($clientRequest->getError());
        }

        $setProductNeo4j = new SetClient();

        return json_encode($setProductNeo4j->client($clientRequest));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
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
