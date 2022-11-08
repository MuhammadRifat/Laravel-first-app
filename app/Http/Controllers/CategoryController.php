<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryValidation;
use Carbon\Carbon;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        $categories = Category::latest()->simplepaginate(5);
        return view('admin.category.index', compact('categories'));
    }

    function insert(CategoryValidation $request)
    {
        Category::insert([
            'category_name' => $request->category_name,
            'added_by' => Auth::id(),
            'created_at' => Carbon::now()
        ]);
        return back()->with('status', 'Successfully Added');
    }

    // delete category by id
    function delete($category_id)
    {
        Category::find($category_id)->delete();

        return back()->with('status', 'Successfully Deleted');
    }

    // edit category
    function edit(CategoryValidation $request)
    {
        // echo $request->category_id;
        Category::where('id', $request->category_id)->update([
            'category_name'=> $request->category_name,
            'updated_at'=> Carbon::now(),
        ]);
        return back()->with('editStatus', 'Successfully Updated');
    }
}
