<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Contract Maker')</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>
            body {
                background: #f5f7fa;
                color: #212529;
            }

            .account-wrapper {
                max-width: 1000px;
                margin: 60px auto;
                padding: 0 20px;
            }

            .page-header {
                margin-bottom: 30px;
            }

            .page-header h2 {
                font-weight: 700;
                margin-bottom: 8px;
            }

            .page-header p {
                color: #6c757d;
                margin-bottom: 0;
            }

            .main-card {
                border: none;
                border-radius: 16px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
                overflow: hidden;
                background: #fff;
            }

            .card-header-custom {
                background: #fff;
                border-bottom: 1px solid #edf0f2;
                padding: 24px 28px;
            }

            .card-header-custom h4 {
                font-weight: 700;
                margin: 0;
            }

            .card-header-custom p {
                margin: 6px 0 0;
                color: #6c757d;
                font-size: 14px;
            }

            .card-body-custom {
                padding: 28px;
            }

            /* =========================
           プロフィール
        ========================= */

            .profile-section {
                text-align: center;
                padding: 10px 0 30px;
                margin-bottom: 28px;
                border-bottom: 1px solid #edf0f2;
            }

            .profile-image-wrapper {
                position: relative;
                display: inline-block;
            }

            .profile-image,
            .profile-placeholder {
                width: 120px;
                height: 120px;
                border-radius: 50%;
            }

            .profile-image {
                object-fit: cover;
                border: 4px solid #fff;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
            }

            .profile-placeholder {
                display: flex;
                align-items: center;
                justify-content: center;

                background: #0d6efd;
                color: #fff;

                font-size: 42px;
                font-weight: 700;

                border: 4px solid #fff;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
            }

            .profile-name {
                margin-top: 15px;
                margin-bottom: 3px;
                font-size: 20px;
                font-weight: 700;
            }

            .profile-email {
                color: #6c757d;
                font-size: 14px;
            }

            /* =========================
           画像変更ボタン
        ========================= */

            .image-upload-label {
                position: absolute;
                right: 0;
                bottom: 0;

                width: 38px;
                height: 38px;

                display: flex;
                align-items: center;
                justify-content: center;

                background: #0d6efd;
                color: #fff;

                border-radius: 50%;
                border: 3px solid #fff;

                cursor: pointer;
                font-size: 18px;

                transition: 0.2s;
            }

            .image-upload-label:hover {
                background: #0b5ed7;
                transform: scale(1.05);
            }

            #profile_image {
                display: none;
            }

            /* =========================
           アカウント情報
        ========================= */

            .info-item {
                background: #f8f9fa;
                border: 1px solid #eef0f2;
                border-radius: 12px;
                padding: 18px;
                height: 100%;
            }

            .info-label {
                display: block;
                color: #6c757d;
                font-size: 13px;
                margin-bottom: 8px;
            }

            .info-value {
                display: block;
                font-size: 16px;
                font-weight: 600;
                color: #212529;
                word-break: break-word;
            }

            .user-id {
                display: inline-block;
                background: #6c757d;
                color: #fff;
                padding: 5px 10px;
                border-radius: 6px;
                font-size: 13px;
                font-weight: 600;
            }

            .date-value {
                font-size: 14px;
            }

            /* =========================
           ドキュメント利用状況
        ========================= */

            .document-card {
                margin-top: 28px;
                padding: 22px;
                border-radius: 12px;
                background: #f0f7ff;
                border: 1px solid #cfe2ff;
            }

            .document-title {
                color: #0d6efd;
                font-weight: 700;
                font-size: 14px;
                margin-bottom: 5px;
            }

            .document-count {
                font-size: 28px;
                font-weight: 700;
            }

            .document-count span {
                font-size: 14px;
                color: #6c757d;
                font-weight: 400;
            }

            .create-button {
                padding: 10px 18px;
                font-weight: 600;
                border-radius: 8px;
            }

            /* =========================
           モーダル
        ========================= */

            .modal-content {
                border: none;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            }

            .modal-header {
                padding: 20px 24px;
                border-bottom: 1px solid #edf0f2;
            }

            .modal-title {
                font-weight: 700;
            }

            .modal-body {
                padding: 24px;
            }

            .modal-footer {
                padding: 16px 24px;
                border-top: 1px solid #edf0f2;
            }

            .modal .form-control {
                border-radius: 8px;
                padding: 10px 12px;
            }

            /* =========================
           スマホ
        ========================= */

            @media (max-width: 768px) {

                .account-wrapper {
                    margin: 30px auto;
                    padding: 0 15px;
                }

                .card-header-custom,
                .card-body-custom {
                    padding: 20px;
                }

                .document-card {
                    text-align: center;
                }

                .document-card .btn {
                    margin-top: 15px;
                    width: 100%;
                }
            }
        </style>
    </head>

    <body>
        <main class="account-wrapper">
            <!-- 成功メッセージ -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <!-- エラーメッセージ -->
            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- =========================
         メインカード
    ========================== -->

            <div class="main-card">

                <!-- ヘッダー -->
                <div class="card-header-custom">

                    <h4>Mypage</h4>

                    <p>
                        プロフィールやアカウント情報を管理できます。
                    </p>

                </div>


                <div class="card-body-custom">


                    <!-- =========================
                 プロフィール
            ========================== -->

                    <div class="profile-section">

                        <form action="{{ route('account.profile-image') }}" method="POST" enctype="multipart/form-data"
                            id="profileImageForm">

                            @csrf


                            <div class="profile-image-wrapper">

                                @if ($user->profile_image)
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="プロフィール画像"
                                        class="profile-image" id="profilePreview">
                                @else
                                    <div class="profile-placeholder" id="profilePlaceholder">

                                        {{ mb_substr($user->name, 0, 1) }}

                                    </div>

                                    <img src="" alt="プロフィール画像" class="profile-image d-none" id="profilePreview">
                                @endif


                                <!-- カメラボタン -->
                                <label for="profile_image" class="image-upload-label" title="プロフィール画像を変更">

                                    📷

                                </label>


                                <input type="file" name="profile_image" id="profile_image"
                                    accept="image/jpeg,image/png,image/webp">

                            </div>


                            <div class="profile-name">
                                {{ $user->name }}
                            </div>


                            <div class="profile-email">
                                {{ $user->email }}
                            </div>


                            <button type="submit" class="btn btn-primary mt-3">

                                プロフィール画像を変更

                            </button>

                        </form>

                    </div>


                    <!-- =========================
                 プロフィール情報
            ========================== -->

                    <div class="row g-3">


                        <!-- 名前 -->
                        <div class="col-md-6">

                            <div class="info-item">

                                <span class="info-label">
                                    お名前
                                </span>

                                <span class="info-value">
                                    {{ $user->name }}
                                </span>

                            </div>

                        </div>


                        <!-- メール -->
                        <div class="col-md-6">

                            <div class="info-item">

                                <span class="info-label">
                                    メールアドレス
                                </span>

                                <span class="info-value">
                                    {{ $user->email }}
                                </span>

                            </div>

                        </div>

                    </div>


                    <!-- 編集ボタン -->

                    <div class="text-end mt-3">

                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#profileEditModal">

                            プロフィール情報を編集

                        </button>

                    </div>
{{-- ユーザーID --}}
<div class="info-item mb-4">
    <span class="info-label">ユーザーID</span>
    <span class="user-id">No.{{ $user->id }}</span>
