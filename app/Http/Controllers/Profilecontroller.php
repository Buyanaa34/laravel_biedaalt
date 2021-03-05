<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\postmodel;
use App\messages;
use Illuminate\Support\Facades\Storage;

class Profilecontroller extends Controller
{


    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $id=auth()->user()->id;
        $hereglegch = User::find($id);
        return view('pages.profile')->with('hereglegch',$hereglegch);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required'
        ]);
        if($request->hasFile('profile_pic')){
            //Get filename with extension
            $filenameWithExt=$request->file('profile_pic')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Get just extension
            $extension=$request->file('profile_pic')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension; 
            //upload image
            $path=$request->file('profile_pic')->storeAs('/public/cover_images',$fileNameToStore);
        }

        //hande file upload 
        $user = User::find($id);
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        if(auth()->user()->id=='30'){
            if($user->isadmined=='1'){
                $user->isadmined=0;
            }
            else{
                $user->isadmined=1;
            } 
        }
        if($request->hasFile('profile_pic')){
            $user->profile_Pic = $fileNameToStore;
        }
        $user->save();
        return redirect('/posts')->with('success','Your profile just updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        //check 4 correct user
        if(auth()->user()->id != '30'){
            if(auth()->user()->id !=$user->id){
                return redirect('/posts')->with('error','Unauthorized Page');
            }
        }
        
        if($user->profile_pic!='userpic.jpg'){
            //delete image
            Storage::delete('public/cover_images/'.$user->cover_image);
        }
        $posts = postmodel::All();
        foreach($posts as $post){
            if($post->user_id==$id){
                $post->delete();
            }
        }
        $user->delete();
        return redirect('/login')->with('success','Your account just removed');
    }

    public function get_take_permission($id){
        $user = User::find($id);
        if($user->isadmined=='1'){
            $user->isadmined=0;
        }
        else{
            $user->isadmined=1;
        } 
        $user->save();
        return redirect('/dashboard');
    }

    public function banuser($id){
        $user = User::find($id);
        if($user->isbanned == '1'){
            $user->isbanned =0;
        }
        else{
            $user->isbanned =1;
            
        }
        $user->save();
        return redirect('/dashboard');
    }

    public function retrievemessage(Request $request,$id){
        $this->validate($request,[
            'message'=>'required'
        ]);
        $messages = new messages();
        $messages->title = $request->input('message');;
        $messages->user_id = $id;
        $messages->save();
        return redirect('/profile')->with('success','your message sent to admin');
    }

    public function showmessage(){
        $messages = messages::orderBy('created_at','desc')->paginate(5);
        return view('pages.messages')->with('messages',$messages);
    }
}
