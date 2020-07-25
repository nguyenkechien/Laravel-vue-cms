<?php

namespace App\Http\Controllers;

use App\Models\Pages as ModelsPages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

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
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $param
   * @return \Illuminate\Http\Response
   */
  public function show($param)
  {
    $page = ModelsPages::where(['publish' => 1, 'param' => $param])->with('meta_thumbnail')->first();
    if (!$page) return abort(404);
    $compeBlock = BladeRending::bladeCompile($page->content);
    $data = [
      'content' => $compeBlock,
      'titleBar' => [
        'title' => $page['name'],
        'breadCurrent' => $page['name'],
      ],
      'meta' => [
        'meta_title' => $page['meta_title'],
        'meta_keywords' => $page['meta_keywords'],
        'meta_description' => $page['meta_description'],
        'meta_thumbnail' => route('assets.show', $page->meta_thumbnail['name']),
      ]
    ];
    Event::dispatch('pages.view', $page);
    return view('pages.default', $data);
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
    //
  }
}
