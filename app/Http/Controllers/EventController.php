<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::paginate(10);

        return view('Front-end-Admin.event.index', compact('events'));
    }

    public function create()
    {
        return view('Front-end-Admin.event.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:event,name',
                'regex:/^(?!.*\s{2,}).+$/',
            ],
            'content' => [
                'required',
                'string',
                'regex:/^(?!.*\s{2,}).+$/',
            ],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'check_active' => 'required|boolean',
            'start_day' => 'required|date',
            'end_day' => 'required|date|after_or_equal:start_day',
        ], [
            // Custom messages
            'name.required' => 'Tên sự kiện là bắt buộc.',
            'name.unique' => 'Tên sự kiện đã tồn tại.',
            'name.regex' => 'Tên sự kiện không được phép có hai khoảng trắng liên tiếp.',
            'content.required' => 'Nội dung sự kiện là bắt buộc.',
            'content.regex' => 'Nội dung không được phép có hai khoảng trắng liên tiếp.',
            'image.required' => 'Hình ảnh là bắt buộc.',
            'image.image' => 'File phải là một hình ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc gif.',
            'image.max' => 'Hình ảnh không được lớn hơn 2MB.',
            'check_active.required' => 'Trạng thái kích hoạt là bắt buộc.',
            'start_day.required' => 'Ngày bắt đầu là bắt buộc.',
            'start_day.date' => 'Ngày bắt đầu không đúng định dạng.',
            'end_day.required' => 'Ngày kết thúc là bắt buộc.',
            'end_day.date' => 'Ngày kết thúc không đúng định dạng.',
            'end_day.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/events'), $imageName);
        } else {
            return redirect()->back()->withErrors('Image upload failed');
        }

        Event::create([
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'image' => $imageName ?? null,
            'check_active' => $request->input('check_active'),
            'start_day' => $request->input('start_day'),
            'end_day' => $request->input('end_day'),
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

    public function destroy($id)
    {
        // Tìm sự kiện theo id
        $event = Event::findOrFail($id);

        // Xóa sự kiện
        $event->delete();

        // Điều hướng lại trang danh sách sự kiện với thông báo thành công
        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }
}
