<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function add()
    {

        return view('admin.category_add');
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|min:5',
            'desc' => 'required|regex:/^[\pL\s\-]+$/u|min:5',

        ]);
        if ($validator->fails()) {

            return back()->withErrors($validator);
        }

        $category = new Category;
        $category->name = request()->name;
        $category->desc = request()->desc;

        $category->save();

        return redirect('/admin')->with('Created', 'Article Created Successfully!');
    }
}
