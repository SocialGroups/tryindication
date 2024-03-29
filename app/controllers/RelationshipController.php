<?php

use Illuminate\Support\Facades\Input;
use Vinelab\NeoEloquent\Tests\Functional\Relations\HyperMorphTo\Post;
use Illuminate\Http\Response;
use Request\Relationship as RequestRelationship;

class RelationshipController extends \BaseController
{

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

        $relationshipRequest = new RequestRelationship([
            'companyHash' 	        => Input::get('companyHash', false),
            'clientId' 		        => Input::get('clientId', false),
            'productId' 		    => Input::get('productId', false),
            'relationshipType' 		=> Input::get('relationshipType', false)
        ]);

        if (! $relationshipRequest->isValid()) {

            return $this->errorResponse($relationshipRequest->getError());
        }

        $setRelationship = new SetGraphRelationship();

        $returnData = $setRelationship->queueRelationship($relationshipRequest);

        if($returnData['response'] == 204){

            return $this->errorResponse($returnData['msg'],204);

        }

        return json_encode($returnData);


	}

    protected function errorResponse($msg = '',$errorCode = null)
    {

        $response = new Response();

        $error = json_encode([
            'response'  => 'error',
            'msg'       => $msg
        ]);

        if($errorCode){

            $response->setStatusCode($errorCode);

        }

        return $response->setContent($error)
            ->header('Content-Type', $errorCode);
    }


}
