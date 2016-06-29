
<!-- Comment -->
@forelse($comments as $comment)
    <div class="media">
        <a class="pull-left" href="#">
            @if($comment->created_by != null && $comment->created_by->pic)
                <img src="{!! url('/').'/uploads/users/'.$comment->created_by->pic !!}" alt="img" class="img-max img-rounded" width="64"/>
            @else
                <img src="http://placehold.it/64x64" alt="..." class="img-max img-rounded" />
            @endif
        </a>
        <div class="media-body">
            <h4 class="media-heading">
                {{ $comment->created_by != null ? $comment->created_by->first_name . ' ' . $comment->created_by->last_name : ''  }}
                <small>{{ $comment->created_at->format('M d, Y \a\t h:i a') }}</small>
                @if (Sentinel::check() && Sentinel::inRole('admin'))
                    <small><a href="{{ route('delete-comment', $comment->id) }}">delete</a></small>
                @endif
            </h4>
            {{ $comment->comment }}
        </div>
    </div>
@empty
    <div class="media">
        <div class="media-body" style="text-align: center">
            There are no comments.
        </div>
    </div>
@endforelse
