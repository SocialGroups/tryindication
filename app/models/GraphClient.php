<?php

class GraphClient extends NeoEloquent {

    public function followers()
    {
        return $this->belongsToMany('User', 'FOLLOWS');
    }
}