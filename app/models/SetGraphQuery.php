<?php

class SetGraphQuery extends NeoEloquent
{
    protected $label = 'query';

    protected $fillable = ['companyHash', 'value', 'popularity'];


    public static function add(Request\Query $query)
    {
        $query = parent::create([
            'companyHash'   => $query->companyHash,
            'value'         => $query->value,
            'popularity'    => $query->popularity
        ]);

        $queryAttributes = (object) $query->attributes;

        if ($queryAttributes->id) {
            return ['queryId' => $queryAttributes->id];
        }

        return ['error' => '205'];
    }
}
