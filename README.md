# Model Scopes

[![N|Solid](https://scontent.fktm8-1.fna.fbcdn.net/v/t1.0-0/p640x640/60100678_658134277969598_1231407466391011328_o.jpg?_nc_cat=108&_nc_sid=85a577&_nc_ohc=Tmv136_KBwAAX-qKjDN&_nc_ht=scontent.fktm8-1.fna&_nc_tp=6&oh=ee4d5a1a220b3960bf6bfdcfe3769e35&oe=5ECE0C05)](https://www.facebook.com/doctypenepal)


This packages provides helpful query builder scopes.
This package provide global scopes for every model by making making usage of trait where scopes is defined.

  - Latest Data Retrive
  - Week Data Retrive
  - Year Data Retrive
  - Month Data Retrive
  - Between Date Data Retrive
  - Not Between Date Data Retrive
  - Order Ascending
  - Order Descending
  - Multiple Where Filtering
  - Multiple orWhere Filtering


### Installation

Run Composer Require Command

```sh
$ composer require drh2so4/modelscope
```

Use Namespace
```sh
use drh2so4\ModelScope\ModelScopes;
```
then.. Use Trait

```sh
use ModelScopes
```

Overall Structure

```sh
<?php

namespace App;

use App\Post;
use drh2so4\ModelScope\ModelScopes;

class Post{
    use ModelScopes;
    //
    }
}

```

### Package Scopes

Packages scopes is made intented to make use various combination of query builder that we daily use of but don't have specified builder yet.
This package fulfills that. 

| Scopes | Description |
| ------ | ------ |
| Model::getLatestAll() | Retrive data orderd by updated_at timestamp in ascending order |
| Model::getLatestLimit($limit) | This scope expects parameter $limit which return $limit number of data |
| Model::todayData() | Retrives today's data |
| Model::weekData() | Retrives week data |
| Model::weekDataLimit($limit) | Retrives week $limit number of data |
| Model::monthData() | Retrives month data |
| Model::MonthDataLimit($limit) | Retrives month $limit number of data |
| Model::yearData() | Retrives month data |
| Model::yearDataLimit($limit) | Retrives year $limit number of data |
| Model::tillNowFrom($date) | Retrives data from $date till now |
| Model::dataBetween($from,$to) | Retrives data $from date to $to date |
| Model::dataNotBetween($from,$to) | Doesn't retrives data $from date to $to date |
| Model::asc() | Ascending Ordered Data |
| Model::desc() | Descending Ordered Data |
| Model::whereFilter(array) | Return multiple where condition data where key is field and value is condition matching value |
| Model::orWhereFilter(array) | Return multiple or where condition data where key is field and value is condition matching value |

# Documentation


## scopeLatestAll()
```sh
    public function scopeGetLatestAll($query){
        return $query->orderBy('updated_at','ASC');
    }
```
### Usage
```sh

$data = User::latestAll()->get();

```

## scopeGetLatest($limit)
```sh
    public function scopeGetLatestLimit($query,$limit = 5){
        return $query->orderBy('updated_at','ASC')->take($limit);
    }

```
### Usage
```sh

$data = User::latestLimit(8)->get();

```
Retives latest $limit number of data if no parameter given retrives 5(default paremeter value).

## scopeTodayData()
```sh
      public function scopeTodayData($query){
        $date = Carbon::today();
        $query->whereDate('updated_at',$date);
    }

```
### Usage
```sh

$data = User::todayData()->get();

```
Retives data created today.

## scopeWeekData()
```sh
public function scopeWeekData($query){
        $date = Carbon::today()->subDays(7);
    $query->whereDate('updated_at','>=',$date);
    }

```
### Usage
```sh

$data = User::weekData()->get();

```
Retives week created data.

## scopeWeekDataLimit($limit)
```sh

    public function scopeWeekDataLimit($query,$limit = 5){
        $date = Carbon::today()->subDays(7);
    $query->whereDate('updated_at','>=',$date)->take($limit);
    }

```
### Usage
```sh

$data = User::weekDataLimit(8)->get();

```
Retives week $limit number of data if parameter is left empty retives 5(default parameter value) data

## scopeMonthData()
```sh
    public function scopeMonthData($query){
        $date = Carbon::today()->subMonth();
        $query->whereDate('updated_at','>=',$date);
    }

```
### Usage
```sh

$data = User::monthData()->get();

```
Retives month created data.

## scopeMonthDataLimit($limit)
```sh

    public function scopeMonthDataLimit($query,$limit = 5){
        $date = Carbon::today()->subMonth();
        $query->whereDate('updated_at','>=',$date)->take($limit);
    }

```
### Usage
```sh

$data = User::mothDataLimit(8)->get();

```
Retives  month $limit number of data if parameter is left empty retives 5(default parameter value) data

## scopeYearData()
```sh
    public function scopeYearData($query){
        $date = Carbon::today()->subYear();
        $query->whereDate('updated_at',$date);
    }

```
### Usage
```sh

$data = User::yearData()->get();

```
Retives  month created data.

## scopeYearDataLimit($limit)
```sh

    public function scopeYearDataLimit($query,$limit = 5){
        $date = Carbon::today()->subYear();
        return $query->whereDate('updated_at','>=',$date)->take($limit);
    }

```
### Usage
```sh

$data = User::yearDataLimit(8)->get();

```
Retives  year $limit number of data if parameter is left empty retives 5(default parameter value) data

## scopeTodayData()
```sh

    public function scopeTodayData($query){
        $date = Carbon::today();
        $query->whereDate('updated_at',$date);
    }

```
### Usage
```sh

$data = User::todayData()->get();

```
Retives data created today.

## scopeTillNowFrom($date)
```sh

    public function scopeTillNowFrom($query,$date){
        $this->date_validate($date);
        $from = Carbon::createFromFormat('l jS \\of F Y',trim($date));
        return $query->whereDate('updated_at','>=',$from);
    }

```
### Usage
```sh

$data = User::tillNowFrom('Thursday 25th of December 1975')->get();

```
Expects parameter as date in format 'l jS \\of F Y'.
Retrives all data created from $date till now.

## scopeDataBetween($from,$to)
```sh

    public function scopeDataBetween($query,$from_date,$to_date){
        $this->dates_validate($from_date,$to_date);
        $from = Carbon::createFromFormat('l jS \\of F Y',trim($from_date));
        $to = Carbon::createFromFormat('l jS \\of F Y',trim($to_date));
        return $query->whereBetween('updated_at',[$from,$to]);
    }


```
### Usage
```sh

$data = User::dataBetween('Thursday 25th of December 1975',''Saturday 27th of December 1975')->get();

```
Expects parameter as date $from and $to in format 'l jS \\of F Y'.
Retrives all data created  $from and $to.

## scopeDataNotBetween($from,$to)
```sh


    public function scopeDataNotBetween($query,$from_date,$to_date){
        $this->dates_validate($from_date,$to_date);
        $from = Carbon::createFromFormat('l jS \\of F Y',trim($from_date));
        $to = Carbon::createFromFormat('l jS \\of F Y',trim($to_date));
        return $query->whereNotBetween('updated_at',[$from,$to]);
    }

```
### Usage
```sh

$data = User::dataNotBetween('Thursday 25th of December 1975',''Saturday 27th of December 1975')->get();

```
Expects parameter as date $from and $to in format 'l jS \\of F Y'.
Doesn't retrives data created  $from and $to.

## scopeWhereFilter($array)
```sh

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

```
### Usage
```sh

$data = User::whereFilter(['id' => '2'])->get(); 

```
Expect associative array where key is column name and value is column value.
Retrives all the where condition mention.
Above usage equals to User::where('id',2)->get()

### Also Supports multiple where condition !
### Usage
```sh

$data = User::whereFilter(['id' => '2','name' => 'Cat'])->get(); 

```
Retives data with id = 2 and name = cat

## scopeorWhereFilter($array)
```sh

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

```
### Usage
```sh

$data = User::orWhereFilter(['id' => '2'])->get(); 

```
Expect associative array where key is column name and value is column value.
Retrives all the where condition mention.
Above usage equals to User::orWhere('id',2)->get()

### Also Supports multiple orWhere condition !
### Usage
```sh

$data = User::orWhereFilter(['id' => '2','name' => 'Cat'])->get(); 

```
Retives data with id = 2 or name = cat

### Todos

 Exceptions.
 More Scopes.
 Some Testing

License
----

MIT


**DOCTYPE NEPAL ||DR.H2SO4**



