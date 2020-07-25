<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImagesResource;
use App\Models\Images as ModelsImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;


class Images extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return ImagesResource::collection(ModelsImages::orderBy('id', 'DESC')->get());
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
    $images = $request->File('photos');
    if ($request->hasFile('photos')) {
      foreach ($images as $image) {
        $path = $image->store('public/photos');
        $storageName = basename($path);
        $name = explode('.', $storageName)[0];
        ModelsImages::create([
          'name' => $name,
          'url' => $path
        ]);
      }
      return response()->json(['message' => 'Thành công']);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
    $path = ModelsImages::where('name', $id)->firstOrFail();
    if ($path && Storage::disk('local')->exists($path->url)) {
      $file = Storage::get($path->url);
      $type = Storage::mimeType($path->url);
      return Response::make($file, 200)->header("Content-Type", $type);
    }

    return abort(404);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $image = ModelsImages::where('name', $id)->firstOrFail();
    Storage::delete($image->url);
    $image->delete();
    return response()->json(['message' => 'Thành công']);
  }
}
