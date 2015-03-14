<?php

use Illuminate\Support\Facades\Input;
use Vinelab\NeoEloquent\Tests\Functional\Relations\HyperMorphTo\Post;
use Illuminate\Http\Response;

class GetEmailIndicationsController extends \BaseController
{

    /**
     * Display the specified resource.
     *
     * @param  int  $clientId
     * @param  int  $companyHash
     * @return Response
     */
    public function show($companyHash,$clientId)
    {

        $setEmailIndications = new SetEmailAbandonedCart();

        return $setEmailIndications->getAllNodes($companyHash,$clientId);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

//        $clientRequest = new RequestClient([
//            'companyHash' 	    => Input::get('companyHash', false),
//            'clientId' 		    => Input::get('clientId', false),
//            'clientEmail' 		=> Input::get('clientEmail', false)
//        ]);
//
//        if (! $clientRequest->isValid()) {
//            return $this->errorResponse($clientRequest->getError());
//        }
//
//        $setIndication = new SetEmailIndication();
    }

}
