<?php

use Illuminate\Support\Facades\Input;
use Vinelab\NeoEloquent\Tests\Functional\Relations\HyperMorphTo\Post;
use Illuminate\Http\Response;

class IndicationsController extends \BaseController
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
     * Display the specified resource from last product visualization.
     *
     * @param  int  $companyHash
     * @param  int  $clientId
     * @return Response
     */
    public function last($companyHash,$clientId)
    {

        $lastViewProduct = new LastVisualization();

        $indication = new Indications();

        return $indication->get($companyHash,$lastViewProduct->get($companyHash,$clientId));
    }

}
