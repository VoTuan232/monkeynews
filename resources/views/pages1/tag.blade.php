<div class="row">
         <small>
            <span class="btn-group">
                @foreach($tagHomes as $tag)
                    <a href="{{ route('home.tags.posts', ['id' => $tag->id]) }}"><button class="btn btn-mini">{{ $tag->name }}</button></a>
                @endforeach
            </span>
        </small>
</div>