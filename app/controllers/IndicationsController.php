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

}
