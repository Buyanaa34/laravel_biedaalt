<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\postmodel;
use App\User;
use Illuminate\Support\Facades\Storage;
class maincontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }


    public function index()
    {
        
        $posts = postmodel::orderBy('created_at','desc')->paginate(3);
        return view('postsfolder.comments')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('postsfolder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);
        if($request->hasFile('cover_image')){
            //Get filename with extension
            $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Get just extension
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension; 
            //upload image
            $path=$request->file('cover_image')->storeAs('/public/cover_images',$fileNameToStore);
        }
        else{
            $fileNameToStore= 'default_car.jpg';
        } 
        $post =new postmodel;
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->user_id=auth()->user()->id;
        $post->cover_image=$fileNameToStore;
        $post->save();
        return redirect('/posts')->with('success','Your comment added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = postmodel::find($id);
        return view('postsfolder.comments_detail')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = postmodel::find($id);
        //check for correct user
        if(auth()->user()->id!==$post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }
        return view('postsfolder.edit')->with('post',$post);
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
            'title'=>'required',
            'body'=>'required'
        ]);

        //hande file upload
        if($request->hasFile('cover_image')){
            //Get filename with extension
            $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Get just extension
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension; 
            //upload image
            $path=$request->file('cover_image')->storeAs('/public/cover_images',$fileNameToStore);
        }   
        $post = postmodel::find($id);
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        return redirect('/posts')->with('success','Your comment just edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=postmodel::find($id);
        //check 4 correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }
        
        if($post->cover_image!='userpic.jpg'){
            //delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success','Post removed');
    }

    public function submitreport(Request $request,$id){ //report submit hiih heseg
        $post = postmodel::find($id);
        $multiplereported = $post->isreported * auth()->user()->isusedreport;
        $user = User::find(auth()->user()->id);
        if($multiplereported==0){
            $temp = $post->report_number;
            $temp = $temp + 1;
            $post->report_number = $temp;
            $post->isreported = 1;
            $user->isusedreport = 1;
            $user->save();
            $post->save();
        return redirect('/posts')->with('success','Post reported');
        }
        else{
            return redirect('/posts')->with('error','You have already reported that post !');
        }
        
    } 
}
