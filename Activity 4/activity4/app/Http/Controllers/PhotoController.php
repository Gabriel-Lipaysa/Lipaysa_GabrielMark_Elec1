<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $photos = Photo::latest()->paginate(5);
        return view('images',compact('photos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeSingle(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $image = $request->file('image');
        $imageName = time().'_'.$image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        Photo::create(['image'=>$imageName]);

        return back()->with('success', 'Single image uploaded successfully');
    }

    public function storeMultiple(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,max:2048'
        ]);

        foreach($request->file('images') as $image){
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images'),$imageName);
            Photo::create(['image'=>$imageName]);
        }
        return back()->with('success', 'Multiple images uploaded successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        $imagePath = public_path('images/'.$photo->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $photo->delete();
        return back()->with('success', 'Image deleted successfully');
    }
}
