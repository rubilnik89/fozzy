<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserProduct;
use App\Http\Requests\StoreUserProduct;
use App\Http\Requests\UpgradeUserProduct;
use App\Models\Product;
use App\Models\UserProduct;
use Illuminate\Http\Request;

class ProductsControloler extends Controller
{
    public function add(StoreUserProduct $request)
    {
        $userProduct = new UserProduct();
        $userProduct->created = now();
        $userProduct->name = $request->get('name');
        $userProduct->product_id = $request->get('product_id');
        $userProduct->user_id = auth()->user()->id;
        $userProduct->save();

        return response('продукт успешно добавлен', 200);
    }

    public function list()
    {
        return response(auth()->user()->userProducts, 200);
    }

    public function edit(EditUserProduct $request)
    {
        $userProduct = Product::find($request->id);
        $userProduct->name = $request->get('name');
        $userProduct->modified = now();
        $userProduct->save();

        return response('продукт успешно обновлен', 200);
    }

    public function delete(Request $request)
    {
        $userProduct = Product::find($request->id);
        $userProduct->delete();

        return response('продукт успешно удален', 200);
    }

    public function upgrade(UpgradeUserProduct $request)
    {
        $userProduct = Product::find($request->id);
        $userProduct->product_id = $request->get('product_id');
        $userProduct->save();

        return response('продукт успешно проапгрейжен', 200);

    }

    public function downgrade(Request $request)
    {
        $userProduct = Product::find($request->id);
        $desiredProduct = Product::find($request->product_id);
        if($desiredProduct){
            if($desiredProduct->disk_size == $userProduct->product->disk_size){
                $userProduct->product_id = $request->product_id;
                $userProduct->save();
                return response('downgrade продукта произведен успешно', 200);
            }else{
                return response('невозможно провести downgrade в автоматичесĸом режиме.', 403);
            }
        }else{
            return response('не существует выбранного продукта', 404);
        }
    }
}
