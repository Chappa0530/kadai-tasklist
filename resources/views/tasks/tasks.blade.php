@if (count($tasks) > 0)
    <ul class="list-unstyled">
        @foreach ($tasks as $tasklist)
            <li class="media mb-3">
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                <img class="mr-2 rounded" src="{{ Gravatar::get($tasklist->user->email, ['size' => 50]) }}" alt="">
                <div class="media-body">
                    <div>
                        {!! link_to_route('users.show', $tasklist->user->name, ['user' => $tasklist->user->id]) !!}
                        <span class="text-muted">posted at {{ $tasklist->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{!! nl2br(e($tasklist->content)) !!}</p>
                    </div>
                    <div>
                        @if (Auth::id() == $task->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $tasks->links() }}
@endif