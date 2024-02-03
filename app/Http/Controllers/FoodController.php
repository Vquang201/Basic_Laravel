<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestVadidate;
use App\Models\Category;
use App\Models\Food;
use App\Models\User;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('post')->with('error_role', 'Bạn chưa đăng nhập');
        }
        $foods = Food::all();
        // SELECT * FROM Food;
        // print_r($food);
        return view('foods/index', compact('foods'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('post')->with('error_role', 'Bạn chưa đăng nhập');
        }

        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'image' => 'required|mimes:jpg,png|max:6000'
        ]);

        // validate những name ở client(HTML)

        // $request->validate([]);


        // upload image
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);



        $food = Food::create([
            'user_id' => Auth::user()->id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'image_path' => $imageName
        ]);


        $food->save();

        return redirect('/food');
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('post')->with('error_role', 'Bạn chưa đăng nhập');
        }
        $categories = Category::all();
        // print_r($categories);
        return view('foods/create', compact('categories'));
    }

    public function edit($id)
    {

        $food = Food::find($id);
        return view('foods/edit', compact('food'));
    }

    public function update(RequestVadidate $request, $id)
    {
        $request->validate([]);
        Food::where('id', '=', $id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        return redirect('/food');
    }

    public function destroy($id)
    {
        Food::where('id', '=', $id)->delete();
        return redirect('/food');
    }

    public function show($id)
    {

        // get category trong food ()
        $food = Food::find($id);
        $category = Category::find($food->category_id);
        $food->category = $category;
        // thêm category vào food

        // sử dụng with (Eager Loading)
        // để lấy thông tin người dùng thông qua food id 
        $user = User::with('food')->find($food->user_id);
        // with => bảng food
        // find => tìm id của người dùng

        // print_r($category);

        return view('foods/show', compact('food', 'user'));
    }
}
