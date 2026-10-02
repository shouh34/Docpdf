<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>書類作成 - Contract Maker</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- アプリケーションCSS（asset()を使う） -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>


    <!-- ==================================================
         ヘッダー
    ================================================== -->

    <header class="header">

    </header>


    <!-- ==================================================
         メイン
    ================================================== -->

    <main class="container">


        <!-- ==================================================
             左：入力フォーム
        ================================================== -->

        <section class="input-panel">

            <h2 id="inputPanelTitle">
                書類情報
            </h2>

            <!-- ==================================================
         ▼ デザイン文字・パーツ検索エリア追加
    ================================================== -->
            <div class="form-group design-search-group"
                style="margin-bottom: 20px; background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                <label for="designSearchInput"
                    style="font-weight: bold; margin-bottom: 6px; display: block; font-size: 13px; color: #475569;">
                    🔍 デザイン文字・パーツ検索
                </label>
                <div style="display: flex; gap: 8px;">
                    <input type="text" id="designSearchInput" placeholder="例: タイトル、見出し、枠線..."
                        style="flex: 1; padding: 6px 10px; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 14px;">
                    <button type="button" id="designSearchBtn"
                        style="padding: 6px 12px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 13px;">検索</button>
                </div>
                <!-- 検索結果や候補を表示するエリア -->
                <div id="designSearchResults"
                    style="margin-top: 8px; display: none; font-size: 13px; max-height: 120px; overflow-y: auto; background: #fff; border: 1px solid #cbd5e1; border-radius: 4px; padding: 6px;">
                    <!-- 検索ヒットした項目がここに並びます -->
                </div>
            </div>
            <!-- ================================================== -->

            <!-- 書類種類プルダウンへ続く... -->
            <div class="form-group">
                <label for="documentType">
                    書類種類
                </label>


                <form method="POST" action="{{ route('documents.store') }}" class="d-inline" id="documentForm">
                    @csrf

                    <!-- 書類種類 -->
                    <select id="documentType" name="document_type" class="form-select">
                        <option value="contract">契約書</option>
                        <option value="invoice">請求書</option>
                        <option value="order">注文書</option>
                        <option value="quotation" selected>見積書</option>
                        <option value="delivery">納品書</option>
                        <option value="receipt">領収書</option>
                    </select>


                    <!-- タイトル -->
                    <input type="text" id="titleInput" name="title" value="業務委託契約書">


                    <!-- 契約日 -->
                    <input type="date" id="contractDate" name="contract_date">


                    <!-- 委託者 -->
                    <input type="text" id="client" name="client_name" placeholder="株式会社○○">


                    <!-- 受託者 -->
                    <input type="text" id="contractor" name="contractor_name" placeholder="山田太郎">


                    <!-- 契約開始日 -->
                    <input type="date" id="startDate" name="start_date">


                    <!-- 契約終了日 -->
                    <input type="date" id="endDate" name="end_date">


                    <!-- 報酬 -->
                    <input type="number" id="amount" name="amount" placeholder="100000">


                    <!-- 業務内容 -->
                    <textarea id="content" name="business_content" placeholder="業務内容を入力してください"></textarea>


                    <!-- 支払条件 -->
                    <textarea id="payment" name="payment" placeholder="毎月末締め、翌月末払い"></textarea>


                    <!-- 備考 -->
                    <textarea id="notes" name="notes" placeholder="その他の事項"></textarea>


                    <!-- 書類番号 -->
                    <input type="text" id="documentNumber" name="document_number" placeholder="DOC-0001">


                    <!-- 右側のデザイン情報 -->
                    <input type="hidden" name="content" id="documentContent">

            </div>


            <!-- ==================================================
     ボタン
