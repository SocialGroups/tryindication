<?php

use Illuminate\Support\Facades\Input;
use Vinelab\NeoEloquent\Tests\Functional\Relations\HyperMorphTo\Post;
use Illuminate\Http\Response;

class SetRedisDataController extends \BaseController {


    /**
     * Display the specified resource.
     *
     * @param  int  $companyHash
     * @return Response
     */
    public function show($companyHash)
    {

        $getRedisAll = new GetNeo4jIndications();

        return $getRedisAll->getAllNodes($companyHash);


    }

}
