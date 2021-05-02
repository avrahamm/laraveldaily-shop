<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->get();
//        $products = \DB::table('products')
//            ->join('categories', 'products.category_id', '=', 'categories.id')
//            ->select('products.*', 'categories.name as category_name')
//            ->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $createdData = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ];
        if ($request->hasFile('photo')) {
            $path = $this->getFilePath($request);
            $createdData['photo'] = $path;
        }
        Product::create($createdData);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $updateData = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ] ;
        if ($request->hasFile('photo')) {
            $path = $this->getFilePath($request);
            $updateData['photo'] = $path;
        }
        $product->update($updateData);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $photoPath = $product->photo;
//        if (Storage::disk('public')->exists($photoPath)) {
        if (Storage::exists($photoPath)) {
            if ( $photoPath !== Product::$defaultPhoto) {
                Storage::delete($photoPath);
            }
        }
        $product->delete();
        return redirect()->route('products.index');
    }

    /**
     * @param StoreProductRequest $request
     * @return false|string
     */
    private function getFilePath(StoreProductRequest $request)
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
}
