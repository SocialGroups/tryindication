<?php

use Illuminate\Support\Facades\Input;
use Vinelab\NeoEloquent\Tests\Functional\Relations\HyperMorphTo\Post;
use Illuminate\Http\Response;
use Request\Search as RequestSearch;

class SearchController extends \BaseController
{

    /**
     * Display the specified resource.
     *
     * @param  int  $companyHash
     * @param  int  $productId
     * @return Response
     */
    public function show($companyHash,$productId)
    {
        $indication = new Indications();

        return $indication->get($companyHash,$productId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $searchRequest = new RequestSearch([
            'companyHash' 	        => Input::get('companyHash', false),
            'answerKey' 		    => Input::get('answerKey', false),
            'productId' 		    => Input::get('productId', false),
            'relationshipType' 		=> Input::get('relationshipType', false)
        ]);

        if (! $searchRequest->isValid()) {

            return $this->errorResponse($searchRequest->getError());
        }

        die('ok!');

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
