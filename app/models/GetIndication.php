<?php

class GetIndication extends Eloquent
{
    public function indication($companyHash,$id)
    {


        $getIndication = new GetNeo4jIndications();

        return $getIndication->indication($companyHash,$id);

        die;

        $redis = Redis::connection();

        return $redis->get($id);

        $user = Testando::create(['name' => 'Some Name', 'email' => 'some@email.com']);

    }

}