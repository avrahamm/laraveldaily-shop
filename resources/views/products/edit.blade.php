@extends('layouts.app')

@section('content')
    <div class="col-lg-12">

        <h1 class="my-4">Edit Product</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST"
              enctype="multipart/form-data"
        >
            @method('PUT')
            @csrf
            <label for="name">Name</label>
            <br />
            <input id="name" type="text" name="name"
                   value="{{  $product->name }}"
                   class="form-control"
            >

            <br />
            <label for="price">Price</label>
            <br />
            <input id="price" type="text" name="price"
                   value="{{ $product->price }}"
                   class="form-control"
            >

            <br />
            <label for="description">Description</label>
            <br />
            <textarea id="description" name="description"
                      class="form-control" rows="3"
            >{{ $product->description}}</textarea>

            <br />
            <label for="photo">Photo</label>
            <br />
            <img src="/storage/{{ $product->photo }}" alt="product"
                width="100" height="100"
            >
            <input id="photo" type="file" name="photo" value="{{ old('photo') }}"
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
