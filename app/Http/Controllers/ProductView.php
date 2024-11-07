<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use DB;
use Session;
use App\Models\Slider;
use Illuminate\Support\Facades\Redirect;
class ProductView extends Controller
{
    public function add_product(){
     
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get(); 
       

        return view('Front-end-Admin.product.add_product')->with('cate_product', $cate_product)->with('brand_product');
    	

    }
  

    public function all_product() {
        $all_product = DB::table('product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'product.category_id')
            ->orderby('product.product_id', 'desc')
            ->paginate(5);
    
        // Mã hóa product_id và tạo khóa ngẫu nhiên
        foreach ($all_product as $product) {
            $product->product_id = base64_encode($product->product_id);
            $product->random_key = Str::random(16); // Tạo khóa ngẫu nhiên dài 16 ký tự
        }
    
        $manager_product = view('Front-end-Admin.product.all_product')->with('all_product', $all_product);
        return view('Front-end-Admin.index')->with('Front-end-Admin.product.all_category_product', $manager_product);
    }
    public function save_product(Request $request)
    {
        // Xác định các quy tắc xác thực
        $rules = [
            'product_name' => 'required|regex:/^[A-Za-z0-9\s]+$/|unique:product,product_name',
            'product_price' => 'required|numeric|min:0.01',
            'product_cate' => 'required',
            'product_desc' => 'required|regex:/^[A-Za-z0-9\s]+$/',
            'product_content' => 'required|regex:/^[A-Za-z0-9\s]+$/', // Sử dụng cùng một quy tắc cho nội dung sản phẩm
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    
        // Xác định các thông báo lỗi tùy chỉnh
        $messages = [
            'product_name.required' => 'Tên sản phẩm không được để trống.',
            'product_name.regex' => 'Tên sản phẩm không được chứa ký tự đặc biệt.',
            'product_name.unique' => 'Tên sản phẩm đã tồn tại. Vui lòng chọn tên khác.',
            'product_price.required' => 'Giá sản phẩm không được để trống.',
            'product_price.numeric' => 'Giá sản phẩm phải là một số.',
            'product_price.min' => 'Giá sản phẩm phải lớn hơn 0.',
            'product_cate.required' => 'Vui lòng chọn một danh mục cho sản phẩm.',
            'product_desc.required' => 'Mô tả sản phẩm không được để trống.',
            'product_desc.regex' => 'Mô tả sản phẩm không được chứa ký tự đặc biệt.',
            'product_content.required' => 'Nội dung sản phẩm không được để trống.', // Thông báo cho nội dung sản phẩm
            'product_content.regex' => 'Nội dung sản phẩm không được chứa ký tự đặc biệt.', // Thông báo cho nội dung sản phẩm
            'product_image.required' => 'Vui lòng tải lên ảnh sản phẩm.',
            'product_image.image' => 'Ảnh sản phẩm không hợp lệ.',
            'product_image.mimes' => 'Ảnh sản phẩm phải là một trong các định dạng: jpeg, png, jpg, gif.',
            'product_image.max' => 'Dung lượng ảnh không được vượt quá 2MB.'
        ];
    
        // Tiến hành xác thực
        $validator = Validator::make($request->all(), $rules, $messages);
    
        // Kiểm tra nếu xác thực không thành công
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Lưu dữ liệu nếu xác thực thành công
        $data = $request->only(['product_name', 'product_price', 'product_desc', 'product_content', 'product_status']);
        $data['category_id'] = $request->product_cate;
    
        // Xử lý ảnh sản phẩm
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/product', $new_image);
            $data['product_image'] = $new_image;
        }
    
        DB::table('product')->insert($data);
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('all-product');
    }
  
    public function unactive_product($product_id) {
        // Giải mã product_id
        $decoded_product_id = base64_decode($product_id);
    
        DB::table('product')->where('product_id', $decoded_product_id)->update(['product_status' => 1]);
        Session::put('message', 'Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }
    
    public function active_product($product_id) {
        // Giải mã product_id
        $decoded_product_id = base64_decode($product_id);
    
        DB::table('product')->where('product_id', $decoded_product_id)->update(['product_status' => 0]);
        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }
    
    


public function edit_product($product_id) {
    // Giải mã product_id
    $decoded_product_id = base64_decode($product_id);

    $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get(); 
    $edit_product = DB::table('product')->where('product_id', $decoded_product_id)->get();

    $manager_product = view('Front-end-Admin.product.edit_product')
        ->with('edit_product', $edit_product)
        ->with('cate_product', $cate_product);

    return view('Front-end-Admin.index')->with('Front-end-Admin.product.edit_product', $manager_product);
}
public function update_product(Request $request, $product_id) {
    // Giải mã product_id
    $decoded_product_id = base64_decode($product_id);

    // Xác định các quy tắc xác thực
    $rules = [
        'product_name' => 'required|regex:/^[A-Za-z0-9\s]+$/',
        'product_price' => 'required|numeric|min:0.01',
        'product_quantity' => 'required|integer|min:0',
        'sale' => 'nullable|numeric|min:0|max:100',
        'product_desc' => 'required|regex:/^[A-Za-z0-9\s]+$/',
        'product_content' => 'required|regex:/^[A-Za-z0-9\s]+$/',
        'product_cate' => 'required',
        'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'product_status' => 'required|boolean',
        'hot' => 'nullable|boolean'
    ];

    // Xác định các thông báo lỗi tùy chỉnh
    $messages = [
        'product_name.required' => 'Tên sản phẩm không được để trống.',
        'product_name.regex' => 'Tên sản phẩm không được chứa ký tự đặc biệt.',
        'product_price.required' => 'Giá sản phẩm không được để trống.',
        'product_price.numeric' => 'Giá sản phẩm phải là một số.',
        'product_price.min' => 'Giá sản phẩm phải lớn hơn 0.',
        'product_quantity.required' => 'Số lượng sản phẩm không được để trống.',
        'product_quantity.integer' => 'Số lượng sản phẩm phải là số nguyên.',
        'product_quantity.min' => 'Số lượng sản phẩm phải lớn hơn hoặc bằng 0.',
        'sale.numeric' => 'Giảm giá phải là một số.',
        'sale.min' => 'Giảm giá không được nhỏ hơn 0.',
        'sale.max' => 'Giảm giá không được lớn hơn 100.',
        'product_desc.required' => 'Mô tả sản phẩm không được để trống.',
        'product_desc.regex' => 'Mô tả sản phẩm không được chứa ký tự đặc biệt.',
        'product_content.required' => 'Nội dung sản phẩm không được để trống.',
        'product_content.regex' => 'Nội dung sản phẩm không được chứa ký tự đặc biệt.',
        'product_cate.required' => 'Vui lòng chọn một danh mục cho sản phẩm.',
        'product_image.image' => 'Ảnh sản phẩm không hợp lệ.',
        'product_image.mimes' => 'Ảnh sản phẩm phải là một trong các định dạng: jpeg, png, jpg, gif.',
        'product_image.max' => 'Dung lượng ảnh không được vượt quá 2MB.',
        'product_status.required' => 'Trạng thái sản phẩm không được để trống.',
        'hot.boolean' => 'Trường hot không hợp lệ.'
    ];

    // Tiến hành xác thực
    $validator = Validator::make($request->all(), $rules, $messages);

    // Kiểm tra nếu xác thực không thành công
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Nếu xác thực thành công, tiến hành cập nhật dữ liệu
    $data = $request->only(['product_name', 'product_price', 'product_desc', 'product_content', 'product_status', 'hot']);
    $data['category_id'] = $request->product_cate;
    $data['product_quantity'] = $request->product_quantity;
    $data['sale'] = $request->sale;

    // Tính toán giá sau khi giảm (nếu có giảm giá)
    if ($request->filled('sale') && $request->sale > 0) {
        $data['discounted_price'] = $data['product_price'] * (1 - $request->sale / 100);
    } else {
        $data['discounted_price'] = $data['product_price']; // Nếu không có giảm giá, giữ nguyên giá gốc
    }

    // Xử lý ảnh sản phẩm
    $get_image = $request->file('product_image');
    if ($get_image) {
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move('uploads/product', $new_image);
        $data['product_image'] = $new_image;
    }

    // Cập nhật dữ liệu sản phẩm
    DB::table('product')->where('product_id', $product_id)->update($data);
    Session::put('message', 'Cập nhật sản phẩm thành công');

    return Redirect::to('all-product');
}


// public function update_product(Request $request, $product_id) {
//     // Giải mã product_id
//    // $decoded_product_id = base64_decode($product_id);

//     // Xác định các quy tắc xác thực
//     $rules = [
//         'product_name' => 'required|regex:/^[A-Za-z0-9\s]+$/',
//         'product_price' => 'required|numeric|min:0.01',
//         'product_desc' => 'required|regex:/^[A-Za-z0-9\s]+$/',
//         'product_content' => 'required|regex:/^[A-Za-z0-9\s]+$/',
//         'product_cate' => 'required',
//         'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//     ];

//     // Xác định các thông báo lỗi tùy chỉnh
//     $messages = [
//         'product_name.required' => 'Tên sản phẩm không được để trống.',
//         'product_name.regex' => 'Tên sản phẩm không được chứa ký tự đặc biệt.',
//         'product_price.required' => 'Giá sản phẩm không được để trống.',
//         'product_price.numeric' => 'Giá sản phẩm phải là một số.',
//         'product_price.min' => 'Giá sản phẩm phải lớn hơn 0.',
//         'product_desc.required' => 'Mô tả sản phẩm không được để trống.',
//         'product_desc.regex' => 'Mô tả sản phẩm không được chứa ký tự đặc biệt.',
//         'product_content.required' => 'Nội dung sản phẩm không được để trống.',
//         'product_content.regex' => 'Nội dung sản phẩm không được chứa ký tự đặc biệt.',
//         'product_cate.required' => 'Vui lòng chọn một danh mục cho sản phẩm.',
//         'product_image.image' => 'Ảnh sản phẩm không hợp lệ.',
//         'product_image.mimes' => 'Ảnh sản phẩm phải là một trong các định dạng: jpeg, png, jpg, gif.',
//         'product_image.max' => 'Dung lượng ảnh không được vượt quá 2MB.'
//     ];

//     // Tiến hành xác thực
//     $validator = Validator::make($request->all(), $rules, $messages);

//     // Kiểm tra nếu xác thực không thành công
//     if ($validator->fails()) {
//         return redirect()->back()->withErrors($validator)->withInput();
//     }

//     // Nếu xác thực thành công, tiến hành cập nhật dữ liệu
//     $data = $request->only(['product_name', 'product_price', 'product_desc', 'product_content', 'product_status']);
//     $data['category_id'] = $request->product_cate;

//     // Xử lý ảnh sản phẩm
//     $get_image = $request->file('product_image');
//     if ($get_image) {
//         $get_name_image = $get_image->getClientOriginalName();
//         $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
//         $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
//         $get_image->move('uploads/product', $new_image);
//         $data['product_image'] = $new_image;
//     }

//     // Cập nhật dữ liệu sản phẩm
//     DB::table('product')->where('product_id', $product_id)->update($data);
//     Session::put('message', 'Cập nhật sản phẩm thành công');

//     return Redirect::to('all-product');
// }

public function delete_product($product_id) {
    // Giải mã product_id
    $decoded_product_id = base64_decode($product_id);

    // Thực hiện xóa sản phẩm với ID đã được giải mã
    DB::table('product')->where('product_id', $decoded_product_id)->delete();
    
    Session::put('message', 'Xóa sản phẩm thành công');
    return Redirect::to('all-product');
}

    // public function delete_product($product_id){
     
    //     DB::table('tbl_product')->where('product_id',$product_id)->delete();
    //     Session::put('message','Xóa sản phẩm thành công');
    //     return Redirect::to('all-product');
    // }
//     public function details_product(Request $request){
//         //slide
//       // $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

//        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
//        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

//        $details_product = DB::table('tbl_product')
//        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
//        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id');
     

      
      
      

//        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)->with('product_details',$details_product);

//    }
}
