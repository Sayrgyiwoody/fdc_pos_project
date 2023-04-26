<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //Direct Admin Category List
    public function list() {
        $categories = Category::when(request('searchKey'),function($query){
            $query->where('name','like','%'.request('searchKey').'%');
        })
        ->orderBy('updated_at','desc')->paginate(5);
        return view('admin.category.list',compact('categories'));
    }

    //Direct Create Category page
    public function createPage() {
        return view('admin.category.createPage');
    }

    //Create Category Name
    public function create(Request $request) {
        // dd($request->all());
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['createAlert'=>'Category Created Successfully.']);
    }

    //Delete Category from DB
    public function delete($id) {
        Category::where('id',$id)->delete();
        return back()->with(['deleteAlert'=>'Category delected successfully.']);
    }

    //Direct Edit page
    public function editPage($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.editPage',compact('category'));
    }

    //Update Category
    public function update(Request $request,$id) {
        $this->categoryValidationCheck($request,$id);
        $updateData = $this->requestCategoryData($request);
        Category::where('id',$id)->update($updateData);
        return redirect()->route('category#list')->with(['updateAlert' => 'Category updated successfully.']);
    }

    //validation for create category
    private function categoryValidationCheck($request,$id = 0) {
        Validator::make($request->all(),[
            'categoryName' => 'required|min:3|unique:categories,name,'. $id
        ])->validate();
    }

    //request category name from input
    private function requestCategoryData($request) {
        return [
            'name' => $request->categoryName,
            'updated_at' => Carbon::now()
        ];
    }
}
