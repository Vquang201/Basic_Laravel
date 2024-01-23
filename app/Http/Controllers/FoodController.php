<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Food;
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

        $food = Food::create([
            'name' => $request->input('name'),
            'count' => $request->input('count'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id')
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

    public function update(Request $request, $id)
    {
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

        print_r($food);
        // return ;
    }
}
