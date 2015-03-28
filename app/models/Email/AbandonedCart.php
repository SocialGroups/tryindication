<?php

namespace Email;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;

class AbandonedCart extends \Eloquent
{

    public function __construct()
    {

        $this->connection = DB::connection('neo4j')->getClient();

    }

    public function indication(\Request\AbandonedCart  $data)
    {

        var_dump($data);

    }

}