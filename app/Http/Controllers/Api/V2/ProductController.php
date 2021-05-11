<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
//        $products = Product::all();
        $products = Product::with('category')->paginate(2);

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        $productData = [];
        $productFields = self::getProductFields();
        $productFields->each(
            function ($key) use ($request, &$productData) {
                $productData[$key] = $request->$key;
            }
        );

        if ($request->hasFile('photo')) {
            $path = $this->getFilePath($request);
            $productData['photo'] = $path;
        }

        $product = Product::create($productData);
        return $product;
    }

    /**
     * * Display the specified resource.
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param $id
     * @return mixed
     */
    public function update(UpdateRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $productData = [];
        $productFields = self::getProductFields();
        $productFields->each(function($key) use ($request,$product,&$productData) {
                $productData[$key] = $request->$key ?? $product->$key;
            }
        );
        $product->update($productData);
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * TODO! Copied from/Used in both web and api ProductController,
     *    consider moving to helper.
     *
     * @param FormRequest $request
     * @return false|string
     */
    private function getFilePath(FormRequest $request)
    {
        $extension = $request->file('photo')->extension();
        $path = $request->file('photo')
            ->storeAs(
                'products',
                ($request->name) . '.' . $extension,
                'public'
            );
        return $path;
    }

    private static function getProductFields()
    {
        $productFields = collect(['name','price','photo','description','category_id']);
        return $productFields;
    }
}
