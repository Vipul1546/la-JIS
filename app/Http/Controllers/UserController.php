<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Helpers\Helper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $users = User::get();
        //Helper::p_deb(compact('users'));
        return view('backend.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$catList = Helper::getTaxonomyListing('category'); 
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
            'about' => 'required',
            'userRole' => 'required'
        ]);

        $metaData = [
            'about' => $request->about,
            'userRole' => $request->userRole
        ]; 

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        foreach ($metaData as $key => $value) {
            $id = DB::table('usermeta')->insertGetId(
                [
                    'user_id' => $user->id, 
                    'meta_key' => $key,
                    'meta_value' => $value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );
        }
        //Helper::p_deb($user->id); die;
        return redirect()->route('users.index')->with('sucess', 'Post Successfully Published.');

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
        // $post = Post::findOrFail($id);
        // $catList['catData'] = Helper::getTaxonomyListing('category'); 
        // $authorList['authorData'] = Helper::getAuthorListing();
        // $data = array_merge_recursive($catList, $authorList);
        // //Helper::print_debug($authorList['authorData']);
        // return view('backend.post.edit', compact('post'))->with('data', $data);
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
        // $validatedData = $request->validate([
        //     'title' => 'required',
        //     'post_author' => 'required',
        //     'featuredImg' => 'required|url',
        //     'content' => 'required',
        //     'category' => 'required',
        //     'tag'=> 'required',
        //     'type'=> 'required'
        // ]);

        // Post::whereId($id)->update($validatedData);
        // //echo '<pre>'; print_r($validatedData);die;

        // return redirect()->route('posts.index', ['type'=>$request->type])->with('sucess', 'Post Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        // $post = Post::findOrFail($id);
        // $postType = Helper::getPostTypeFromID($id);
        // $post->delete();
        // return redirect()->route('posts.index', ['type'=> $postType])->with('sucess','Post Successfully deleted');
    }

}
