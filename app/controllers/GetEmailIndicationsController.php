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

        $setEmailIndications = new SetEmailIndication();

        return $setEmailIndications->getAllNodes($companyHash,$clientId);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $post = new stdClass();

        $post->companyHash  = Input::get('companyHash');
        $post->clientId     = Input::get('clientId');

        if($post->companyHash AND $post->clientId > null){

            $setIndication = new SetEmailIndication();

        }

    }

}
