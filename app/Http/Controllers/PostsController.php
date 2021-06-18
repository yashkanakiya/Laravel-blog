<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; //adding for using functions post model
use Illuminate\Support\Facades\Storage; //manage with fileupload
//use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class PostsController extends Controller
{
    // this block copy from homecontroller.php for accessing control by user
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>'index','show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        //return Post::all();
        //$posts = Post::all();
        //$posts = Post::orderBy('title','desc')->get();
        //$posts = DB::select('select * from posts');
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
        //file handling
        if($request->hasFile('cover_image')){
            //get file name with extension
            $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
            //get  just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //get just extension
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            //file to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //upload image
            $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
         } else
            {
                $fileNameToStore='noimage.jpg';
            }

        //create post
        $post =new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        
        return redirect('/posts')->with('success','post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return Post::find($id);
        $post =Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post =Post::find($id);
        // dd($post);
        // check user access
        if(Auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error','unauthorized for this page');
        }
        return view('posts.edit', compact('post'));
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

            if($request->hasFile('cover_image')){
                //get file name with extension
                $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
                //get  just filename
                $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
                //get just extension
                $extension=$request->file('cover_image')->getClientOriginalExtension();
                //file to store
                $fileNameToStore=$filename.'_'.time().'.'.$extension;
                //upload image
                $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
             } 

            //create post
            $post =Post::find($id);
            // dd($post);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
       
        if($request->hasFile('cover_image')){
        $post->cover_image = $fileNameToStore;
        }
        $post->save();
        
        return redirect('/posts')->with('success','post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
          // check user access
          if(Auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error','unauthorized for this page');
        }

        if($post->cover_image != 'noimage.jpg'){
            //delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success', 'posts deleted successfully');
    }
}
