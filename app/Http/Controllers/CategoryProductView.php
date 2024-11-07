<?php
namespace App\Http\Controllers;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class CategoryProductView extends Controller
{
 
    public function add_category_product(){
        return view("Front-end-Admin.menu.add_category_product");
     }
    
//  public function all_category_product(){
//     $all_category_product = DB::table('tbl_category_product')->paginate(2);
//     $manager_category_product  = view('Front-end-Admin.menu.all_category_product')->with('all_category_product',$all_category_product);
//     return view('Front-end-Admin.index')->with('Front-end-Admin.menu.all_category_product', $manager_category_product);
//    //  return view("Front-end-Admin.all_category_product");
//  }
 
public function all_category_product() {
    $all_category_product = DB::table('tbl_category_product')->paginate(2);

    // Mã hóa category_id và tạo khóa ngẫu nhiên
    foreach ($all_category_product as $category) {
        $category->category_id = base64_encode($category->category_id); // Mã hóa category_id
        $category->random_key = Str::random(16); // Tạo khóa ngẫu nhiên dài 16 ký tự
    }

    $manager_category_product = view('Front-end-Admin.menu.all_category_product')->with('all_category_product', $all_category_product);
    return view('Front-end-Admin.index')->with('Front-end-Admin.menu.all_category_product', $manager_category_product);
}
 public function save_category_product(Request $request)
 {
     // Custom validation messages
     $messages = [
         'category_product_name.required' => 'Không được để trống tên danh mục',
         'category_product_name.max' => 'Tên danh mục không được dài quá 50 ký tự',
         'category_product_name.regex' => 'Tên chỉ chứa chữ, không có khoảng trắng trước và sau, không có hai khoảng trắng liền nhau',
         'category_product_desc.required' => 'Không được để trống mô tả danh mục',
         'category_product_desc.max' => 'Mô tả danh mục không được dài quá 1000 ký tự',
         'category_product_desc.regex' => 'Mô tả chỉ chứa chữ và số, không có khoảng trắng trước và sau, không có hai khoảng trắng liền nhau',
     ];
 
     // Validation rules
     $rules = [
         'category_product_name' => [
             'required',
             'max:50',
             'regex:/^\S(.*\S)?$/u', // Không có khoảng trắng trước và sau
             'regex:/^(?!.*\s{2}).*$/u', // Không có hai khoảng trắng liên tiếp
         ],
         'category_product_desc' => [
             'required',
             'max:1000',
             'regex:/^[\pL\s\d]+$/u', // Chỉ cho phép chữ cái, số và khoảng trắng
             'regex:/^\S(.*\S)?$/u', // Không có khoảng trắng trước và sau
             'regex:/^(?!.*\s{2}).*$/u', // Không có hai khoảng trắng liên tiếp
         ],
     ];
 
     // Validate the request with custom messages
     $request->validate($rules, $messages);
 
     // Insert the valid data into the database
 
     $data = [
         'category_name' => $request->category_product_name,
         'category_desc' => $request->category_product_desc,
         'category_status' => $request->category_product_status,
     ];
 
     DB::table('tbl_category_product')->insert($data);
 
     // Set success message and redirect
     Session::put('message', 'Thêm danh mục sản phẩm thành công');
     return Redirect::to('add-category-product');
 }
 

public function unactive_category_product($category_product_id) {
    // Giải mã category_product_id
    $decoded_category_product_id = base64_decode($category_product_id);

    DB::table('tbl_category_product')->where('category_id', $decoded_category_product_id)->update(['category_status' => 1]);
    Session::put('message', 'Không kích hoạt danh mục sản phẩm thành công');
    return Redirect::to('all-category-product');
}

public function active_category_product($category_product_id) {
    // Giải mã category_product_id
    $decoded_category_product_id = base64_decode($category_product_id);

    DB::table('tbl_category_product')->where('category_id', $decoded_category_product_id)->update(['category_status' => 0]);
    Session::put('message', 'Kích hoạt danh mục sản phẩm thành công');
    return Redirect::to('all-category-product');
}

public function edit_category_product($category_product_id) {
    // Giải mã category_product_id
    $decoded_category_product_id = base64_decode($category_product_id);

    $edit_category_product = DB::table('tbl_category_product')->where('category_id', $decoded_category_product_id)->get();
    $manager_category_product = view('Front-end-Admin.menu.edit_category_product')->with('edit_category_product', $edit_category_product);

    return view('Front-end-Admin.index')->with('Front-end-Admin.menu.edit_category_product', $manager_category_product);
}

public function update_category_product(Request $request, $category_product_id) {
    // Giải mã category_product_id
   

    // Custom validation messages
    $messages = [
        'category_product_name.required' => 'Không được để trống tên danh mục',
        'category_product_name.max' => 'Tên danh mục không được dài quá 50 ký tự',
        'category_product_name.regex' => 'Tên chỉ chứa chữ, không có khoảng trắng trước và sau, không có hai khoảng trắng liên tiếp',
        'category_product_desc.required' => 'Không được để trống mô tả danh mục',
        'category_product_desc.max' => 'Mô tả danh mục không được dài quá 1000 ký tự',
        'category_product_desc.regex' => 'Mô tả chỉ chứa chữ và số, không có khoảng trắng trước và sau, không có hai khoảng trắng liên tiếp',
    ];

    // Validation rules
    $rules = [
        'category_product_name' => [
            'required',
            'max:50',
            'regex:/^\S(.*\S)?$/u', // Không có khoảng trắng trước và sau
            'regex:/^(?!.*\s{2}).*$/u', // Không có hai khoảng trắng liên tiếp
        ],
        'category_product_desc' => [
            'required',
            'max:1000',
            'regex:/^[\pL\d]+$/u', // Chỉ cho phép chữ cái và số
            'regex:/^\S(.*\S)?$/u', // Không có khoảng trắng trước và sau
            'regex:/^(?!.*\s{2}).*$/u', // Không có hai khoảng trắng liên tiếp
        ],
    ];

    // Validate the request with custom messages
    $request->validate($rules, $messages);

    // Cập nhật danh mục sản phẩm
    $data = [
        'category_name' => $request->category_product_name,
        'category_desc' => $request->category_product_desc,
        'category_status' => $request->category_product_status,
    ];

    DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);

    // Set success message and redirect
    return Redirect::to('all-category-product')->with('message', 'Cập nhật danh mục sản phẩm thành công');
}

 public function api_all_category_product()
 {

     $all_category_product = DB::table('tbl_category_product')->paginate(2);


     return response()->json($all_category_product);
 }
 public function delete_category_product($category_product_id) {
    // Giải mã category_product_id
    $decoded_category_product_id = base64_decode($category_product_id);

    // Thực hiện xóa danh mục với ID đã được giải mã
    DB::table('tbl_category_product')->where('category_id', $decoded_category_product_id)->delete();
    
    Session::put('message', 'Xóa danh mục sản phẩm thành công');
    return Redirect::to('all-category-product');
}

 
//  public function delete_category_product($category_product_id){
   
//     DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
//     Session::put('message','Xóa danh mục sản phẩm thành công');
//     return Redirect::to('all-category-product');
//  }
 
 
 


// public function show_category_home($category_id){
//    //slide
//     //$slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

//     $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
//     $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

//     $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->get();

//     $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->get();

//     return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name);
   
// }

}


