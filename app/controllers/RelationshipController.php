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

        if($post->companyHash AND $post->clientId AND $post->productId AND $post->relationshipType > null){

            return json_encode($setRelationship->setRelationship($post));
        }

        return json_encode(http_response_code(400));


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
