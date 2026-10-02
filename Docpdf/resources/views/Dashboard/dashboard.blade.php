<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ダッシュボード - Contract Maker</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .custom-pagination {
                margin-top: 20px;
            }

            .custom-pagination .pagination {
                margin-bottom: 0;
            }

            .custom-pagination .page-link {
                font-size: 14px;
                padding: 6px 10px;
            }

            .custom-pagination .page-link svg {
                width: 16px !important;
                height: 16px !important;
                max-width: 16px !important;
                max-height: 16px !important;
                display: inline-block;
            }
        </style>
    </head>

    <body class="bg-light">

        <nav class="navbar bg-white border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">

        {{-- 左側：マイページ画像と設定 --}}
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('profile.index') }}"
               class="d-flex align-items-center gap-2 text-decoration-none">
                @if (Auth::user()->profile_image)
                    <img
                        src="{{ asset('storage/' . Auth::user()->profile_image) }}"
                        alt="プロフィール画像"
                        class="rounded-circle"
                        width="36"
                        height="36"
                        style="object-fit: cover;"
                    >
                @else
                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                         style="width: 36px; height: 36px;">
                        {{ mb_substr(Auth::user()->name, 0, 1) }}
                    </div>
                @endif

                <span class="navbar-brand fw-bold mb-0">マイページ</span>
            </a>

            <a href="{{ route('settings') }}"
               class="btn btn-outline-secondary btn-sm">
                設定
            </a>
        </div>

        {{-- 右側：ユーザー名とログアウト --}}
        <div class="d-flex align-items-center gap-3">
            <span class="text-secondary d-none d-sm-inline">
                ようこそ、<strong>{{ Auth::user()->name }}</strong> さん
            </span>

            <form method="POST" action="{{ route('logout') }}" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    ログアウト
                </button>
            </form>
        </div>

    </div>
</nav>

        <div class="container py-4 py-lg-5">

            {{-- ページ見出し --}}
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <h2 class="fw-bold mb-1">契約書ダッシュボード</h2>
                    <p class="text-secondary mb-0">
                        作成した契約書の管理や、新しい契約書の作成が行えます。
                    </p>
                </div>

                <a href="{{ route('Docu.Gene') }}" class="btn btn-primary">
                    ＋ 新規契約書を作成
                </a>
            </div>

            {{-- 統計カード --}}
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-secondary">作成済み契約書</div>
                            <div class="fs-3 fw-bold mt-2">{{ $documentCount }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-secondary">今月の作成数</div>
                            <div class="fs-3 fw-bold mt-2">{{ $monthlyDocumentCount }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="text-secondary">アカウント状態</div>
                            <div class="fs-3 fw-bold text-success mt-2">有効</div>
                        </div>
                    </div>
                </div>
            </div>
{{-- 検索後は契約書一覧タブを選択する --}}
@php
    $documentsTabActive = request()->routeIs('documents.search')
        || request()->filled('input_text');
@endphp

{{-- タブメニュー --}}
<ul class="nav nav-tabs mb-4" id="dashboard-tabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ $documentsTabActive ? '' : 'active' }}"
                id="overview-tab"
                data-bs-toggle="tab"
                data-bs-target="#overview"
                type="button"
                role="tab"
                aria-controls="overview"
                aria-selected="{{ $documentsTabActive ? 'false' : 'true' }}">
            概要
        </button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link {{ $documentsTabActive ? 'active' : '' }}"
                id="documents-tab"
                data-bs-toggle="tab"
                data-bs-target="#documents"
                type="button"
                role="tab"
                aria-controls="documents"
                aria-selected="{{ $documentsTabActive ? 'true' : 'false' }}">
            契約書一覧
        </button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="notifications-tab"
                data-bs-toggle="tab"
                data-bs-target="#notifications"
                type="button"
                role="tab"
                aria-controls="notifications"
                aria-selected="false">
            通知
            @if ($notifications->isNotEmpty())
                <span class="badge text-bg-danger ms-1">{{ $notifications->count() }}</span>
            @endif
        </button>
    </li>
</ul>

<div class="tab-content" id="dashboard-tabs-content">

    {{-- 概要タブ --}}
    <div class="tab-pane fade {{ $documentsTabActive ? '' : 'show active' }}"
         id="overview"
         role="tabpanel"
         aria-labelledby="overview-tab">
<div class="card border-0 shadow-sm mt-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">終了日が近い契約</h5>

            <span class="badge text-bg-warning">
                30日以内
            </span>
        </div>

        @forelse ($endingSoonDocuments as $document)
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 border-bottom py-3">
                <div>
                    <div class="fw-semibold">{{ $document->title }}</div>
                    <small class="text-secondary">
                        {{ $document->client_name ?? '取引先未設定' }}
                        ・終了日 {{ \Illuminate\Support\Carbon::parse($document->end_date)->format('Y/m/d') }}
                    </small>
                </div>

                <a href="{{ route('documents.edit', $document) }}"
                   class="btn btn-sm btn-outline-primary flex-shrink-0">
                    契約を確認
                </a>
            </div>
        @empty
            <p class="text-secondary mb-0">
                今後30日以内に終了する契約はありません。
            </p>
        @endforelse

        <a href="{{ route('documents.index') }}"
           class="btn btn-link px-0 mt-3">
            契約書一覧を見る
        </a>
    </div>
</div>
    </div>

    {{-- 契約書一覧タブ --}}
    <div class="tab-pane fade {{ $documentsTabActive ? 'show active' : '' }}"
         id="documents"
         role="tabpanel"
         aria-labelledby="documents-tab">

        <div class="card border-0 shadow-sm">
            <div class="card-body p-3 p-md-4">

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                    <h5 class="fw-bold mb-0">契約書一覧</h5>

                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <form method="GET" action="{{ route('documents.search') }}" class="d-flex flex-column flex-sm-row gap-2">
                            <select name="document_type"
                                    class="form-select"
                                    aria-label="書類の種類で絞り込み">
                                <option value="">すべての種類</option>
                                <option value="receipt" @selected(request('document_type') === 'receipt')>領収書</option>
                                <option value="quotation" @selected(request('document_type') === 'quotation')>見積書</option>
                                <option value="delivery" @selected(request('document_type') === 'delivery')>納品書</option>
                                <option value="contract" @selected(request('document_type') === 'contract')>契約書</option>
                            </select>
                            <input type="search"
                                   name="input_text"
                                   value="{{ request('input_text') }}"
                                   class="form-control"
                                   placeholder="タイトルで検索"
                                   aria-label="契約書を検索">
                            <button type="submit" class="btn btn-outline-primary flex-shrink-0">
                                検索
                            </button>
                        </form>

                        <a href="{{ route('documents.index') }}"
                           class="btn btn-outline-secondary flex-shrink-0">
                            すべて見る
                        </a>
                    </div>
                </div>

                @if ($recentDocuments->isEmpty())
                    <div class="text-center py-5 text-secondary">
                        <p class="mb-3">契約書がまだありません。</p>
                        <a href="{{ route('Docu.Gene') }}" class="btn btn-outline-primary">
                            最初の契約書を作成
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>タイトル</th>
                                    <th>種類</th>
                                    <th>取引先</th>
                                    <th>契約日</th>
                                    <th>作成日</th>
                                    <th class="text-end">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentDocuments as $document)
                                    <tr>
                                        <td class="fw-semibold">{{ $document->title }}</td>
                                        <td>{{ $document->document_type }}</td>
                                        <td>{{ $document->client_name ?? '-' }}</td>
                                        <td>{{ $document->contract_date?->format('Y/m/d') ?? '-' }}</td>
                                        <td>{{ $document->created_at->format('Y/m/d') }}</td>
                                        <td>
                                           <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('documents.edit', ['document' => $document->uuid]) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                    開く
                                                </a>

                                                <button type="button"
                                                        class="btn btn-sm btn-outline-success"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#shareModal"
                                                        data-document-uuid="{{ $document->uuid }}"
                                                        data-document-title="{{ $document->title }}">
                                                    共有
                                                </button>

                                                <form action="{{ route('documents.destroy', $document->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('このデータを削除しますか？');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        削除
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $recentDocuments->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- 通知タブ --}}
    <div class="tab-pane fade"
         id="notifications"
         role="tabpanel"
         aria-labelledby="notifications-tab">

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-3">未読のお知らせ</h5>
@forelse ($notifications as $notification)
    <div class="alert alert-warning d-flex justify-content-between align-items-center gap-3">
        <div>
            <div>{{ $notification->data['message'] ?? 'お知らせがあります。' }}</div>

            @if (!empty($notification->data['title']))
                <div class="fw-semibold">{{ $notification->data['title'] }}</div>
            @endif

            @if (!empty($notification->data['end_date']))
                <small>終了日：{{ $notification->data['end_date'] }}</small>
            @endif
        </div>

        <form method="POST"
              action="{{ route('notifications.read', $notification->id) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-sm btn-outline-secondary flex-shrink-0">
                既読にする
            </button>
        </form>
    </div>
