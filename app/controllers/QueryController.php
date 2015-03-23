<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Testing\Client;
use Vinelab\NeoEloquent\Tests\Functional\Relations\HyperMorphTo\Post;
use Illuminate\Http\Response;
use Request\Query;

class QueryController extends \BaseController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $query = new Query([
            'companyHash' 	    => Input::get('companyHash', false),
            'value' 		    => Input::get('value', false),
            'popularity'        => 0
        ]);

        if (! $query->isValid()) {
            return $this->errorResponse($query->getError());
        }

        $ret = SetGraphQuery::add($query);

        echo '<pre>';
        dd($ret);
	}


	public function store()
	{
        $query = new RequestQuery([
            'companyHash' 	    => Input::get('companyHash', false),
            'value' 		    => Input::get('value', false),
            'popularity'        => 0
        ]);

        if (! $query->isValid()) {
            return $this->errorResponse($query->getError());
        }

        $setProductNeo4j = new SetClient();

        return json_encode($setProductNeo4j->client($query));
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


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
