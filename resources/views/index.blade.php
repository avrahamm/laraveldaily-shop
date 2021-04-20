@extends('layouts.app')

@section('content')
    @include('partials.categories-menu')

    <div class="col-lg-9">

        @include('partials.categories-slider', ['categories' => $categories])

        <div class="row">

            @foreach($products as $product)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#">
                        <img class="card-img-top"
                             src="{{ asset('/storage/'.$product->photo) }}" alt="product"
                        height="300"
                        ></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">{{ $product->name }}</a>
                        </h4>
                        <h5>${{ $product->price }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <hr />
                        <p class="card-text">Category {{ $product->category->name }}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <!-- /.row -->

    </div>
    <!-- /.col-lg-9 -->
@endsection
