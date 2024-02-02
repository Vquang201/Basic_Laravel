<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    public function index()
    {
        //query builder (ánh xạ id để hacker khỏi can thiệp trực tiếp)
        // $posts = DB::select('SELECT * FROM posts WHERE id= :id', ['id' => 3]);

        // $posts = DB::table("posts")
        //     ->where('id', '=', 5)
        //     ->delete();
        // ->update([
        //     'title' => 'haha title',
        //     'body' => 'This is haha body',
        // ]);

        // ->insert([
        //     'title' => 'haha',
        //     'body' => 'A new post hahaha'
        // ]);

        //->avg('id');//average
        //->sum('id');
        //->min('id');
        //->count();
        //->find(3);//find by id
        //->whereNotNull("body")
        //->oldest()                    
        //->latest()
        //->orderBy('id', 'asc')
        // ->whereBetween("id", [1, 3])                    
        // ->where("created_at",">", now()->subDay())
        // ->orWhere('id', '>', 0)
        //->select('body')
        //->first();
        //->get();



        $foods = Food::all();

        // print_r($foods);
        return view('posts/index', compact('foods'));
    }
}
