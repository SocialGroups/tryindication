<?php

class GetIndication extends Eloquent
{
    public function indication($companyHash,$id)
    {

        $getIndication = new GetNeo4jIndications();

        return $getIndication->indication($companyHash,$id);

    }

}