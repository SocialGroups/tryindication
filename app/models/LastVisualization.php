<?php

class LastVisualization extends Eloquent
{

    public function __construct()
    {

        $this->redis = Redis::connection('lastVisualization');

    }

    public function get($companyHash,$clientId)
    {

        return $this->redis->get($companyHash.'_'.$clientId);

    }

}