</div>

{{-- タブメニュー --}}
<ul class="nav nav-tabs" id="account-tabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active"
                id="friends-tab"
                data-bs-toggle="tab"
                data-bs-target="#friends-pane"
                type="button"
                role="tab"
                aria-controls="friends-pane"
                aria-selected="true">
            友達一覧
        </button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link"
                id="account-tab"
                data-bs-toggle="tab"
                data-bs-target="#account-pane"
                type="button"
                role="tab"
                aria-controls="account-pane"
                aria-selected="false">
            アカウント情報
        </button>
    </li>
</ul>

{{-- タブ内容 --}}
<div class="tab-content border border-top-0 bg-white p-3 p-md-4"
     id="account-tabs-content">

    {{-- 友達一覧 --}}
    <div class="tab-pane fade show active"
         id="friends-pane"
         role="tabpanel"
         aria-labelledby="friends-tab">

        <h5 class="fw-bold mb-3">承認済みの友達</h5>

        @forelse ($friends as $friend)
            <div class="d-flex align-items-center justify-content-between gap-3 border-bottom py-3">
                <div class="d-flex align-items-center gap-3">
                    @if ($friend->profile_image)
                        <img src="{{ asset('storage/' . $friend->profile_image) }}"
                             alt="{{ $friend->name }}のプロフィール画像"
                             class="rounded-circle"
                             width="44"
                             height="44"
                             style="object-fit: cover;">
                    @else
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                             style="width: 44px; height: 44px;">
                            {{ mb_substr($friend->name, 0, 1) }}
                        </div>
                    @endif

                    <div>
                        <div class="fw-semibold">{{ $friend->name }}</div>
                        <small class="text-secondary">{{ $friend->email }}</small>
                    </div>
                </div>

                <a href="{{ route('friends.documents.index', $friend) }}"
                   class="btn btn-sm btn-outline-primary flex-shrink-0">
                    ドキュメントを見る
                </a>
            </div>
        @empty
            <p class="text-secondary mb-0">友達はまだ登録されていません。</p>
        @endforelse
    </div>

    {{-- アカウント情報 --}}
    <div class="tab-pane fade"
         id="account-pane"
         role="tabpanel"
         aria-labelledby="account-tab">

        <div class="row g-3">
            <div class="col-md-6">
                <div class="info-item">
                    <span class="info-label">アカウント登録日</span>
                    <span class="info-value date-value">
                        {{ $user->created_at->format('Y年m月d日 H:i') }}
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-item">
                    <span class="info-label">最終更新</span>
                    <span class="info-value date-value">
                        {{ $user->updated_at->format('Y年m月d日 H:i') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>

    {{-- ドキュメント利用状況 --}}
    <div class="tab-pane fade"
         id="documents-pane"
         role="tabpanel"
         aria-labelledby="documents-tab">

        <div class="document-card mt-0">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="document-title">ドキュメント作成数</div>

                    <div class="document-count">
                        {{ $user->documents_count ?? 0 }}
                        <span>件</span>
                    </div>

                    <small class="text-secondary">
                        これまでに作成したドキュメントの数です。
                    </small>
                </div>

                <div class="col-md-4 text-md-end">
                    <a href="{{ route('Docu.Gene') }}"
                       class="btn btn-primary create-button">
                        ＋ 新規作成
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
        </main>


        <!-- =====================================================
     プロフィール編集モーダル
===================================================== -->

        <div class="modal fade" id="profileEditModal" tabindex="-1" aria-labelledby="profileEditModalLabel"
            aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">


                    <!-- モーダルヘッダー -->

                    <div class="modal-header">

                        <h5 class="modal-title" id="profileEditModalLabel">

                            プロフィール情報を編集

                        </h5>


                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる">
                        </button>

                    </div>


                    <!-- フォーム -->

                    <form action="{{ route('account.profile.update') }}" method="POST">

                        @csrf
                        @method('PUT')


                        <!-- モーダル本文 -->

                        <div class="modal-body">


                            <!-- 名前 -->

                            <div class="mb-3">

                                <label for="modal_name" class="form-label fw-semibold">

                                    お名前

                                </label>

                                <input type="text" name="name" id="modal_name" class="form-control"
                                    value="{{ old('name', $user->name) }}" maxlength="255" required>

                            </div>


                            <!-- メール -->

                            <div class="mb-3">

                                <label for="modal_email" class="form-label fw-semibold">

                                    メールアドレス

                                </label>

                                <input type="email" name="email" id="modal_email" class="form-control"
                                    value="{{ old('email', $user->email) }}" maxlength="255" required>

                            </div>

                        </div>


                        <!-- モーダルフッター -->

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                                キャンセル

                            </button>


                            <button type="submit" class="btn btn-primary">

                                変更を保存

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        <!-- Bootstrap -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


        <script>
            /*
             * プロフィール画像プレビュー
             */

            const profileImageInput =
                document.getElementById('profile_image');

            const profilePreview =
                document.getElementById('profilePreview');

            const profilePlaceholder =
                document.getElementById('profilePlaceholder');


            if (profileImageInput) {

                profileImageInput.addEventListener('change', function() {

                    const file = this.files[0];

                    if (!file) {
                        return;
                    }


                    if (!file.type.startsWith('image/')) {

                        alert('画像ファイルを選択してください。');

                        this.value = '';

                        return;
                    }


                    if (file.size > 2 * 1024 * 1024) {

                        alert('画像サイズは2MB以下にしてください。');

                        this.value = '';

                        return;
                    }


                    const reader = new FileReader();


                    reader.onload = function(event) {

                        if (profilePreview) {

                            profilePreview.src =
                                event.target.result;

                            profilePreview.classList.remove('d-none');

                        }


                        if (profilePlaceholder) {

                            profilePlaceholder.classList.add('d-none');

                        }

                    };


                    reader.readAsDataURL(file);

                });

            }
        </script>

    </body>

</html>
