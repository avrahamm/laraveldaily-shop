@extends('layouts.app')

@section('content')
    <div class="col-lg-12">

        <h1 class="my-4">Products</h1>

        <a href="{{ route('products.create') }}" class="btn btn-info">New Product</a>
        <br>
        <br>
        <br>

        <table class="table">
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Price in USD</th>
                <th>Price in EUR</th>
                <th></th>
            </tr>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->price_eur }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('products.edit', $product->id ) }}">Edit</a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                            style="display: inline">
                            @method('DELETE')
                            @csrf
                            <input type="submit" class="btn btn-danger" value="Delete"
                                   onclick="return confirm('Are you sure?')">
                        </form>
                    </td>
                </tr>
            @empty
               <tr>
                   <td colspan="3">No products found</td>
               </tr>
            @endforelse
        </table>

        {{ $products->links() }}

    </div>
@endsection
