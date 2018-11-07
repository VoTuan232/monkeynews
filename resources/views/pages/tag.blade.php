@foreach($tags as $tag)
	<a href="{{ route('home.tags.posts', ['id' => $tag->id]) }}" class="fh5co_tagg">{{ $tag->name }}</a>
@endforeach