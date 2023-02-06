@extends('layout')

@section('content')
    <ul>
        @foreach($users as $user)
            <li>
                {{ $user->id . ': '. $user->name }}
                @if($user->posts)
                    <ul>
                    @foreach($user->posts as $post)
                        <li>
                            {{ $post->title . ' - ' . ' ('. $post->author_id . ')' }}
                        </li>
                    @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
@endsection
