<?php

use Illuminate\Foundation\Testing\Client;
use Illuminate\Http\Response;

class ClientController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        $teste = new SetClient();
        $teste->teste();
	}

	public function store()
	{

        $post = new stdClass();

        $post->companyHash      = Input::get('companyHash');
        $post->clientId         = Input::get('clientId');
        $post->clientEmail      = Input::get('clientEmail');

        $setProductNeo4j = new SetClient();

        if($post->companyHash AND $post->clientId){


            return json_encode($setProductNeo4j->client($post));

        }

        return (new Response(json_encode(array('error' => 'campos obrigatorios nao preenchidos!')), 400))
            ->header('Content-Type', 400);
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


}
