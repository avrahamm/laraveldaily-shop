<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($categories as $category)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}"
                @if ($loop->first)
                class="active"
                @endif
            >
        @endforeach
    </ol>
    <div class="carousel-inner" role="listbox">
        @foreach ($categories as $category)
            <div class="carousel-item @if ($loop->first) active @endif">
                <h2 style="text-align: center;"> Category {{ $category->name  }}</h2>
                <img class="d-block img-fluid"
                     src="{{ asset('/storage/'.$category->photo) }}"
                     alt="slide # {{ $loop->index }}">
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
