<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageGallery;
use DB;

class ImageGalleryController extends Controller
{
    public function index(){
        $images = ImageGallery::get();
        return view('admin',compact('images'));
    }

    public function getImages(){
        $data = DB::table('image_gallery')->where("category","=","players")->limit(2)->get();
        return $data;
    }

    public function nextCat(Request $request){
        $data = ImageGallery::where("category","!=",$request->cat)->orderBy('category')->limit(2)->get();
        return $data;
    }

    public function upload(Request $request){
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category'=> 'required',
        ]);
            $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $input['image']);
            $input['title'] = $request->title;
            $input['category'] = $request->category;
            ImageGallery::create($input);
    	    return back()->with('success','Image Uploaded successfully.');
    }

    public function destroy($id)
    {
    	ImageGallery::find($id)->delete();
    	return back()->with('success','Image removed successfully.');	
    }
}
