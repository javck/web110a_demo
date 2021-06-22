<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

/**
 * 處理給後端使用的CRUD功能
 *
 */
class CategoryController extends Controller
{

    /**
     * 顯示分類的多筆(所有)資料
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Category::all(); //直接取得表格的所有資料
        //return Category::get(); //根據你的條件來取得符合的資料
        $data = Category::where('enabled',true)->where('parent_id',1)->orderBy('id','desc')->get();
        if($data && count($data) > 0){
            return $this->makeJson(1,$data,null);
        }else{
            return $this->makeJson(0,null,'資料不存在');
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //只有做後端的CRUD會用到，可以用Voyager來搞定
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  return Category::create([
        //     'parent_id' => 1,
        //     'name' => '我的分類',
        //     'enabled' => true,
        //     'sort' => 9
        // ]);

        $category = Category::create($request->only(['name','enabled','sort']));

        if($category){
            return $this->makeJson(1,$category,null);
        }else{
            return $this->makeJson(0,null,'新增資料異常');
        }

    }

    /**
     * Display the specified resource.
     * 顯示某一筆資料
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //select * from categories where id = 1;
        $category = Category::find($id);

        if($category){
            return $this->makeJson(1,$category,null);
        }else{
            return $this->makeJson(0,null,'查詢該資料異常');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //只有做後端的CRUD會用到，可以用Voyager來搞定
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
        //$category->parent_id = $request->parent_id;
        //$category->name = $request->name;
        // $category->enabled = $request->enabled;
        // $category->sort = $request->sort;
        //$category->save();
        //return $category;
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
