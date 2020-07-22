<?php

namespace App\Http\Controllers;

use App\Destinations;
use Illuminate\Http\Request;
use App\Http\Requests\Destinations\CreateDestinationsRequest;
Use App\Destination;
use Illuminate\Support\Facades\Storage;

class DestinationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('destinations.index')->with('destinations', Destinations::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('destinations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDestinationsRequest $request)
    {
        //upload image
        $image = $request ->image->store('destinations');
        //create post
        Destinations::create([
            'title' =>$request->title,
            'description' =>$request->description,
            'content'=>$request->content,
            'image'=>$image,
            'published_at'=>$request->published_at
        ]);
        //flash message 
        session()-> flash('success', 'Destination Created Successfully');

        //redirect
        return redirect(route('destinations.index'));


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
    public function destroy( $id)
    {
        $destinations= Destinations::withTrashed()->where('id', $id)->firstOrFail();


        if($destinations->trashed()){
            Storage::delete($destinations->image);
            $destinations->forceDelete();
        }else{
            $destinations->delete();
        }

        session()->flash('success', 'Destination deleted successfully');

        return redirect(route('destinations.index'));
    }

     /**
     * Display a list of unavailable destinations.
     * @return \Illuminate\Http\Response
     */

    public function trashed()
    {
        $trashed = Destinations::withTrashed()->get();

        return view('destinations.index')->withdestinations($trashed);

    }
}
