@extends('layouts.app')

@section('content')
    <div class="col-lg-12">

        <h1 class="my-4">Edit Product</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST" >
            @method('PUT')
            @csrf
            Name
            <br />
            <input type="text" name="name" value="{{ $product->name }}"
                class="form-control"
            >

            <br />
            Price
            <br />
            <input type="text" name="price" value="{{ $product->price }}"
                   class="form-control"
            >

            <br />
            Description
            <br />
            <textarea name="description" class="form-control" rows="3"
            >{{ $product->description }}</textarea>

            <br />
            Photo
            <br />
            <img src="" alt="product">
            <input type="file" name="photo" value=""
                   class="form-control"
            >

            <br />
            <label for="categories">Categories</label>
            <br />
            <select name="category_id" id="categories">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                    @if ($category->id === $product->category_id)
                        selected
                    @endif
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <br />
            <input type="submit" class="btn btn-primary" value="Update">
            <br />
        </form>

    </div>
@endsection
