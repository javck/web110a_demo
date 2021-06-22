<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

/**
 * 處理給 API 使用的CRUD功能
 *
 */
class CategoryController extends Controller
{

    /**
     * 用來生成回應所需要的 JSON 字串
     * @param integer $status 0為失敗，1為成功
     * @param mixed $data 查詢資料，一般狀態為1時提供
     * @param string $msg 錯誤訊息，狀態為0時提供
     *
     * @return string
     */
    private function makeJson($status , $data = null , $msg = null)
    {
        return response()->json([
            'status'=>$status,
            'data' => $data,
            'message' => $msg
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE); //處理中文傳送變亂碼的問題
    }

    /**
     * 回傳所有上架的分類資料
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //SQL查詢示範
        $data = Category::where('enabled',true)->orderBy('sort','asc')->get();

        if($data && count($data) > 0){
            return $this->makeJson(1,$data,null);
        }else{
            return $this->makeJson(0,null,'資料不存在');
        }
    }

    /**
     * 新增一個分類
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //新增資料示範
        $category = Category::create($request->only(['name','enabled','sort']));

        if($category){
            return $this->makeJson(1,$category,null);
        }else{
            return $this->makeJson(0,null,'新增資料異常');
        }
    }

    /**
     * 回傳某一個分類的資料
     *
     * @param  int  $id 主鍵
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //用主鍵來查詢資料示範
        $category = Category::find($id);

        if($category){
            return $this->makeJson(1,$category,null);
        }else{
            return $this->makeJson(0,null,'查詢該資料異常');
        }
    }

    /**
     * 更新某一個分類
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id 主鍵
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if($category){
            //更新資料示範
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
     * 刪除某一個分類的資料
     *
     * @param  int  $id 主鍵
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if($category){
            //刪除資料示範
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
