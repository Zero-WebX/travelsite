@foreach($data as $each)
    <div class="col-md-4 mb-4">
        <div class="post-block alert bg-white p-3 rounded shadow-sm h-100">
            @if(!empty($each->postimg))
                <div class="mb-2 text-center">
                    <img class="border rounded"
                         style="width: 100%; max-height: 200px; object-fit: cover; border-style: groove;"
                         src="{{ asset('storage/' . $each->postimg) }}"
                         alt="изображение поста">
                </div>
            @endif

            <h5 class="modal-title">
                <a href="{{ route('onepost', $each->id) }}" class="text-decoration-none text-dark">
                    {{ $each->caption }}
                </a>
            </h5>

            <p>{{ \Illuminate\Support\Str::limit($each->content, 50) }}</p>

            <p>
                @foreach (explode(' ', $each->tags) as $tag)
                    @if (!empty($tag))
                        <span class="badge bg-warning text-dark me-1">{{ $tag }}</span>
                    @endif
                @endforeach
            </p>

            <p class="text-end mb-0">
                <em>
                    <a href="{{ route('profilepublic', $each->userid) }}" class="text-muted text-decoration-none">
                        Автор: {{ $each->name }}
                    </a> | {{ $each->created_at }}
                </em>
            </p>
        </div>
    </div>
@endforeach