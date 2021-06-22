<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    private function makeJson($status , $data = null , $msg = null)
    {
        return response()->json([
            'status'=>$status,
            'data' => $data,
            'message' => $msg
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::where('enabled',true)->where('parent_id',1)->orderBy('id','desc')->get();
        if($data && count($data) > 0){
            return $this->makeJson(1,$data,null);
        }else{
            return $this->makeJson(0,null,'資料不存在');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create($request->only(['name','enabled','sort']));

        if($category){
            return $this->makeJson(1,$category,null);
        }else{
            return $this->makeJson(0,null,'新增資料異常');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        if($category){
            return $this->makeJson(1,$category,null);
        }else{
            return $this->makeJson(0,null,'查詢該資料異常');
        }
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
        $category = Category::find($id);
        if($category){
            $row = $category->update($request->only(['parent_id','name','enabled','sort']));
            if($row == 1){
                return $this->makeJson(1, null,null);
            }else{
                return $this->makeJson(0, null,'資料更新錯誤');
            }
        }else{
            return $this->makeJson(0, null,'找不到該筆資料');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if($category){
            $row = $category->delete();
            if($row == 1){
                return $this->makeJson(1, null,null);
            }else{
                return $this->makeJson(0, null,'資料刪除錯誤');
            }
        }else{
            return $this->makeJson(0, null,'找不到該筆資料');
        }
    }
}