@empty
    <p class="text-secondary mb-0">未読のお知らせはありません。</p>
@endforelse
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="shareModal" tabindex="-1"
     aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareModalLabel">ドキュメントを共有</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-body">
                <input type="search" class="form-control mb-3 friend-search"
                       placeholder="友だちを検索" aria-label="友だちを検索">
                <div class="friend-list">
                    @forelse (($friends ?? collect()) as $friend)
                        <label class="friend-item d-flex align-items-center gap-2 py-2 border-bottom">
                            <input type="checkbox" name="friend_ids[]" value="{{ $friend->id }}">
                            <span>{{ $friend->name }}（{{ $friend->email }}）</span>
                        </label>
                    @empty
                        <p class="text-secondary mb-0">友だちがいません。</p>
                    @endforelse
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                <button type="button" class="btn btn-success">選択した友だちに共有</button>
            </div>
        </div>
    </div>
</div>

{{-- 概要タブから契約書一覧タブへ切り替える --}}
<script>
    document.getElementById('show-documents-tab')?.addEventListener('click', function () {
        bootstrap.Tab.getOrCreateInstance(
            document.getElementById('documents-tab')
        ).show();
    });

    const shareModal = document.getElementById('shareModal');
    shareModal?.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const title = button?.getAttribute('data-document-title') ?? '';
        document.getElementById('shareModalLabel').textContent = `「${title}」を共有`;
        shareModal.querySelectorAll('input[type="checkbox"]').forEach((checkbox) => {
            checkbox.checked = false;
        });
        const searchInput = shareModal.querySelector('.friend-search');
        if (searchInput) {
            searchInput.value = '';
            shareModal.querySelectorAll('.friend-item').forEach((item) => item.hidden = false);
        }
    });

    // 共有モーダル内の友だち検索
    document.querySelectorAll('.friend-search').forEach(function (searchInput) {
        searchInput.addEventListener('input', function () {
            const keyword = this.value.trim().toLowerCase();
            const modal = this.closest('.modal');

            modal.querySelectorAll('.friend-item').forEach(function (item) {
                item.hidden = !item.textContent.toLowerCase().includes(keyword);
            });
        });
    });
</script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
