<?php

namespace LaraDev\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Exists;


class PropertyController extends Controller
{
  public function index()
  {

    $properties = DB::select('select * from properties');

    return view('property/index')->with('properties', $properties);
  }
  public function show($name)
  {

    $property = DB::select("select * from  properties where name=?", [$name]);

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

    $property = [
      $request->title,
      $propertySlug,
      $request->description,
      $request->rental_price,
      $request->sale_price
    ];

    DB::insert("insert into properties (title, name, description, rental_price, sale_price)
        values (?, ?, ?, ?, ?)", $property);

    return redirect()->action('PropertyController@index');
  }
  public function edit($name)
  {
    $property = DB::select("select * from  properties where name=?", [$name]);

    if (!empty($property)) {
      return view('property/edit')->with('property', $property);
    } else {
      return redirect()->action('PropertyController@index');
    }
  }
  public function update(Request $request, $id)
  {

    $propertySlug = $this->setName($request->title);

    $property = [
      $request->title,
      $propertySlug,
      $request->description,
      $request->rental_price,
      $request->sale_price,
      $id
    ];

    DB::update("update properties set title = ? ,name= ?, description = ?, rental_price = ?, 
    sale_price = ? WHERE id =? ", $property);

    return redirect()->action('PropertyController@index');
  }
  public function destroy($name)
  {
  
    $property = DB::select("select * from  properties where name=?", [$name]);
     

  if (!empty($property)) {
    DB::delete( "delete  from  properties where name=?", [$name]);
   }

  return redirect()->action('PropertyController@index');
  }

  private function setName($title)
  {
    $propertySlug = Str::slug($title);

    $properties = DB::select("select * from properties");

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
