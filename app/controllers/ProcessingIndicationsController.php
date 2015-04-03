<?php

use Illuminate\Support\Facades\Input;
use RedisProcessingIndications\Processing;
use Vinelab\NeoEloquent\Tests\Functional\Relations\HyperMorphTo\Post;
use Illuminate\Http\Response;
use Request\Product as RequestProduct;

class ProcessingIndicationsController extends \BaseController
{

    public function showWelcome()
    {

       $processing = new Processing();

       $processing->indication();

    }

}
