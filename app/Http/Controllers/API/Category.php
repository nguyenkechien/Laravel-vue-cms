<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category as ModelsCategory;
use Illuminate\Http\Request;

class Category extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return CategoryResource::collection(ModelsCategory::all());
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
    $category = ModelsCategory::create($request->all());
    return new CategoryResource($category);
  }

  /**
   * Display the specified resource.
   *
   * @param  ModelsCategory $category
   * @return \Illuminate\Http\Response
   */
  public function show(ModelsCategory $category)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  ModelsCategory $category
   * @return \Illuminate\Http\Response
   */
  public function edit($category)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  ModelsCategory  $category
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, ModelsCategory $category)
  {
    $category->update($request->all());
    return new CategoryResource($category);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  ModelsCategory $category
   * @return \Illuminate\Http\Response
   */
  public function destroy(ModelsCategory $category)
  {
    $category->delete();
    return response()->json(['message' => 'Thành công']);
  }
}
