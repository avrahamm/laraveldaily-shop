@extends('layouts.app')

@section('content')
    <div class="col-lg-12">

        <h1 class="my-4">Category {{ $category->name }}</h1>
        <br>
        <img id="photo"
             src="{{ asset('/storage/'.$category->photo) }}" alt="product"
        >
        <table class="table">
            <tr>
                <th>Name</th>
                <th></th>
            </tr>
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('categories.edit', $category->id ) }}">Edit</a>

                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                        style="display: inline">
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="btn btn-danger" value="Delete"
                               onclick="return confirm('Are you sure?')">
                    </form>
                </td>
            </tr>

        </table>

    </div>
@endsection
