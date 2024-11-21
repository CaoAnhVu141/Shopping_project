<?php

namespace App\Http\Controllers;

use App\Models\CategoryPost;
use Illuminate\Http\Request;

class CategoryPostViewController extends Controller
{
    //hàm in ra dữ liệu
    public function showViewCategoryPost(Request $request)
    {
        $key_word = '';
        if($request->input('keyword'))
        {
            $key_word = $request->input('keyword');
        }
        $category_post = CategoryPost::where('name','LIKE',"%$key_word%")
                                    ->orWhere('describe', 'LIKE', "%$key_word%")
                                    ->paginate(5);

        return view('Front-end-Admin.categorypost.index', compact('category_post'));
    }

    public function showViewAddCategoryPost()
    {
        return view('Front-end-Admin.categorypost.add');
    }


    public function addDataCategoryPost(Request $request)
    {
        $request->validate([
            'namecategory' => 'required|string|max:20|unique:category_posts,name',
            'descriptioncategory' => 'required|string|max:50',
        ]);
        CategoryPost::create([
            'name' => $request->input('namecategory'),
            'describe' => $request->input('descriptioncategory'),
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
        else{
            return redirect()->route('indexcategorypost')->with('status',"Không có dữ liệu để xóa");
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
            return redirect()->route('indexcategorypost')->withErrors(['status' => 'Thuộc tính không tồn tại']);
        }
        $request->validate([
            'namecategory' => 'required|string|max:20|unique:category_posts,name',
            'descriptioncategory' => 'required|string|max:50',
        ]);
        // Cập nhật thuộc tính
        $categorypost->update([
            'name' => $request->input('namecategory'),
            'describe' => $request->input('descriptioncategory'),
        ]);
        return redirect()->route('indexcategorypost')->with('status', 'Bạn cập nhật thành công');
    }
}