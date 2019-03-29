<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Discount;
class CampaignController extends Controller
{
  	public function index(){
        $data['campaign'] = Campaign::orderBy('created_at','desc')->get();
        foreach ($data['campaign'] as  $cam) {
        	$cam->category = Category::where('id',$cam->category_id)->first();
        	$cam->disount = Discount::where('id',$cam->discount_id)->first();
        }
        return view('administrator.campaign.index',$data);
    }
    public function create()
    {
        $data['id'] = "";
        $data['campaign'] = "";
        $data['category'] = Category::where('status',1)->where('parent_id',0)->get();
        $data['discount'] = Discount::where('status',1)->get();
        return view('administrator.campaign.create',$data);
    }
    public function store(Request $request,$id=null)
    {
        Campaign::insert($request->all(),$id);
        if($id == null){
            return back()->with('message','You have successfully create campaign');
        }else{
            return back()->with('message','You have successfully update campaign');
        }

    }
    public function edit($id)
    {
        $data['id'] = $id;
        $data['campaign'] = Campaign::where('id',$id)->first();
        $data['category'] = Category::where('status',1)->where('parent_id',0)->get();
        $data['discount'] = Discount::where('status',1)->get();
        return view('administrator.campaign.create',$data);
    }
    public function destroy(Request $request)
    {
        Campaign::where('id',$request->id)->delete();
        return 'success';
    }
    public function active(Request $request){
        $id = $request->id;
        $where = Campaign::where('id',$id)->first()->status;
        if ($where == 0) {
            Campaign::where('id',$id)->update(array('status' => 1));
        }else{
            Campaign::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
}
