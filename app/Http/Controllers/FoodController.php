<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestVadidate;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Food;
use App\Models\User;
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
        $this->authorize('update', $food);
        return view('foods/edit', compact('food'));
    }

    //RequestVadidate
    public function update(Request $request, $id)
    {
        $food = Food::find($id);
        $this->authorize('update', $food);

        Food::where('id', '=', $id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        return redirect('/food');
    }

    public function destroy($id)
    {
        // $this->authorize('delete', $food);

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

        $comments = Comment::where('food_id', $id)
            ? Comment::where('food_id', $id)->get()
            : [];

        return view('foods/show', compact('food', 'user', 'comments'));
    }

    public function trash()
    {
        $foods = Food::onlyTrashed()->get();
        return view('foods/trash', compact('foods'));
    }

    public function trashRestore($id)
    {
        Food::withTrashed()
            ->where('id', $id)
            ->restore();

        return redirect()->route('trash')->with('success', 'Khôi phục thành công');
    }

    public function trashDelete($id)
    {
        Food::withTrashed()
            ->where('id', $id)
            ->forceDelete();

        return redirect()->route('trash')->with('success', 'xóa thành công');
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $foods = Food::where('name', 'like', '%' . $keyword . '%')->get();

        return view('posts/index', compact('foods'));
    }

    public function comment(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('post')->with('error_role', 'Bạn chưa đăng nhập');
        }

        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'food_id' => $id,
            'content' => $request->comment,
        ]);
        $comment->save();
        return redirect()->route('post')->with('success', 'Comment Thành Công');
    }

    public function deleteComment(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('post')->with('error_role', 'Bạn chưa đăng nhập');
        }

        Comment::where('id', '=', $id)->delete();

        return redirect()->route('post')->with('success', 'Xóa Comment Thành Công');
    }
}
