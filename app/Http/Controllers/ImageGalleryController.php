<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageGallery;
use DB;
use Response;

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
        // return $count = ImageGallery::count()/2;
        // return $request->all();
        if(count($request->catList) == ImageGallery::count()/2 - 1){
            $data = DB::table('image_gallery')->where("category","=","players")->limit(2)->get();
            $count = ImageGallery::count()/2 - 1;
        }else{
            $data = ImageGallery::whereNotIn('category', $request->catList)->orderBy('category')->limit(2)->get();
            $count = ImageGallery::count()/2 - 1 ;
        }
        return Response::json(array('data' => $data, 'count' => $count));
    }

    public function upload(Request $request){
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title1' => 'required',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category'=> 'required',
        ]);
            $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $input['image']);
            $input['title'] = $request->title;
            $input['category'] = $request->category;
            ImageGallery::create($input);

            $input['image'] = time().'.'.$request->image1->getClientOriginalExtension();
            $request->image1->move(public_path('images'), $input['image']);
            $input['title'] = $request->title1;
            $input['category'] = $request->category;
            ImageGallery::create($input);
    	    return back()->with('success','Images Uploaded successfully.');
    }

    public function destroy($id)
    {
    	ImageGallery::find($id)->delete();
    	return back()->with('success','Image removed successfully.');	
    }
}
