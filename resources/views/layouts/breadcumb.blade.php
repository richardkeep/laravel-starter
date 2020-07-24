<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($data as $key => $value)
            @if($key != "_page_title")
                @if($value)
                    <li class="breadcrumb-item"><a href="{{$value}}">{{$key}}</a></li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">{{$data['_page_title']}}</li>
                @endif
            @endif
        @endforeach
    </ol>
</nav>
