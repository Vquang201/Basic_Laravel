<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;


class ApiFoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $food = Food::all();

        return $food;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // upload image
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);




        $food = Food::create([...$request->all(), 'image_path' => $imageName]);
        $food->save();

        return ResponseHelper::success('Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $food = Food::find($id);

        if (!$food) {
            return response()->json(['Error' => 'Error in server'], 500);
        }
        ResponseHelper::success($food);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $food = Food::find($id);

        if (empty($food)) {
            return response()->json(['Error' => 'không tìm thấy'], 500);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $food->update([...$request->all(), 'image_path' => $imageName]);
        } else {
            $food->update($request->all());
        }

        return response()->json(['success' => $food], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::find($id);

        if (empty($food)) {
            return response()->json(['Error' => 'không tìm thấy'], 500);
        }

        $food->delete();
        // xóa ảnh trong folder
        $image_path = public_path('images/' . $food->image_path);
        unlink($image_path);


        return response()->json(['message' => 'Xóa thành công']);
    }
}
