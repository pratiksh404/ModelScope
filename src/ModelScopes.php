<?php
namespace drh2so4\ModelScope;

trait ModelScopes
{
    /* ******************************** For all models ******************************** */



    public function scopeLatestGet($query,$limit){
      
        return $query->orderBy('updated_at','ASC')->take($limit)->get();
    }

    public function scopeLatestAll($query){
        return $query->orderBy('updated_at','ASC')->get();
    }


    public function scopeTest($query){
        return $query->orderBy('updated_at','ASC')->get();
    }

 

    /* ******************************************************************************** */

    public function scopeLatestPublishedGet($query,$limit){
        return $query->orderBy('updated_at','ASC')->where('status','PUBLISHED')->take($limit)->get();
    }
    public function scopeLatestImageShowGet($query,$limit){
        return $query->orderBy('updated_at','ASC')->where('image_show',1)->take($limit)->get();
    }
}