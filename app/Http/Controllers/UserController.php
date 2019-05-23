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

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $metaData = [
            'about' => $request->about,
            'userRole' => $request->userRole,
            'accessToken' => $user->createToken('AppName')->accessToken
        ]; 

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
        $user = User::select('id', 'name', 'email')->where('id',$id)->get();
        $meta = DB::table('usermeta')->where('user_id',$id)->get();
        $userMeta =[];
        foreach ($meta as $key => $value) {
            $userMeta[$value->meta_key] = $value->meta_value;
        }
        $userMetaData = [];
        $userMetaData['about'] = (!isset($userMeta['about']) && empty($userMeta['about'])) ? 'No Data' : $userMeta['about'];
        $userMetaData['userRole'] = (!isset($userMeta['userRole']) && empty($userMeta['userRole'])) ? 'No Data' : $userMeta['userRole'];
        $userMetaData['accessToken'] = (!isset($userMeta['accessToken']) && empty($userMeta['accessToken'])) ? 'No Data' : $userMeta['accessToken']; 

        //Helper::p_deb($userMetaData); die;
        // $post = Post::findOrFail($id);
        // $catList['catData'] = Helper::getTaxonomyListing('category'); 
        // $authorList['authorData'] = Helper::getAuthorListing();
        // $data = array_merge_recursive($catList, $authorList);
        // //Helper::print_debug($authorList['authorData']);
        return view('backend.user.edit', compact('user'))->with('userMeta', $userMetaData);
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

    public function generateAccessToken($userId){
        $user = User::find($userId);
        $token = $user->createToken('Story')->accessToken;

        //Helper::p_deb($token);
        //echo "asdf"; die;
        $id = DB::table('usermeta')->insertGetId(
                [
                    'user_id' => $userId, 
                    'meta_key' => 'accessToken',
                    'meta_value' => $token,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );
        return redirect('/admin/users/'.$userId.'/edit');
    }
    
}
