<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use App\Taxonomy;

class TaxonomyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fullUrl = $request->fullUrl();
        $type = !empty(explode('=', $fullUrl)[1]) ? explode('=', $fullUrl)[1] : 'category';
        $taxonomies = Taxonomy::all();
        return view('backend.taxonomy.index', compact('taxonomies'));
    }

    public function indexx($post_type, $type){

        $taxonomies = Taxonomy::where([
                                        ['post_type', $post_type],
                                        ['taxonomy', $type],
                                    ])->get();
        return view('backend.taxonomy.index', compact('taxonomies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.taxonomy.create');
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
            'title' => 'required',
            'description' => 'required',
            'taxonomy' => 'required',
            'post_type' => 'required'
        ]);

       // print_r($request->taxonomy);die;

        $validatedData['slug'] = Helper::createSlug($request->title);
        $validatedData['meta'] = '';

        $Taxonomy = Taxonomy::create($validatedData);

        return redirect()->route('indexx',['post_type'=> $request->post_type,'type'=> $request->taxonomy]);
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
        $taxonomy = Taxonomy::findOrFail($id);

        return view('backend.taxonomy.edit', compact('taxonomy'));
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
            'description' => 'required',
            'taxonomy' => 'required',
            'slug' => 'required'
        ]);

        Taxonomy::whereId($id)->update($validatedData);
        //echo '<pre>'; print_r($validatedData);die;

        return redirect()->route('taxonomies.index', ['type'=>$request->taxonomy])->with('sucess', 'Post Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $taxonomy = Taxonomy::findOrFail($id);
        $postTaxoType = Helper::getPostTaxoTypeFromID($id);
        $taxonomy->delete();
        return redirect()->route('indexx',['post_type'=> $postTaxoType['post_type'],'type'=> $postTaxoType['taxonomy']]);

    }
}
