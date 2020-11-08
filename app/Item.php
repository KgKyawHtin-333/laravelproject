<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name', 'photo', 'codeno', 'price', 'discount', 'brand_id', 'subcategory_id', 'description'
    ];

    public function brand()
  {
      return $this->belongsTo('App\Brand');
  }

  public function subcategory()
  {
      return $this->belongsTo('App\Subcategory');
  }

  public function orders()
  {
      return $this->belongsToMany('App\Order','orderdetails')
                  ->withPivot('quantity')
                  ->withTimestamps();
  }
}
