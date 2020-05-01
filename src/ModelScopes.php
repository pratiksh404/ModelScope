<?php
namespace drh2so4\ModelScope;

use Carbon\Carbon;

trait ModelScopes
{
    public function scopeGetLatestAll($query){
        return $query->orderBy('updated_at','ASC');
    }

    public function scopeGetLatestLimit($query,$limit = 5){
        return $query->orderBy('updated_at','ASC')->take($limit);
    }

    public function scopeWeekData($query){
        $date = Carbon::today()->subDays(7);
    $query->whereDate('updated_at','>=',$date);
    }

    public function scopeWeekDataLimit($query,$limit = 5){
        $date = Carbon::today()->subDays(7);
    $query->whereDate('updated_at','>=',$date)->take($limit);
    }

    public function scopeMonthData($query){
        $date = Carbon::today()->subMonth();
        $query->whereDate('updated_at','>=',$date);
    }

    public function scopeMonthDataLimit($query,$limit = 5){
        $date = Carbon::today()->subMonth();
        $query->whereDate('updated_at','>=',$date)->take($limit);
    }

    public function scopeTodayData($query){
        $date = Carbon::today();
        $query->whereDate('updated_at',$date);
    }

    public function scopeYearData($query){
        $date = Carbon::today()->subYear();
        $query->whereDate('updated_at',$date);
    }

    public function scopeYearDataLimit($query,$limit = 5){
        $date = Carbon::today()->subYear();
        return $query->whereDate('updated_at','>=',$date)->take($limit);
    }

    public function scopeAsc($query){
        return $query->orderBy('updated_at','ASC');
    }

    public function scopeDesc($query){
        return $query->orderBy('updated_at','DESC');
    }

    public function scopeTillNowFrom($query,$date){
        $from = Carbon::parse($date);
        return $query->whereDate('updated_at','>=',$from);
    }

    public function scopeDataBetween($query,$from_date,$to_date){
        $from = Carbon::parse($from_date);
        $to = Carbon::parse($to_date);
        return $query->whereBetween('updated_at',[$from,$to]);
    }

    public function scopeDataNotBetween($query,$from_date,$to_date){
        $from = Carbon::parse($from_date);
        $to = Carbon::parse($to_date);
        return $query->whereNotBetween('updated_at',[$from,$to]);
    }


    public function scopeWhereFilter($query, array $filterData = [])
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

    public function scopeorWhereFilter($query, array $filterData = [])
    {
        foreach ($filterData as $key => $value) {
   

            if (is_null($value) || $value === '') continue;

            $scopeName = ucfirst(str::of($key)->camel());

            if (method_exists($this, 'scope' . $scopeName)) {
                $query->$scopeName($value);
            } else if (is_array($value)) {
                $query->orWhere($key, $value);
            } else {
                $query->where($key, $value);
            }
        }
    }

}