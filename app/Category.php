<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 16.05.18
 * Time: 9:23
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title', 'parent_id', 'url',
    ];

    public static function saveCategoryFromParse()
    {
        $link = env('KASSIR_CATEGORY_URL');
        $feed = Event::parseFromKassir($link);

        $categories = $feed['category'];

        foreach ($categories as $category){
            $oldCat = Category::find($category['id']);
            //$existCatname = Category::where('title', '=', $category['name'])->first();
            if($oldCat /*|| $existCatname*/){
                $oldCat->title = $category['name'];
                $oldCat->update();
            }else{
                $title = $category['name'];
                $newCat = new Category;
                $newCat->id = $category['id'];
                $newCat->title = $title;
                if(!is_array($category['parent_id'])){
                    $newCat->parent_id = $category['parent_id'];
                }
                $newCat->url = $category['url'];
                $newCat->save();
            }

        }
    }
}
