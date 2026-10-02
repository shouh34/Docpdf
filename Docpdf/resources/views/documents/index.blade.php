<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ドキュメント一覧</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>

        <div class="container py-5">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h1 class="fw-bold mb-1">
                        ドキュメント
                    </h1>

                    <p class="text-muted mb-0">
                        作成したドキュメントを管理できます。
                    </p>
                </div>

                <a href="{{ route('Docu.Gene') }}" class="text-decoration-none">
                    契約書を作成
                </a>

            </div>


            {{-- 検索フォーム --}}
            <form action="{{ route('documents.index') }}" method="GET" class="mb-4">

                <div class="input-group">

                    <input type="text" name="keyword" value="{{ $keyword }}" class="form-control"
                        placeholder="ドキュメントを検索...">

                    <button type="submit" class="btn btn-primary">
                        検索
                    </button>

                </div>

            </form>


            {{-- 検索結果 --}}
            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    @if ($documents->count() > 0)
                        @foreach ($documents as $document)
                            <div class="border-bottom py-3">

                                <div class="d-flex align-items-center justify-content-between">

                                    {{-- 左側：書類情報 --}}
                                    <div class="flex-grow-1">

                                        <h5 class="mb-1">
                                            {{ $document->title }}
                                        </h5>

                                        <small class="text-muted">
                                            {{ $document->document_type }}
                                        </small>

                                    </div>

                                    {{-- 右側：更新日時・編集 --}}
                                    <div class="d-flex align-items-center gap-3">

                                        <span class="text-muted small">
                                            更新日 {{ $document->updated_at->format('Y/m/d H:i') }}
                                        </span>


                                        <span class="text-muted small">
                                            作成日 {{ $document->created_at->format('Y/m/d H:i') }}
                                        </span>

                                    </div>
                                    <br>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        編集
                                    </a>

                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">

                            <p class="text-muted mb-0">
                                ドキュメントが見つかりませんでした。
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- ページネーション --}}
            <div class="mt-4">

                {{ $documents->links() }}

            </div>

        </div>

    </body>

</html>
