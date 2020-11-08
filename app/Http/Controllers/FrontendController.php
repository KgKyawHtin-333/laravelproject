<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Subcategory;
use App\Brand;

class FrontendController extends Controller
{
    //
       public function home($value='')
  {
    $items = Item::all();
    $brands = Brand::all();
    return view('frontend.mainpage',compact('items', 'brands'));
  }

     public function login($value=''){
    	return view('frontend.login_page');
    }


     public function signup($value=''){
    	return view('frontend.signup_page');
    }

     public function itemdetail($id){
     	$item = Item::find($id);
    	return view('frontend.itemdetail', compact('item'));
    }


     public function itemsbysubcategory($id){
        $mysubcategory = Subcategory::find($id);
       
        return view('frontend.itemsbysubcategory', compact('mysubcategory'));
    }

      public function cart($value='')
  {
    return view('frontend.cartpage');
  }

    
}
