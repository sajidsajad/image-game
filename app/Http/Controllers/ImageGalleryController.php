<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageGallery;
use App\Category;
use DB;
use Response;

class ImageGalleryController extends Controller
{
    public function index(){
        $images = ImageGallery::get();
        return view('admin',compact('images'));
    }

    public function getImages(){
        $data = DB::table('image_gallery')->orderBy('category_id')->limit(2)->get();
        return $data;
    }

    public function nextCat(Request $request){        
        if(count($request->catList) >= ImageGallery::count()/2){
            // return $request->all();
            $data = DB::table('image_gallery')->orderBy('category_id')->limit(2)->get();
            $count = ImageGallery::count()/2;
        }else{
            $data = ImageGallery::whereNotIn('category_id', $request->catList)->orderBy('category_id')->limit(2)->get();
            $count = ImageGallery::count()/2;
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

        $image = new ImageGallery();
        $image->image = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $image->image);
        $image->title = $request->title;
        $image->category_id = $request->category;
        $image->save();

        $image1 = new ImageGallery();
        $image1->image = time().'1.'.$request->image1->getClientOriginalExtension();
        $request->image1->move(public_path('images'), $image1->image);
        $image1->title = $request->title1;
        $image1->category_id = $request->category;
        $image1->save();
        
        return back()->with('success','Images Uploaded successfully.');
    }

    public function destroy($id)
    {
    	ImageGallery::find($id)->delete();
    	return back()->with('success','Image removed successfully.');	
    }

    public function addCategory(Request $request){
        $this->validate($request,[
            'category' => 'required',
        ]);
        $input['category'] = $request->category;
        Category::create($input);
        return back()->with('success','Category added successfully.');
    }

    public function getCategories(){
        $cat = Category::get();
        return $cat;
    }
}
