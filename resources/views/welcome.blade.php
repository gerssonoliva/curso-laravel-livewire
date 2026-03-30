<x-layouts.app>
    
    <ul>
        @foreach ($posts as $post)
            <li>
                <article class="bg-white rounded shadow-lg">
                    {{-- <a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a>
                    <p>{{ $post->excerpt }}</p> --}}
                    <img class="h-72 w-full object-cover object-center" src="{{ $post->image }}" alt="{{ $post->title }}">
                    <div class="px-6 py-2">
                        <h1 class="font-semibold text-xl mb-2">
                            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                        </h1>
                        <div>
                            {{ $post->excerpt }}
                        </div>
                    </div>
                </article>
            </li>
        @endforeach
    </ul>
    <div>
        {{ $posts->links() }}
    </div>

</x-layouts.app>