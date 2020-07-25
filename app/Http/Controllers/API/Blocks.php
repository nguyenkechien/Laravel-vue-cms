<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BladeRending;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlocksResource;
use App\Models\Blocks as ModelsBlocks;
use Illuminate\Http\Request;

class Blocks extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return BlocksResource::collection(ModelsBlocks::all());
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
        $block = ModelsBlocks::create($request->all());
        return new BlocksResource($block);
    }

    /**
     * Display the specified resource.
     *
     * @param  ModelsBlocks  $block
     * @return \Illuminate\Http\Response
     */
    static public function show(ModelsBlocks $block)
    {
        //
        if (!$block) return response()->json(['message' => 'không có dữ liệu'])->status(404);
        $compeBlock = BladeRending::bladeCompile($block->content);
        $block->content = $compeBlock;
        return new BlocksResource($block);
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
     * @param   ModelsBlocks  $block
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModelsBlocks $block)
    {
        //
        $block->update($request->all());
        return new BlocksResource($block);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ModelsBlocks  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelsBlocks  $block)
    {
        $block->delete();
        return response()->json(['message' => 'Thành công']);
    }
}
