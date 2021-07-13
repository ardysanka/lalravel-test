<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{$message}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <ul>
    @foreach ($content->all() as $content)
        <li>{{ $content }}</li>
    @endforeach
    </ul>
</div>