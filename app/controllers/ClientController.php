<?php

use Illuminate\Foundation\Testing\Client;

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
        $setProductNeo4j->client($post);
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
