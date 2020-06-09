<?php

namespace LaraDev\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Exists;
use LaraDev\Property;


class PropertyController extends Controller
{
  public function index()
  {

    //$properties = DB::select('select * from properties');
    $properties = property::all();
    return view('property/index')->with('properties', $properties);
  }
  public function show($name)
  {

    //$property = DB::select("select * from  properties where name=?", [$name]);
    $property = Property::where('name', $name)->get();
    if (!empty($property)) {
      return view('property/show')->with('property', $property);
    } else {
      return redirect()->action('PropertyController@index');
    }
  }

  public function create()
  {
    return view('property/create');
  }

  public function store(Request $request)
  {
    $propertySlug = $this->setName($request->title);

    /*$property = [
      $request->title,
      $propertySlug,
      $request->description,
      $request->rental_price,
      $request->sale_price
    ];

    DB::insert("insert into properties (title, name, description, rental_price, sale_price)
        values (?, ?, ?, ?, ?)", $property);*/
    $property = [
      'title' => $request->title,
      'name' => $request->name,
      'description' => $request->description,
      'rental_price' => $request->rental_price,
      'sale_price' => $request->sale_price
    ];
    Property::create($property);

    return redirect()->action('PropertyController@index');
  }
  public function edit($name)
  {
    //$property = DB::select("select * from  properties where name=?", [$name]);
    $property = Property::where('name', $name)->get();

    if (!empty($property)) {
      return view('property/edit')->with('property', $property);
    } else {
      return redirect()->action('PropertyController@index');
    }
  }
  public function update(Request $request, $id)
  {

    $propertySlug = $this->setName($request->title);

    /*$property = [
      $request->title,
      $propertySlug,
      $request->description,
      $request->rental_price,
      $request->sale_price,
      $id
    ];

    DB::update("update properties set title = ? ,name= ?, description = ?, rental_price = ?, 
    sale_price = ? WHERE id =? ", $property);*/
    $property =  Property::find($id);

    $property->title = $request->title;
    $property->name = $propertySlug;
    $property->description = $request->description;
    $property->rental_price = $request->rental_price;
    $property->sale_price = $request->sale_price;

    $property->save();
    return redirect()->action('PropertyController@index');
  }
  public function destroy($name)
  {

    //$property = DB::select("select * from  properties where name=?", [$name]);
    $property = Property::where('name', $name)->get();


    if (!empty($property)) {
      DB::delete("delete  from  properties where name=?", [$name]);
    }

    return redirect()->action('PropertyController@index');
  }

  private function setName($title)
  {
    $propertySlug = Str::slug($title);

    // $properties = DB::select("select * from properties");
    $properties = Property::all();

    $i = 0;
    foreach ($properties as $property) {
      if (Str::slug($property->title) === $propertySlug) {
        $i++;
      }
    }

    if ($i > 0) {
      $propertySlug = $propertySlug . $i;
    }
    return $propertySlug;
  }
}
