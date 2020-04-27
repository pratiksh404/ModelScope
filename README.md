# Model Scopes

[![N|Solid](https://scontent.fktm8-1.fna.fbcdn.net/v/t1.0-0/p640x640/60100678_658134277969598_1231407466391011328_o.jpg?_nc_cat=108&_nc_sid=85a577&_nc_ohc=Tmv136_KBwAAX-qKjDN&_nc_ht=scontent.fktm8-1.fna&_nc_tp=6&oh=ee4d5a1a220b3960bf6bfdcfe3769e35&oe=5ECE0C05)](https://www.facebook.com/doctypenepal)


This packages provides helpful query builder scopes.
This package provide global scopes for every model by making making usage of trait where scopes is defined.

  - Latest Data Retrive
  - Last Week Data Retrive
  - Last Year Data Retrive
  - Last Month Data Retrive
  - Order Ascending
  - Order Descending
  - Filtering


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

| Plugin | README |
| ------ | ------ |
| Model::getLatestAll() | Retrive data orderd by updated_at timestamp in ascending order |
| Model::getLatest($limit) | This scope expects parameter $limit which return $limit number of data |
| Model::lastWeekData() | Retrives last week data |
| Model::lastWeekDataLimit($limit) | Retrives last week $limit number of data |
| Model::lastMonthData() | Retrives last month data |
| Model::lastMonthDataLimit($limit) | Retrives last month $limit number of data |
| Model::todayData() | Retrives today's data |
| Model::asc() | Ascending Ordered Data |
| Model::desc() | Descending Ordered Data |
| Model::filter(array) | Return multiple where condition data where key is field and value is condition matching value |



### Todos

 //

License
----

MIT


**DOCTYPE NEPAL ||DR.H2SO4**



