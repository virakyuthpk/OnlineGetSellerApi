<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
       	$country = Country::get();  
        return view('administrator.country.index',compact('country'));
    }

    public function create()
    {
        $data['id'] = '';
        $data['country'] = '';
        return view('administrator.country.create',$data);
    }

    public function store(Request $request,$id=null)
    {
        Country::insert($request->all(),$id);
        if($id == null){
            return back()->with('message','You have successfully create slideshow');
        }else{
            return back()->with('message','You have successfully update slideshow');
        }

    }
    public function edit($id)
    {
        $data['country'] = Country::where('id',$id)->first();
        $data['id'] = $id;
        return view('administrator.country.create',$data);
    }
    public function destroy(Request $request)
    {
        $slide = Category::where('id',$request->id)->first();
        Category::where('id',$request->id)->delete();
        return 'success';
    }

}
