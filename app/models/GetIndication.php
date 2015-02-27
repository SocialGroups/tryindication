<?php

class GetIndication extends Eloquent
{

    protected $label = 'client';

    public function indication($id)
    {

        $redis = Redis::connection();

        return $redis->get($id);

        $user = Testando::create(['name' => 'Some Name', 'email' => 'some@email.com']);

    }

}