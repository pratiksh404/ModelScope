<?php
namespace drh2so4\ModelScope;

use Carbon\Carbon;

trait ModelScopes
{
    public function scopeGetLatestAll($query){
        return $query->orderBy('updated_at','ASC')->get();
    }

    public function scopeGetLatest($query,$limit){
        return $query->orderBy('updated_at','ASC')->take($limit)->get();
    }

    public function scopeLastWeekData($query){
        $date = Carbon::today()->subDays(7);
    $query->where('updated_at','>=',$date)->get();
    }

    public function scopeLastWeekDataLimit($query,$limit = 5){
        $date = Carbon::today()->subDays(7);
    $query->where('updated_at','>=',$date)->take($limit)->get();
    }

    public function scopeLastMonthData($query){
        $date = Carbon::today()->subMonth();
        $query->where('updated_at','>=',$date)->get();
    }

    public function scopeLastMonthDataLimit($query,$limit = 5){
        $date = Carbon::today()->subMonth();
        $query->where('updated_at','>=',$date)->take($limit)->get();
    }

    public function scopeTodayData($query){
        $date = Carbon::today();
        $query->where('updated_at',$date)->get();
    }

    public function scopeLastYearData($query){
        $date = Carbon::today()->subYear();
        $query->where('updated_at',$date)->get();
    }

    public function scopeLastYearDataLimit($query,$limit = 5){
        $date = Carbon::today()->subYear();
        return $query->where('updated_at','>=',$date)->take($limit)->get();
    }

    public function scopeAsc($query){
        return $query->orderBy('updated_at','ASC')->get();
    }

    public function scopeDesc($query){
        return $query->orderBy('updated_at','DESC')->get();
    }

    public function scopeTillNowFrom($query,$date){
        $from = Carbon::parse($date);
        return $query->where()->get('updated_at','>=',$from)->get();
    }

    public function scopeBetween($query,$from_date,$to_date){
        $from = Carbon::parse($from_date);
        $to = Carbon::parse($to_date);
        return $query->whereBetween('updated_at',[$from,$to]);
    }

    public function scopeNotBetween($query,$from_date,$to_date){
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