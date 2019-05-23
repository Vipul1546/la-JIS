<?php

namespace App\Http\Helpers;
use App\Post;
use App\Taxonomy;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * @param $title
 * @param int $id
 * @return string
 * @throws \Exception 
 */

class Helper
{
    public static function p_deb($data = []){
        echo "<pre>"; print_r($data);die;
    }

    public static function createSlug($title, $id = 0) {
    // Normalize the title
    $slug = str_slug($title);

    // Get any that could possibly be related.
    // This cuts the queries down by doing it once.
    $allSlugs = Helper::getRelatedSlugs($slug, $id);

    // If we haven't used it before then we are all good.
    if (! Str::contains($allSlugs, $slug)){
        return $slug;
    }

    // Just append numbers like a savage until we find not used.
    for ($i = 1; $i <= 10; $i++) {
        $newSlug = $slug.'-'.$i;
        if (! Str::contains($allSlugs, $newSlug)) {
            return $newSlug;
        }
    }

    throw new \Exception('Can not create a unique slug');
    }

    protected static function getRelatedSlugs($slug, $id = 0)
    {
        return Post::select('permalink')->where('permalink', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }

    public static function getPostTaxoTypeFromID($id = 0){
        return Taxonomy::select('taxonomy','post_type')->where('id', $id)->get()->toArray()[0];
    }

    public static function getPostTypeFromID($id = 0){ 
       return Post::select('type')->where('id', $id)->get()->toArray()[0]['type'];
    }

    public static function getTaxonomyNameFromSlug($taxonomySlug = 'undefined'){
        $taxonomyData = Taxonomy::select('title')->where('slug',$taxonomySlug)->get()->toArray()[0]['title'];
        return $taxonomyData;    
    }

    public static function getTaxonomyListing($taxonomy = 'category'){
        $count = Taxonomy::where('taxonomy', $taxonomy)->count(); //get tax count
        if($count == 0) return 'No data found';
        $taxonomyData['list'] = Taxonomy::select('title','slug')->where('taxonomy',$taxonomy)->distinct()->get()->toArray();
        $taxonomyData['count'] = $count;
        return $taxonomyData;    
    }

    public static function getAuthorListing(){
        $userList['list'] = USER::all()->toArray();
        return $userList;
    }

    public static function getAuthorById($id = 1, $field = ''){
        

        if($field == '' && empty($field)){
            $user = USER::all();
        } else {
            $user = USER::select($field)->where('id',$id)->get()->toArray()[0]['name'];
        }
        return $user;
    }

    public static function getUserRoles($id){
        $roles = [
            22 => 'SuperAdmin',
            1 => 'Administrator',
            2 => 'Author',
            3 => 'Subscriber',
            4 => 'Editor',
        ];

        return $roles[$id];
    }

    public static function getUserMeta($userId, $metaKey=''){
        if($metaKey == '' && empty($metaKey)){
            $users = DB::table('usermeta')->where('user_id', $userId)->get();
            return $users;            
        } else {
            $users = DB::table('usermeta')->where([
                        ['user_id', $userId],
                        ['meta_key', $metaKey],
                    ])->first();
            if(empty($users->meta_value)) return $users = Helper::getUserRoles('3');
            return Helper::getUserRoles($users->meta_value);
        }
    }

    public static function abcd(){
        //$users = User::get();
        //Helper::p_deb(compact('users'));
       // return view('backend.user.index', compact('users'));

        return 'hello';
    }
}