<?php
namespace drh2so4\ModelScope;

trait ModelScopes
{
    public function scopeGetLatestAll($query){
        return $query->orderBy('updated_at','ASC')->get();
    }

    public function scopeGetLatest($query,$limit){
        return $query->orderBy('updated_at','ASC')->take($limit)->get();
    }

    public function scopeLastWeekData($query){
        $date = \Carbon\Carbon::today()->subDays(7);
    $query->where('updated_at','>=',$date)->get();
    }

    public function scopeLastWeekDataLimit($query,$limit = 5){
        $date = \Carbon\Carbon::today()->subDays(7);
    $query->where('updated_at','>=',$date)->take($limit)->get();
    }

    public function scopeLastMonthData($query){
        $date = \Carbon\Carbon::today()->subMonth();
        $query->where('updated_at','>=',$date)->get();
    }

    public function scopeLastMonthDataLimit($query,$limit = 5){
        $date = \Carbon\Carbon::today()->subMonth();
        $query->where('updated_at','>=',$date)->take($limit)->get();
    }

    public function scopeTodayData($query){
        $date = \Carbon\Carbon::today();
        $query->where('updated_at',$date)->get();
    }

    public function scopeAsc($query){
        return $query->orderBy('updated_at','ASC')->get();
    }

    public function scopeDesc($query){
        return $query->orderBy('updated_at','DESC')->get();
    }

    public function scopeFilter($query, array $filterData = [])
    {
        foreach ($filterData as $key => $value) {
   

            if (is_null($value) || $value === '') continue;

            $scopeName = ucfirst(str::of($key)->camel());

            if (method_exists($this, 'scope' . $scopeName)) {
                $query->$scopeName($value);
            } else if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }
    }
}