<?php

namespace App\Http\Controllers\Administrator;
use App\Models\Career;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CareerController extends Controller
{
    public function index(){
        $data['career'] = Career::get();
        return view('administrator.career.index',$data);
    }
    public function create(){
        $data['id'] = '';
        $data['career'] = '';
        return view('administrator.career.create',$data);
    }
    public function store(Request $request,$id=null){

        if($id == null){
            $ca = new Career();
            $ca->title = $request->title;
            $ca->des = $request->des;
            $ca->closing_date = $request->closing_date;
            $ca->public_date = $request->public_date;
            $ca->term = $request->term; 
            $ca->status = $request->status;
            $ca->save();
            $appId = '1770606093236981';
            $appSecret = 'b38293bdb2c6ee8430dbb1b00fe12a6f';
            $pageId = '1008241812541036';
            $userAccessToken = 'EAAZAKW1s5evUBANYroFZBpMwM8eIxFn7jlZC2C4mOxknGu1TN3VnU6qGPtqAli6yWdnj0Y3ShUlfxX2me2FNRVipiEtI4vbo0tooaXqs04CSNYX9HXPgRkhEgJKp00LOIZBKiC1PPhMIUTDAeEYVfzNmlNYPuHQwSJEK9GRZCItolUyFdGQTu';
            $fb = new Facebook\Facebook([
                'app_id' => $appId,
                'app_secret' => $appSecret,
                'default_graph_version' => 'v2.5'
            ]);
            $longLivedToken = $fb->getOAuth2Client()->getLongLivedAccessToken($userAccessToken);

            $fb->setDefaultAccessToken($longLivedToken);

            $response = $fb->sendRequest('GET', $pageId, ['fields' => 'access_token'])
                ->getDecodedBody();
            $foreverPageAccessToken = $response['access_token'];
            
            $fb->setDefaultAccessToken($foreverPageAccessToken);
            $fb->sendRequest('POST', "$pageId/feed", [
                'message' => $request->shortdes.':'.$ca->title,
                'link' => 'http://sustinatgreen.thurawadh.com/career',
            ]);
            //var_dump($fb->sendRequest('GET', '/debug_token', ['input_token' => $foreverPageAccessToken])->getDecodedBody());
            return back()->with('message','You have successfully create career');
        }else{
            $ca = Career::find($id);
            $ca->title = $request->title;
            $ca->des = $request->des;
            $ca->closing_date = $request->closing_date;
            $ca->public_date = $request->public_date;
            $ca->term = $request->term;
            $ca->status = $request->status; 
            $ca->save();
            return back()->with('message','You have successfully update career');
        }
    }
    public function edit($id){
        $data['career'] = Career::where('id',$id)->first();
        $data['id'] = $id;
        return view('administrator.career.create',$data);
    }
    public function destroy(Request $request)
    {
        Career::where('id',$request->id)->delete();
        return 'success';
    }
    public function active(Request $request){
        $id = $request->id;
        $where = Career::where('id',$id)->first()->status;
        if ($where == 0) {
            Career::where('id',$id)->update(array('status' => 1));
        }else{
            Career::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
    public function test (){
        $appId = '1770606093236981';
        $appSecret = 'b38293bdb2c6ee8430dbb1b00fe12a6f';
        $pageId = '1847661462218279';
        $userAccessToken = 'EAAZAKW1s5evUBABwHR0MNnbQpgoVslHhipBv9l2FUETfoT3QYZA2uze2JdGGDY1LcSeKyvAfA57ZBPoNHdrBKFITEPgF6tcZBwDtTfEassZAifKtPqWqta2aFaJXJaImZCeZAbYNMb9TeBdwG2PpDTHXaJhh9T8qWZAnnjZCcLLWfI3FP53Ls8wQAAJLVnXyr8gtUT2dHaJeZA5gZDZD';
        $fb = new Facebook\Facebook([
            'app_id' => $appId,
            'app_secret' => $appSecret,
            'default_graph_version' => 'v2.5'
        ]);
        $longLivedToken = $fb->getOAuth2Client()->getLongLivedAccessToken($userAccessToken);

        $fb->setDefaultAccessToken($longLivedToken);

        $response = $fb->sendRequest('GET', $pageId, ['fields' => 'access_token'])
            ->getDecodedBody();
        $foreverPageAccessToken = $response['access_token'];
        
        $fb->setDefaultAccessToken($foreverPageAccessToken);
        $fb->sendRequest('POST', "$pageId/feed", [
            'message' => 'I Like French Fries.',
            'link' => 'sustinatgreen.thurawadh.com',
        ]);
        var_dump($fb->sendRequest('GET', '/debug_token', ['input_token' => $foreverPageAccessToken])->getDecodedBody());
    }
}