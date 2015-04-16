<?php

use Email\AbandonedCart;
use Illuminate\Foundation\Testing\Client;
use Vinelab\NeoEloquent\Tests\Functional\Relations\HyperMorphTo\Post;
use Illuminate\Http\Response;
use Request\AbandonedCart as RequestAbandonedCart;

class AbandonedCartController extends \BaseController
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

        $abandonedCartRequest = new RequestAbandonedCart([
            'companyHash' 	    => Input::get('companyHash', false),
            'clientEmail' 		=> Input::get('clientEmail', false),
            'productId'         => Input::get('productId',false)
        ]);

        if (! $abandonedCartRequest->isValid()) {
            return $this->errorResponse($abandonedCartRequest->getError());
        }

        $abandonedCart = new AbandonedCart();

        return $abandonedCart->setQueue($abandonedCartRequest);
    }

    protected function errorResponse($id,$msg = '')
    {
        $response = new Response();

        $error = json_encode([
            'productId' => $id,
            'response'  => 'error',
            'msg'       => $msg
        ]);

        return $response->setContent($error)
            ->setStatusCode(400)
            ->header('Content-Type', 400);
    }

}
