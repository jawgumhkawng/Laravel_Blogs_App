<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

       public function add()
    {
        
        return view('admin.category_add');
    }

    public function create() 
    {
         $validator = validator(request()->all(), [
                'name' => 'required',
                'desc' => 'required',
                
                ]);
        if($validator->fails()) {

            return back()->withErrors($validator);

          }

        $category = new Category;
        $category->name = request()->name;
        $category->desc = request()->desc;
       
        $category->save();

        return redirect('/admin')->with('Created', 'Article Created Successfully!');
    }
}
