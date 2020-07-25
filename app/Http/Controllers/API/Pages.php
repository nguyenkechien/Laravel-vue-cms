<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BladeRending;
use App\Http\Controllers\Controller;
use App\Http\Resources\PagesResource;
use App\Models\Pages as ModelsPages;
use Illuminate\Http\Request;

class Pages extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    return PagesResource::collection(ModelsPages::with('meta_thumbnail')->get());
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
    $page = ModelsPages::create($request->all());
    return new PagesResource($page);
  }

  /**
   * Display the specified resource.
   *
   * @param  ModelsPages  $page
   * @return \Illuminate\Http\Response
   */
  public function show(ModelsPages  $page)
  {
    $compeBlock = BladeRending::bladeCompile($page->content);
    $page->content = $compeBlock;
    return new PagesResource($page);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  ModelsPages  $page
   * @return \Illuminate\Http\Response
   */
  public function edit(ModelsPages  $page)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  ModelsPages  $page
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, ModelsPages  $page)
  {
    $page->update($request->all());
    return new PagesResource($page);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  ModelsPages  $page
   * @return \Illuminate\Http\Response
   */
  public function destroy(ModelsPages  $page)
  {
    $page->delete();
    return response()->json(['message' => 'Thành công']);
  }
}
