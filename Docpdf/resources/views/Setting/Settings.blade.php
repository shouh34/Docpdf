<!DOCTYPE html>
<html lang="ja">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>設定 - Contract Maker</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


        <style>
            body {
                background: #f5f7fa;
                color: #212529;
            }


            .settings-wrapper {

                max-width: 1100px;

                margin: 50px auto;

                padding: 0 20px;

            }


            .page-header {

                margin-bottom: 25px;

            }


            .page-header h2 {

                font-weight: 700;

                margin-bottom: 8px;

            }


            .page-header p {

                color: #6c757d;

                margin-bottom: 0;

            }


            .settings-card {

                background: #fff;

                border-radius: 16px;

                border: none;

                box-shadow:
                    0 4px 20px rgba(0, 0, 0, 0.06);

                overflow: hidden;

            }


            /* =========================
           左メニュー
        ========================= */

            .settings-menu {

                background: #f8f9fa;

                min-height: 600px;

                padding: 20px;

            }


            .settings-menu-title {

                font-size: 13px;

                font-weight: 700;

                color: #6c757d;

                margin-bottom: 10px;

            }


            .settings-menu .nav-link {

                color: #495057;

                padding: 12px 14px;

                border-radius: 8px;

                margin-bottom: 5px;

                font-weight: 500;

            }


            .settings-menu .nav-link:hover {

                background: #e9ecef;

            }


            .settings-menu .nav-link.active {

                background: #0d6efd;

                color: #fff;

            }


            /* =========================
           本文
        ========================= */

            .settings-content {

                padding: 35px;

            }


            .settings-title {

                font-size: 22px;

                font-weight: 700;

                margin-bottom: 5px;

            }


            .settings-description {

                color: #6c757d;

                font-size: 14px;

                margin-bottom: 30px;

            }


            .setting-section {

                margin-bottom: 30px;

            }


            .setting-label {

                font-weight: 600;

                margin-bottom: 8px;

            }


            .setting-description {

                font-size: 13px;

                color: #6c757d;

                margin-top: 5px;

            }


            .form-control,
            .form-select {

                border-radius: 8px;

                padding: 10px 12px;

            }


            .save-button {

                min-width: 130px;

                font-weight: 600;

                border-radius: 8px;

            }


            .setting-divider {

                margin: 30px 0;

                border-color: #edf0f2;

            }


            /* =========================
           スマホ
        ========================= */

            @media (max-width: 768px) {

                .settings-wrapper {

                    margin: 25px auto;

                    padding: 0 15px;

                }


                .settings-menu {

                    min-height: auto;

                    padding: 15px;

                }


                .settings-content {

                    padding: 25px 20px;

                }

            }
        </style>

    </head>


    <body>


        <div class="settings-wrapper">


            <!-- =========================
         ページタイトル
    ========================== -->

            <div class="page-header">

                <h2>
                    設定
                </h2>

                <p>
                    Contract Makerの各種設定を変更できます。
                </p>

            </div>


            <!-- =========================
         メッセージ
    ========================== -->

            @if (session('success'))
                <div class="alert alert-success">

                    {{ session('success') }}

                </div>
            @endif


            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach

                    </ul>

                </div>

            @endif

<div class="settings-card">
    <div class="row g-0">

        {{-- 左メニュー --}}
        <div class="col-md-3">
            <div class="settings-menu">
                <div class="settings-menu-title">SETTINGS</div>

                <nav class="nav flex-column" id="settings-tabs" role="tablist">
                    <button class="nav-link active text-start"
                            id="account-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#account"
                            type="button"
                            role="tab"
                            aria-controls="account"
                            aria-selected="true">
                        👤 アカウント設定
                    </button>

                    <button class="nav-link text-start"
                            id="editor-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#editor"
                            type="button"
                            role="tab"
                            aria-controls="editor"
                            aria-selected="false">
                        📝 エディタ
                    </button>

                    <button class="nav-link text-start"
                            id="document-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#document"
                            type="button"
                            role="tab"
                            aria-controls="document"
                            aria-selected="false">
                        📄 ドキュメント
                    </button>

                    <button class="nav-link text-start"
                            id="notification-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#notification"
                            type="button"
                            role="tab"
                            aria-controls="notification"
                            aria-selected="false">
                        🔔 通知
                    </button>

                    <button class="nav-link text-start"
                            id="security-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#security"
                            type="button"
                            role="tab"
                            aria-controls="security"
                            aria-selected="false">
                        🔐 セキュリティ
                    </button>

                    <button class="nav-link text-start"
                            id="data-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#data"
                            type="button"
                            role="tab"
                            aria-controls="data"
                            aria-selected="false">
                        💾 データ管理
                    </button>
                </nav>
            </div>
        </div>

        {{-- 右側：選択した設定だけ表示 --}}
        <div class="col-md-9">
            <div class="settings-content">
                <div class="tab-content">
<div class="tab-pane fade show active"
     id="account"
     role="tabpanel"
     aria-labelledby="account-tab">

    <div class="settings-title">アカウント設定</div>
    <div class="settings-description">
        プロフィール情報とログインパスワードを管理できます。
    </div>

    {{-- 現在のアカウント情報 --}}
    <div class="card border-0 bg-light mb-4">
        <div class="card-body">
            <div class="mb-2">
                <strong>名前：</strong>{{ Auth::user()->name }}
            </div>
            <div>
                <strong>メールアドレス：</strong>{{ Auth::user()->email }}
            </div>

            <a href="{{ route('profile.index') }}"
               class="btn btn-outline-primary btn-sm mt-3">
                プロフィール情報を編集
            </a>
        </div>
    </div>

    {{-- パスワード変更 --}}
    <h5 class="fw-bold mb-3">パスワード変更</h5>

    <form method="POST" action="{{ route('settings.password.update') }}">
        @csrf
        @method('PUT')

        <div class="setting-section">
            <label for="current_password" class="form-label setting-label">
                現在のパスワード
            </label>
            <input type="password"
                   name="current_password"
                   id="current_password"
                   class="form-control"
                   autocomplete="current-password"
                   required>
        </div>

        <div class="setting-section">
            <label for="password" class="form-label setting-label">
                新しいパスワード
            </label>
            <input type="password"
                   name="password"
                   id="password"
                   class="form-control"
                   autocomplete="new-password"
                   required>
        </div>

        <div class="setting-section">
            <label for="password_confirmation" class="form-label setting-label">
                新しいパスワード（確認）
            </label>
            <input type="password"
                   name="password_confirmation"
                   id="password_confirmation"
                   class="form-control"
                   autocomplete="new-password"
                   required>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary save-button">
                パスワードを変更
            </button>
        </div>
    </form>
</div>
            </div>
        </div>

    </div>
</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    </body>

</html>
