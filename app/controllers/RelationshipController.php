<?php

class RelationshipController extends \BaseController
{

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

        $post = new stdClass();

        $post->companyHash      = Input::get('companyHash');
        $post->clientId         = Input::get('clientId');
        $post->productId        = Input::get('productId');
        $post->relationshipType = Input::get('relationshipType');

        $setRelationship = new SetGraphRelationship();
        $setRelationship->setRelationship($post);

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
