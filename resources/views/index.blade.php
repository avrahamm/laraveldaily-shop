@extends('layouts.app')

@section('content')
    @include('partials.categories-menu')

    <div class="col-lg-9">
        @include('partials.categories-slider', ['categories' => $categories])
        @include('partials.products', ['categories' => $categories, 'products' => $products])
    </div>
    <!-- /.col-lg-9 -->
@endsection