================================================== -->
            <div class="button-area">
                <button type="submit" class="save-button" id="saveButton">
                    保存
                </button>
                </form>

                <button type="button" class="pdf-button" id="pdfButton">
                    PDF作成
                </button>

            </div>
        </section>


        <!-- ==================================================
             右：プレビュー
        ================================================== -->

        <section class="preview-panel">


            <!-- プレビューヘッダー -->

            <div class="preview-header">

                <h2>
                    プレビュー
                </h2>


                <div class="zoom-control">

                    <button type="button" id="zoomOut">
                        −
                    </button>

                    <span id="zoomValue">
                        100%
                    </span>

                    <button type="button" id="zoomIn">
                        ＋
                    </button>

                </div>

            </div>


            <!-- ==================================================
                 編集ツールバー
            ================================================== -->

            <div class="editor-toolbar">


                <!-- ファイル -->

                <div class="toolbar-section">

                    <span class="toolbar-section-title">
                        ファイル
                    </span>

                    <button type="button" id="loadFileButton" class="toolbar-button" title="ファイルを読み込む">
                        📁 読み込み
                    </button>

                    <input type="file" id="fileInput" accept=".json" hidden>

                </div>


                <div class="toolbar-separator"></div>


                <!-- スタイル -->

                <div class="toolbar-section">

                    <span class="toolbar-section-title">
                        スタイル
                    </span>

                    <select id="textStyle" class="toolbar-select" title="文字スタイル">

                        <option value="normal">
                            標準
                        </option>

                        <option value="title">
                            タイトル
                        </option>

                        <option value="heading1">
                            見出し 1
                        </option>

                        <option value="heading2">
                            見出し 2
                        </option>

                        <option value="quote">
                            引用
                        </option>

                    </select>

                </div>


                <!-- フォント -->

                <div class="toolbar-section">

                    <span class="toolbar-section-title">
                        フォント
                    </span>

                    <select id="fontFamily" class="toolbar-select" title="フォント">

                        <option value="sans-serif">
                            Sans Serif
                        </option>

                        <option value="'Hiragino Kaku Gothic ProN', sans-serif">
                            ヒラギノ角ゴシック
                        </option>

                        <option value="'Hiragino Mincho ProN', serif">
                            ヒラギノ明朝
                        </option>

                        <option value="'Yu Gothic', sans-serif">
                            游ゴシック
                        </option>

                        <option value="'Yu Mincho', serif">
                            游明朝
                        </option>

                        <option value="Arial">
                            Arial
                        </option>

                        <option value="Helvetica">
                            Helvetica
                        </option>

                        <option value="'Times New Roman'">
                            Times New Roman
                        </option>

                        <option value="Georgia">
                            Georgia
                        </option>

                        <option value="'Courier New'">
                            Courier New
                        </option>

                    </select>

                </div>


                <!-- サイズ -->

                <div class="toolbar-section">

                    <span class="toolbar-section-title">
                        サイズ
                    </span>

                    <select id="fontSize" class="toolbar-select">

                        <option value="12px">
                            12
                        </option>

                        <option value="14px">
                            14
                        </option>

                        <option value="16px" selected>
                            16
                        </option>

                        <option value="18px">
                            18
                        </option>

                        <option value="20px">
                            20
                        </option>

                        <option value="22px">
                            22
                        </option>

                        <option value="24px">
                            24
                        </option>

                        <option value="26px">
                            26
                        </option>

                        <option value="28px">
                            28
                        </option>

                        <option value="30px">
                            30
                        </option>

                        <option value="32px">
                            32
                        </option>

                        <option value="36px">
                            36
                        </option>

                        <option value="40px">
                            40
                        </option>

                        <option value="48px">
                            48
                        </option>

                        <option value="60px">
                            60
                        </option>

                    </select>

                </div>


                <div class="toolbar-separator"></div>


                <!-- 文字装飾 -->

                <div class="toolbar-buttons">

                    <button type="button" id="boldButton" class="toolbar-format-button" title="太字">
                        <strong>B</strong>
                    </button>


                    <button type="button" id="italicButton" class="toolbar-format-button" title="斜体">
                        <em>I</em>
                    </button>


                    <button type="button" id="underlineButton" class="toolbar-format-button" title="下線">
                        <u>U</u>
                    </button>


                    <button type="button" id="strikeButton" class="toolbar-format-button" title="取り消し線">
                        <s>S</s>
                    </button>

                </div>


                <!-- 文字色 -->

                <div class="toolbar-group">

                    <label for="textColor">
                        文字色
                    </label>

                    <input type="color" id="textColor" value="#000000">

                </div>


                <!-- 背景色 -->

                <div class="toolbar-group">

                    <label for="textBackgroundColor">
                        背景
                    </label>

                    <input type="color" id="textBackgroundColor" value="#ffffff">

                </div>


                <div class="toolbar-separator"></div>


                <!-- 配置 -->

                <div class="toolbar-group">

                    <label for="textAlign">
                        配置
                    </label>

                    <select id="textAlign" class="toolbar-select">

                        <option value="left">
                            左
                        </option>

                        <option value="center">
                            中央
                        </option>

                        <option value="right">
                            右
                        </option>

                    </select>

                </div>


                <!-- 挿入 -->

                <div class="toolbar-section">

                    <span class="toolbar-section-title">
                        挿入
                    </span>

                    <button type="button" id="addLineButton" class="toolbar-button" title="罫線を追加">
                        ━ 罫線
                    </button>

                </div>


                <div class="toolbar-separator"></div>


                <!-- Undo -->

                <button type="button" class="toolbar-icon-button" id="undoButton" title="元に戻す">
                    ↶
                </button>


                <!-- Redo -->

                <button type="button" class="toolbar-icon-button" id="redoButton" title="やり直す">
                    ↷
                </button>


                <!-- 削除 -->

                <button type="button" class="toolbar-icon-button delete-button" id="deleteElementButton"
                    title="選択した要素を削除">
                    🗑
                </button>


            </div>


            <!-- ==================================================
                 プレビューエリア
            ================================================== -->

            <div class="preview-area">

                <div class="paper" id="paper">


                    <!-- 赤い縦線 -->

                    <div class="red-line"></div>


                    <!-- ==================================================
                         タイトル
                    ================================================== -->

                    <div class="draggable-element preview-title" data-element="title">

                        <div id="previewTitle">
                            業務委託契約書
                        </div>

                        <div id="previewCompany">
                            株式会社○○
                        </div>

                    </div>


                    <!-- ==================================================
                         書類番号
                    ================================================== -->

                    <div class="draggable-element preview-number" data-element="documentNumber">

                        書類番号：

                        <span id="previewDocumentNumber">
                            DOC-0001
                        </span>

                    </div>


                    <!-- ==================================================
                         日付
                    ================================================== -->

                    <div class="draggable-element preview-date" data-element="contractDate">

                        <span id="previewDateLabel">
                            契約日
                        </span>

                        ：

                        <span id="previewContractDate"></span>

                    </div>


                    <!-- ==================================================
                         相手先
                    ================================================== -->

                    <div class="draggable-element preview-info" data-element="contractInfo">

                        <p>

                            <span id="previewClientLabel">
                                委託者
                            </span>

                            ：

                            <span id="previewClient">
                                株式会社○○
                            </span>

                        </p>


                        <p>

                            <span id="previewContractorLabel">
                                受託者
                            </span>

                            ：

                            <span id="previewContractor">
                                山田太郎
                            </span>

                        </p>

                    </div>


                    <!-- ==================================================
                         第1条
                    ================================================== -->

                    <div class="draggable-element clause" data-element="clause1">

                        <h3 id="previewClause1Title">
                            第1条（業務内容）
                        </h3>

                        <p id="previewContent">
                            業務内容を入力してください。
                        </p>

                    </div>


                    <!-- ==================================================
                         第2条
                    ================================================== -->

                    <div class="draggable-element clause" data-element="clause2" id="contractClause">

                        <h3>
                            第2条（契約期間）
                        </h3>

                        <p>

                            本契約の期間は、

                            <span id="previewStartDate">
                                2026年10月1日
                            </span>

                            から

                            <span id="previewEndDate">
                                2027年9月30日
                            </span>

                            までとする。

                        </p>

                    </div>


                    <!-- ==================================================
                         第3条
                    ================================================== -->

                    <div class="draggable-element clause" data-element="clause3">

                        <h3 id="previewClause3Title">
                            第3条（報酬）
                        </h3>

                        <p>

                            <span id="previewAmountText">
                                委託者は受託者に対し、
                            </span>

                            <span id="previewAmount">
                                100,000
                            </span>

                            円を支払うものとする。

                        </p>

                    </div>


                    <!-- ==================================================
                         支払条件
                    ================================================== -->

                    <div class="draggable-element clause" data-element="payment">

                        <h3 id="previewPaymentTitle">
                            支払条件
                        </h3>

                        <p id="previewPayment">
                            毎月末締め、翌月末払い
                        </p>

                    </div>


                    <!-- ==================================================
                         備考
                    ================================================== -->

                    <div class="draggable-element clause" data-element="notes">

                        <h3>
                            備考
                        </h3>

                        <p id="previewNotes"></p>

                    </div>


                    <!-- ==================================================
                         支払期限
                    ================================================== -->

                    <div class="draggable-element clause" data-element="dueDate" id="previewDueDateArea"
                        style="display:none;">

                        <h3>
                            支払期限
                        </h3>

                        <p id="previewDueDate"></p>

                    </div>


                    <!-- ==================================================
                         明細
                    ================================================== -->

                    <div class="draggable-element document-detail" data-element="detail" id="documentDetailArea"
                        style="display:none;">

                        <h3 id="previewDetailTitle">
                            明細
                        </h3>


                        <div class="detail-table" id="detailTable">


                            <!-- 明細ヘッダー -->

                            <div class="detail-row detail-header">

                                <span>
                                    内容
                                </span>

                                <span>
                                    数量
                                </span>

                                <span>
                                    単価
                                </span>

                                <span>
                                    金額
                                </span>

                            </div>


                            <!-- 明細1行目 -->

                            <div class="detail-row detail-data-row">

                                <span class="detail-content">
                                    サービス
                                </span>

                                <span class="detail-quantity">
                                    1
                                </span>

                                <span class="detail-unit-price">
                                    100,000
                                </span>

                                <span class="detail-amount">
                                    100,000
                                </span>

                            </div>


                        </div>

                    </div>


                    <!-- ==================================================
                         合計金額
                         ※ 明細の外に配置
                         ※ 独立したドラッグ要素
                    ================================================== -->

                    <div class="draggable-element total-area" data-element="total" id="previewTotalArea"
                        style="display:none;">

                        <p>

                            小計：

                            <span id="previewSubtotal">
                                100,000
                            </span>

                            円

                        </p>


                        <p>

                            消費税：

                            <span id="previewTax">
                                10,000
                            </span>

                            円

                        </p>


                        <p class="total-price">

                            合計：

                            <span id="previewTotal">
                                110,000
                            </span>

                            円

                        </p>

                    </div>


                    <!-- ==================================================
                         署名
                    ================================================== -->

                    <div class="draggable-element signature" data-element="signature" id="signatureArea">

                        <div>

                            <p>
                                委託者
                            </p>

                            <p>

                                <span id="previewClient2">
                                    株式会社○○
                                </span>

                                印

                            </p>

                        </div>


                        <div>

                            <p>
                                受託者
                            </p>

                            <p>

                                <span id="previewContractor2">
                                    山田太郎
                                </span>

                                印

                            </p>

                        </div>

                    </div>


                </div>

            </div>

        </section>

    </main>



    <!-- ==================================================
         jQuery
    ================================================== -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    <!-- ==================================================
         html2canvas
    ================================================== -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


    <!-- ==================================================
         jsPDF
    ================================================== -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


    <!-- ==================================================
         Bootstrap
    ================================================== -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- ==================================================
         アプリケーション
    ================================================== -->
    <script src="{{ asset('js/input.js') }}"></script>
</body>
<!-- ==================================================
     明細行・罫線用コンテキストメニュー（右クリックメニュー）
================================================== -->

<div id="detailContextMenu" class="detail-context-menu" style="display: none; position: fixed;">

    <!-- 明細エリアを右クリックしたときに出るメニュー -->
    <div id="detailMenuActions">
        <button type="button" id="addDetailRow" class="context-menu-item">
            ＋ 行を追加
        </button>
        <button type="button" id="deleteDetailRow" class="context-menu-item delete-action">
            🗑 行を削除
        </button>
    </div>

    <!-- 罫線（line-element）を右クリックしたときに出るメニュー -->
    <div id="lineMenuActions" style="display: none;">
        <button type="button" id="deleteLineElement" class="context-menu-item delete-action">
            🗑 罫線を削除
        </button>
    </div>
</div>


</body>

</html>
