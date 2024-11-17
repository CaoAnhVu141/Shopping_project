<?php

namespace App\Http\Controllers;

use App\Models\CategoryPost;
use Illuminate\Http\Request;

class CategoryPostViewController extends Controller
{
    //hàm in ra dữ liệu
    public function showViewCategoryPost()
    {
        $category_post = CategoryPost::paginate(5);
        return view('Front-end-Admin.categorypost.index', compact('category_post'));
    }

    public function showViewAddCategoryPost()
    {
        return view('Front-end-Admin.categorypost.add');
    }


    public function addDataCategoryPost(Request $request)
    {
        $request->validate([
            'namecategory' => 'required|string',
            'descriptioncategory' => 'required|string',
        ]);
        CategoryPost::create([
            'name' => $request->input('namecategory'),
            'discription' => $request->input('descriptioncategory'),
        ]);
        return redirect()->route('indexcategorypost')->with('status', 'Thêm thành công rồi nè');
    }


    //Xoá
    public function deleteDataCategoryPost($id)
    {
        $id_category_post = CategoryPost::find($id);
        if ($id_category_post) {
            $id_category_post->delete();
            return redirect()->route('indexcategorypost')->with('status', "Bạn đã xoá thành công");
        }
    }

    public function showUpdateDataCategoryPost($id)
    {
        $category_post = CategoryPost::find($id);
        return view('Front-end-Admin.categorypost.update', compact('category_post'));
    }

    public function UpdateDataCategoryPost(Request $request, $id)
    {
        $categorypost = CategoryPost::find($id);
        if (!$categorypost) {
            return redirect()->route('indexattribute')->withErrors(['status' => 'Thuộc tính không tồn tại']);
        }

        // Cập nhật thuộc tính
        $categorypost->update([
            'name' => $request->input('namecategory'),
            'discription' => $request->input('descriptioncategory'),
        ]);

        return redirect()->route('indexcategorypost')->with('status', 'Bạn cập nhật thành công');
    }
}
