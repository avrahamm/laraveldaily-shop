<div class="col-lg-3">

    <h1 class="my-4">Shop Name</h1>
    <div class="list-group">
        @foreach ($categories as $category)
            <a href="/?category_id={{ $category->id }}" class="list-group-item">{{$category->name}}</a>
        @endforeach
    </div>

</div>
<!-- /.col-lg-3 -->
