
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">
<div class="container py-5">
    <h2 class="fw-bold mb-4">友達</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">友達を追加</h5>

            <form method="POST" action="{{ route('friends.store') }}" class="d-flex gap-2">
                @csrf
                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="相手のメールアドレス"
                       required>
                <button type="submit" class="btn btn-primary flex-shrink-0">
                    友達申請
                </button>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">届いた申請</h5>

            @forelse ($receivedRequests as $friendship)
                <div class="d-flex justify-content-between align-items-center border-top py-3">
<div class="d-flex align-items-center gap-2">
    @if ($friendship->requester->profile_image)
        <img
            src="{{ asset('storage/' . $friendship->requester->profile_image) }}"
            alt="{{ $friendship->requester->name }}のプロフィール画像"
            class="rounded-circle"
            width="44"
            height="44"
            style="object-fit: cover;"
        >
    @else
        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
             style="width: 44px; height: 44px;">
            {{ mb_substr($friendship->requester->name, 0, 1) }}
        </div>
    @endif

    <div>
        <div class="fw-semibold">{{ $friendship->requester->name }}</div>
        <small class="text-secondary">{{ $friendship->requester->email }}</small>
    </div>
</div>

                    <form method="POST" action="{{ route('friendships.accept', $friendship) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-outline-primary">
                            承認
                        </button>
                    </form>
                </div>
            @empty
                <p class="text-secondary mb-0">届いた申請はありません。</p>
            @endforelse
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold mb-3">友達リスト</h5>

            @forelse ($friends as $friend)
                <div class="border-top py-3">
                    <div class="fw-semibold">{{ $friend->name }}</div>
                    <small class="text-secondary">{{ $friend->email }}</small>
                </div>
            @empty
                <p class="text-secondary mb-0">友達はまだ登録されていません。</p>
            @endforelse
        </div>
    </div>
</div>
