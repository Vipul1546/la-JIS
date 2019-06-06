<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; 
use App\Http\Helpers\Helper;
use Illuminate\Support\Facades\DB;

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
        if($type == 'page') return view('backend.post.page.index', compact('posts'));
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
        $type = app('request')->input('type');
        if($type == 'page'){
            $validatedData = $request->validate([
                'title' => 'required',
                'post_author' => 'required',
                'featuredImg' => 'required|url',
                'tag'=> 'required',
                'type'=> 'required'
            ]);
            $validatedData['permalink'] = Helper::createSlug($request->title);
            $validatedData['content'] ='widget';
            $validatedData['category'] ='page';

            $post = Post::create($validatedData);

            $widgetData = $request->widgetData;
            $widgetdataKeys = ['widgetName','widgetNumber','parentID'];

            foreach ($widgetData as $key => $widget) {
                $widgetBundle = [
                        'widget_id' => $key, 
                        'widget_name' => $widget['widgetName'],
                        'post_id' => $post->id,
                        'parent_widget' => !empty($widget['parentID']) ?  $widget['parentID'] : ''  ,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    // echo '<pre>'; print_r($bundle);die;
                $widgetDataID = DB::table('widget_data')->insertGetId($widgetBundle);

                foreach ($widget as $widgetKey => $widgetValue) {
                        if(!in_array($widgetKey, $widgetdataKeys)){
                            
                            $meta_key = (!empty($widgetKey) && isset($widgetKey)) ? $widgetKey : ' ';
                            $mata_value = (!empty($widgetValue) && isset($widgetValue)) ? $widgetValue : ' ';

                            $widgetMetaData = DB::table('widget_meta')->insertGetId([
                                'widget_id' => $widgetDataID, 
                                'meta_key' => $meta_key,
                                'meta_value' => $mata_value,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);
                        }
                    }
            }
            return redirect()->route('posts.index', ['type'=>$request->type])->with('sucess', 'Post Successfully Published.');
        } else {
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
        }
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
        if($postType == 'page') {
            $wData = [];
            $startEle=[];

            $finalData=[];
            $widgetData = DB::table('widget_data')->where('post_id',$id)->get()->toArray();

           foreach ($widgetData as $key => $value) { 
                if(empty($value->parent_widget)) {
                    $startEle[] = $value->widget_id;
                }
           }


           foreach ($startEle as $fkey => $fvalue) {    
                $a = [];
                $b = [];
                foreach ($widgetData as $wkey => $wvalue) {   //if($fvalue == 'vt-row4') Helper::p_deb($fvalue);
                   if($wvalue->parent_widget === $fvalue){ 
                        $a[$wvalue->widget_id] = $wvalue;
                        $finalData[$fvalue] = $a;
                   }
                   if($wvalue->widget_id == $fvalue){
                        $finalData[$fvalue]['_selfData'] = $wvalue;
                   }
                }
           }
           $data['widgetData'] = $finalData;
            return view('backend.post.page.edit', compact('post'))->with('data', $data);
        } else {
            return view('backend.post.edit', compact('post'))->with('data', $data);
        }
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