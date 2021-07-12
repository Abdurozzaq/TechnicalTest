<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Goods;
use App\Http\Requests\Goods\CreateGoodsRequest;
use App\Http\Requests\Goods\EditGoodsRequest;
use App\Http\Requests\Goods\DeleteGoodsRequest;
use Redirect;

class GoodsController extends Controller
{
    public function createGoodsIndex() {

        $category_name = Category::select('id as abbr', 'category_name as state')->get();


        return Inertia::render('GoodsManagement/CreateGoods', [
            'status' => 'success',
            'code' => '200',
            'data' => [
                'categories' => $category_name,
            ]
        ]);
    }

    public function createGoods(CreateGoodsRequest $request)
    {
        $validated = $request->validated();

        Goods::create([
            'goods_name' => $validated['goods_name'],
            'category_id' => $validated['category_id'],
            'goods_description' => $validated['goods_description'],
            'goods_qty' => $validated['goods_qty'],
        ]);

        return Redirect::back();
    }

    // List of Goods View
    public function goodsListIndex() {
        $goods = Goods::with('category')->get();

        // get category & unit names for editing in view
        $category_name = Category::select('id as abbr', 'category_name as state')->get();

        return Inertia::render('GoodsManagement/GoodsList', [
            'status' => 'success',
            'code' => '200',
            'data' => [
                'goods' => $goods,
                'categories' => $category_name,
            ]
        ]);
    }

    // Edit Goods
    public function editGoods(EditGoodsRequest $request)
    {
        $validated = $request->validated();

        $goods = Goods::findOrFail($validated['id']);
        $goods->goods_name = $validated['goods_name'];
        $goods->category_id = $validated['category_id'];
        $goods->goods_qty = $validated['goods_qty'];
        $goods->goods_description = $validated['goods_description'];
        $goods->save();

        return Redirect::back();
    }

    public function deleteGoods (DeleteGoodsRequest $request) {
        $validated = $request->validated();
  
        $goods = Goods::findOrFail($validated['id']);
        $goods->delete();
  
        return Redirect::back();
    }
}
