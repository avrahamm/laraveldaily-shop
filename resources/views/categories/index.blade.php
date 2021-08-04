@extends('layouts.app')

@section('content')
    <div class="col-lg-12">

        <h1 class="my-4">Categories</h1>

        <a href="{{ route('categories.create') }}" class="btn btn-info">New Category</a>
        <br>
        <br>
        <br>

        <table class="table">
            <tr>
                <th>Name</th>
                <th></th>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a class="btn btn-primary"
                           href="{{ route('categories.show', $category->id ) }}">
                            Show
                        </a>
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
            @endforeach
        </table>

        {{ $categories->links() }}
    </div>
@endsection
