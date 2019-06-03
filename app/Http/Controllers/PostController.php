<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; 
use App\Http\Helpers\Helper;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fullUrl = $request->fullUrl();
        $type = !empty(explode('=', $fullUrl)[1]) ? explode('=', $fullUrl)[1] : 'post';
        $posts = Post::where('type', '=', $type)->get();
        return view('backend.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $fullUrl = $request->fullUrl();
        $type = !empty(explode('=', $fullUrl)[1]) ? explode('=', $fullUrl)[1] : 'post';
        $catList = Helper::getTaxonomyListing('category', $type); 
        if($type == 'page') return view('backend.post.page.create')->with('catList', $catList);
        return view('backend.post.create')->with('catList', $catList);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fullUrl = $request->fullUrl();
        $type = !empty(explode('=', $fullUrl)[1]) ? explode('=', $fullUrl)[1] : 'post';
        if($type == 'page'){
            echo '<pre>'; print_r($validatedData);die;
        }
        $validatedData = $request->validate([
            'title' => 'required',
            'post_author' => 'required',
            'featuredImg' => 'required|url',
            'content' => 'required',
            'category' => 'required',
            'tag'=> 'required',
            'type'=> 'required'
        ]);


        $validatedData['permalink'] = Helper::createSlug($request->title);

        $post = Post::create($validatedData);

        return redirect()->route('posts.index', ['type'=>$request->type])->with('sucess', 'Post Successfully Published.');
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
        $post = Post::findOrFail($id);
        $postType = Helper::getPostTypeFromID($id);
        $catList['catData'] = Helper::getTaxonomyListing('category', $postType); 
        $authorList['authorData'] = Helper::getAuthorListing();
        $data = array_merge_recursive($catList, $authorList);
        //Helper::print_debug($authorList['authorData']);
        return view('backend.post.edit', compact('post'))->with('data', $data);
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
        $validatedData = $request->validate([
            'title' => 'required',
            'post_author' => 'required',
            'featuredImg' => 'required|url',
            'content' => 'required',
            'category' => 'required',
            'tag'=> 'required',
            'type'=> 'required'
        ]);

        $validatedData['permalink'] = Helper::createSlug($request->permalink);
        Post::whereId($id)->update($validatedData);
        //echo '<pre>'; print_r($validatedData);die;

        return redirect()->route('posts.index', ['type'=>$request->type])->with('sucess', 'Post Successfully Updated.');
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
        $post = Post::findOrFail($id);
        $postType = Helper::getPostTypeFromID($id);
        $post->delete();
        return redirect()->route('posts.index', ['type'=> $postType])->with('sucess','Post Successfully deleted');
    }

}