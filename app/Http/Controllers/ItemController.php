<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Subcategory;
use App\Category;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  
        $brands = Brand::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
            $items = Item::all();
        return view('item.index', compact('items', 'brands', 'subcategories', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $brands = Brand::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
         return view('item.create', compact('brands', 'subcategories', 'categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // dd($request);

        // Validation
        $request-> validate([
            "name" => "required|min:5",
            "photo" => "required|mimes:jpeg,bmp,png", // a.jpg
            "price" => "required",
            "discount" => "sometimes|required",
            "description" => "required",
            "brand" => "required",
            "subcategory" => "required"
           
        ]);

        // If include file, upload
        if($request->file()) {
            // 624872374523_a.jpg
            $fileName = time().'_'.$request->photo->getClientOriginalName();

            // brandimg/624872374523_a.jpg
            $filePath = $request->file('photo')->storeAs('itemimg', $fileName, 'public');

            $path = '/storage/'.$filePath;
        }

        // store
        $item = new Item;
        $item->codeno = uniqid();
        $item->name = $request->name;
        $item->photo = $path;
        $item->price = $request->price;
        $item->discount = $request->discount;
        $item->description = $request->description;
        $item->brand_id = $request->brand;
        $item->subcategory_id = $request->subcategory;
        $item->save();

        // redirect
        return redirect()->route('item.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
         $brands = Brand::all();
         $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('item.show', compact('item', 'brands', 'subcategories', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
          $brands = Brand::all();
          $categories = Category::all();
        $subcategories = Subcategory::all();
         return view('item.edit', compact('item', 'brands', 'subcategories', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
         // dd($request);

        // Validation
        $request-> validate([
            "name" => "required|min:5",
            "photo" => "sometimes|required|mimes:jpeg,bmp,png", // a.jpg
            "price" => "required",
            "discount" => "sometimes|required",
            "description" => "required",
            "brand" => "required",
            "subcategory" => "required"
        ]);

        // If include file, upload
        if($request->file()) {
            // 624872374523_a.jpg
            $fileName = time().'_'.$request->photo->getClientOriginalName();

            // brandimg/624872374523_a.jpg
            $filePath = $request->file('photo')->storeAs('itemimg', $fileName, 'public');

            $path = '/storage/'.$filePath;
        }else{
            $path = $request->oldphoto;
        }

        // store
        $item->name = $request->name;
        $item->photo = $path;
        $item->price = $request->price;
        $item->discount = $request->discount;
        $item->description = $request->description;
        $item->brand_id = $request->brand;
        $item->subcategory_id = $request->subcategory;
        $item->save();

        // redirect
        return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
        unlink(public_path($item->photo));
        $item->delete();
         return redirect()->route('item.index');
    }


    public function filterCategory(Request $request)
    {
        $cid = $request->cid;
        $subcategories = Subcategory::where('category_id',$cid)->get();
        return $subcategories;
    }
}
