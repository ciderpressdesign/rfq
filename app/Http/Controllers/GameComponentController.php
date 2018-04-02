<?php

namespace App\Http\Controllers;

use App\GameComponent;

use Illuminate\Http\Request;

class GameComponentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
		$components = GameComponent::with('componentType')->get();
		return $components;

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
//        return $request->all();
//        $this->validate(request(),[
//            'game_id' => 'required',
//            'game_component_id' => 'required'
//        ]);
		$component = GameComponent::create(request()->all());
		$component['component_type'] = $component->componentType;
		return $component;
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
		return GameComponent::findOrFail($id);
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
		$component = GameComponent::findOrFail($id);
		$component->update($request->all());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{
		//
//        return $request;
//        $component = GameComponent::findOrFail($request->id);
		return GameComponent::destroy($request->id);
	}
}

