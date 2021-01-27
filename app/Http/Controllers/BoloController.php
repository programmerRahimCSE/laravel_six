<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BoloController extends Controller
{

    public function Addcategory()
    {
        return view('post.add_category');
    }
    public function StoreCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:25|min:4',
            'slug' => 'required|unique:categories|max:25|min:4',
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['slug'] = $request->slug;
        $category = DB::table('categories')->insert($data);
        if ($category) {
            $notification = array(
                'message' => 'Successfully Category Inserted',
                'alert-type' => 'success',
            );
            return Redirect()->route('all.category')->with($notification);

        } else {
            $notification = array(
                'message' => 'Something want wrong',
                'alert-type' => 'error',
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function AllCategory()
    {
        $category = DB::table('categories')->get();

        return view('post.all_category', compact('category'));
    }
    public function ViewCategory($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        /*  return view('post.categoryview')->with('category', $category); */
        return view('post.categoryview', compact('category'));
    }
    public function DeleteCategory($id)
    {
        $delete = DB::table('categories')->where('id', $id)->delete();
        $notification = array(
            'message' => 'Successfully Category Deleted',
            'alert-type' => 'success',
        );
        return Redirect()->back()->with($notification);
    }
    public function EditCategory($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        return view('post.editcategory', compact('category'));
    }
    public function UpdateCategory(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:25|min:4',
            'slug' => 'required|max:25|min:4',
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['slug'] = $request->slug;
        $category = DB::table('categories')->where('id', $id)->update($data);
        if ($category) {
            $notification = array(
                'message' => 'Successfully Category Updated',
                'alert-type' => 'success',
            );
            return Redirect()->route('all.category')->with($notification);

        } else {
            $notification = array(
                'message' => 'Nothing to Updated',
                'alert-type' => 'error',
            );
            return Redirect()->route('all.category')->with($notification);
        }
    }

}
