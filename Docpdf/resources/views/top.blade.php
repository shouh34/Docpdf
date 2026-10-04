<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Contract Maker</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- ヘッダー -->
    <nav class="navbar navbar-expand-lg bg-white border-bottom">
        <div class="container">

            <a class="navbar-brand fw-bold" href="index.html">
                Contract Maker
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">

                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link" href="#features">
                            特徴
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#howto">
                            使い方
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#login">
                            ログイン
                        </a>
                    </li>

                    <li class="nav-item ms-lg-2">
                        <!-- トップページの新規登録リンクの例 -->
                        <a class="nav-link" href="{{ route('register') }}">
                            新規登録
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>


    <!-- ヒーロー -->
    <section class="py-5 bg-light">

        <div class="container">

            <div class="row align-items-center g-5">

                <!-- 左 -->
                <div class="col-lg-6">

                    <span class="badge text-bg-primary mb-3">
                        Contract Maker
                    </span>

                    <h1 class="display-4 fw-bold">
                        契約書を、<br>
                        かんたんに作成。
                    </h1>

                    <p class="lead text-secondary mt-4">
                        ブラウザ上で契約書を作成し、
                        そのままPDFとして保存できます。
                    </p>

                    <div class="mt-4">

                        <a href="{{ route('Docu.Gene') }}" class="btn btn-primary btn-lg me-2">
                            契約書を作成する
                        </a>

                        <a href="#howto" class="btn btn-outline-secondary btn-lg">
                            使い方を見る
                        </a>

                    </div>

                </div>


                <!-- 右：ログインフォーム -->
                <div class="col-lg-6" id="login">

                    <div class="card shadow border-0 mx-auto" style="max-width: 460px;">

                        <div class="card-body p-4 p-md-5">

                            <h2 class="h3 fw-bold text-center mb-2">ログイン</h2>
                            <p class="text-secondary text-center mb-4">アカウントにログインしてください。</p>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">メールアドレス</label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                                        autocomplete="email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">パスワード</label>
                                    <input type="password" class="form-control form-control-lg" id="password" name="password"
                                        autocomplete="current-password" required>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                        <label class="form-check-label" for="remember">ログイン状態を保持</label>
                                    </div>
                                    <a href="#" class="small">パスワードをお忘れですか？</a>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg w-100">ログイン</button>
                            </form>

                            <p class="text-center text-secondary mt-4 mb-0">
                                アカウントをお持ちでない方は
                                <a href="{{ route('register') }}">新規登録</a>
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- 特徴 -->
    <section id="features" class="py-5">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="fw-bold">
                    かんたん3つの特徴
                </h2>

                <p class="text-secondary">
                    契約書作成をシンプルに
                </p>

            </div>


            <div class="row g-4">

                <div class="col-md-4">

                    <div class="card h-100 border-0 shadow-sm">

                        <div class="card-body p-4">

                            <h3 class="h5 fw-bold">
                                📝 かんたん編集
                            </h3>

                            <p class="text-secondary">
                                ブラウザ上で契約書の内容を
                                直感的に編集できます。
                            </p>

                        </div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="card h-100 border-0 shadow-sm">

                        <div class="card-body p-4">

                            <h3 class="h5 fw-bold">
                                📄 PDF保存
                            </h3>

                            <p class="text-secondary">
                                作成した契約書をPDFとして
                                保存できます。
                            </p>

                        </div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="card h-100 border-0 shadow-sm">

                        <div class="card-body p-4">

                            <h3 class="h5 fw-bold">
                                💾 データ保存
                            </h3>

                            <p class="text-secondary">
                                PHPとデータベースを使って
                                作成した契約書を保存できます。
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- 使い方 -->
    <section id="howto" class="py-5 bg-light">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="fw-bold">
                    使い方
                </h2>

            </div>


            <div class="row g-4">

                <div class="col-md-4">

                    <div class="text-center">

                        <div class="display-5 fw-bold text-primary">
                            1
                        </div>

                        <h3 class="h5 mt-3">

                            <a href="{{ route('Docu.Gene') }}" class="text-decoration-none">
                                契約書を作成
                            </a>
                        </h3>

                        <p class="text-secondary">
                            必要な項目を入力します。
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="text-center">

                        <div class="display-5 fw-bold text-primary">
                            2
                        </div>

                        <h3 class="h5 mt-3">
                            プレビュー
                        </h3>

                        <p class="text-secondary">
                            A4サイズで完成イメージを確認します。
                        </p>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="text-center">

                        <div class="display-5 fw-bold text-primary">
                            3
                        </div>

                        <h3 class="h5 mt-3">
                            PDF保存
                        </h3>

                        <p class="text-secondary">
                            完成した契約書をPDFにします。
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- CTA -->
    <section class="py-5">

        <div class="container text-center">

            <h2 class="fw-bold">
                契約書を作ってみませんか？
            </h2>

            <p class="text-secondary mt-3">
                ブラウザからすぐに作成できます。
            </p>

            <a href="{{ route('Docu.Gene') }}" class="btn btn-primary btn-lg">
                契約書を作成
            </a>

        </div>

    </section>


    <!-- フッター -->
    <footer class="border-top py-4">

        <div class="container text-center">

            <small class="text-secondary">
                © 2026 Contract Maker
            </small>

        </div>

    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
