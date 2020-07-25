<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsResource;
use App\Models\Products as ModelsProducts;
use Illuminate\Http\Request;

class Products extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    return ProductsResource::collection(ModelsProducts::all());
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
    $product = ModelsProducts::create($request->all());
    return new ProductsResource($product);
  }

  /**
   * Display the specified resource.
   *
   * @param  ModelsProducts  $id
   * @return \Illuminate\Http\Response
   */
  public function show(ModelsProducts $product)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  ModelsProducts  $product
   * @return \Illuminate\Http\Response
   */
  public function edit(ModelsProducts $product)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  ModelsProducts  $product
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, ModelsProducts $product)
  {
    //
    $product->update($request->all());
    return new ProductsResource($product);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  ModelsProducts  $product
   * @return \Illuminate\Http\Response
   */
  public function destroy(ModelsProducts $product)
  {
    //
    $product->delete();
    return response()->json(['message' => 'Thành công']);
  }
}
