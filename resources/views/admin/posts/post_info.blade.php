@foreach($posts as $post)

<tr id="{{ $post->id }}">
    <td>{{ $post->id }}</td>
    <td>{{ $post->title }}</td>
    <td>{{ $post->slug }}</td>
    <td>{{ substr(strip_tags($post->body),0,50) }}{{ strlen(strip_tags($post->body))>50 ? "..." : "" }}</td>
    <td>{{ $post->published }}</td>
    <td>{{ $post->image }}</td>
    <td>{{ $post->username }}</td>
    <td>{{ $post->vote }}</td>
    <td>{{ $post->view }}</td>
    <td>
        <a href="#" class="btn btn-info btn-xs" id="view" data-id="{{$post->id}}">View</a>
        @can('post.update', $post)
        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success btn-xs" id="edit" data-id="{{$post->id}}">Edit</a>
        @endcan
        @can('post.delete')
        <a href="#" class="btn btn-danger btn-xs" id="delete" data-id="{{$post->id}}">Delete</a>
        @endcan
        {{-- @endcan --}}
    </td>
</tr>

@endforeach
