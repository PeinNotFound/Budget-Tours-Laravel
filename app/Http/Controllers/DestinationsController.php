<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use App\Destinations;
use Illuminate\Http\Request;
use App\Http\Requests\Destinations\CreateDestinationsRequest;
use App\Http\Requests\Destinations\UpdateDestinationsRequest;
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DestinationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('destinations.index')->with('destinations', Destinations::with(['primaryImage', 'category'])->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('destinations.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'location' => 'required',
            'price' => 'required|numeric',
            'days' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Format the pricing as a string with currency
        $validatedData['pricing'] = 'Kshs ' . number_format($validatedData['price']);
        
        // Create the destination
        $destination = Destinations::create($validatedData);

        if ($request->hasFile('images')) {
            $isPrimary = true; // First image will be primary
            foreach ($request->file('images') as $image) {
                $path = $image->store('destinations', 'public');
                $destination->images()->create([
                    'image' => $path,
                    'is_primary' => $isPrimary
                ]);
                $isPrimary = false;
            }
        }

        return redirect('/admin/destinations')
            ->with('success', 'Destination created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $destination = Destinations::with(['images', 'primaryImage', 'category'])
            ->findOrFail($id);
            
        return view('destinations.show', [
            'destination' => $destination
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Destinations  $destination
     * @return \Illuminate\Http\Response
     */
    public function edit(Destinations $destination)
    {
        return view('destinations.edit')
            ->with('destinations', $destination)
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Destinations  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $destination = Destinations::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'nullable',
            'location' => 'required',
            'price' => 'required|numeric',
            'days' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_images' => 'array',
            'delete_images.*' => 'exists:destination_images,id',
            'primary_image' => 'nullable|exists:destination_images,id'
        ]);

        $destination->update($validatedData);

        // Handle image deletions
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = $destination->images()->find($imageId);
                if ($image) {
                    Storage::disk('public')->delete($image->image);
                    $image->delete();
                }
            }
        }

        // Handle new images
        if ($request->hasFile('images')) {
            $hasExistingImages = $destination->images()->exists();
            foreach ($request->file('images') as $image) {
                $path = $image->store('destinations', 'public');
                $destination->images()->create([
                    'image' => $path,
                    'is_primary' => !$hasExistingImages && $destination->images()->count() === 0
                ]);
            }
        }

        // Update primary image
        if ($request->has('primary_image')) {
            $destination->images()->update(['is_primary' => false]);
            $destination->images()->where('id', $request->primary_image)->update(['is_primary' => true]);
        }

        return redirect()->route('destinations.index')
            ->with('success', 'Destination updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destinations = Destinations::withTrashed()->where('id', $id)->firstOrFail();


        if ($destinations->trashed()) {
            $destinations->deleteImage();

            $destinations->forceDelete();   
        } else {
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
        $trashed = Destinations::onlyTrashed()->get();

        return view('destinations.index')->withdestinations($trashed);
    }

    public function restore($id)
    {
        $destinations = Destinations::withTrashed()->where('id', $id)->firstOrFail();
        $destinations->restore();

        session()->flash('success', 'Destination restored successfully.');

        return redirect()->back();

    }

    public function modal($id)
    {
        $destination = Destinations::with(['images', 'primaryImage', 'category'])
            ->findOrFail($id);
            
        return view('destinations.modal', compact('destination'));
    }
}
