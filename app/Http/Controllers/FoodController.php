<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestVadidate;
use App\Models\Category;
use App\Models\Food;
use App\Rules\Uppercase;
use Illuminate\Http\Request;



class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        // SELECT * FROM Food;
        // print_r($food);
        return view('foods/index', compact('foods'));
    }

    public function store(Request $request)
    {
        // $food = new Food();
        // $food->name = $request->input('name');
        // $food->count = $request->input('count');
        // $food->description = $request->input('description');

        $request->validate([
            'name' => new Uppercase,
            'count' => 'required|min:0',
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
            'name' => $request->input('name'),
            'count' => $request->input('count'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'image_path' => $imageName
        ]);


        $food->save();

        return redirect('/food');
    }

    public function create()
    {
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
            'count' => $request->input('count'),
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
        $food = Food::find($id);

        $category = Category::find($food->category_id);

        $food->category = $category;
        // thêm category vào food , giống populate trong ExpressJS
        // print_r($category);

        return view('foods/show', compact('food'));
    }
}
