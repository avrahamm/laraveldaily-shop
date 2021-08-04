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
                <th>Price</th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }}</td>
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
            @endforeach
        </table>

        {{ $products->links() }}
    </div>
@endsection
