// ============================================================
// Contract Maker - input.js
// jQuery Version
// ============================================================

$(function () {

    // ========================================================
    // 入力フォーム
    // ========================================================

    const $documentType = $("#documentType");
    const $titleInput = $("#titleInput");
    const $contractDate = $("#contractDate");
    const $client = $("#client");
    const $contractor = $("#contractor");
    const $startDate = $("#startDate");
    const $endDate = $("#endDate");
    const $amount = $("#amount");
    const $content = $("#content");
    const $payment = $("#payment");
    const $notes = $("#notes");
    const $documentNumber = $("#documentNumber");
    const $dueDate = $("#dueDate");


    // ========================================================
    // プレビュー
    // ========================================================

    const $previewTitle = $("#previewTitle");
    const $previewCompany = $("#previewCompany");
    const $previewDocumentNumber = $("#previewDocumentNumber");
    const $previewDateLabel = $("#previewDateLabel");
    const $previewContractDate = $("#previewContractDate");
    const $previewClientLabel = $("#previewClientLabel");
    const $previewClient = $("#previewClient");
    const $previewContractorLabel = $("#previewContractorLabel");
    const $previewContractor = $("#previewContractor");

    const $previewClause1Title = $("#previewClause1Title");
    const $previewContent = $("#previewContent");
    const $previewStartDate = $("#previewStartDate");
    const $previewEndDate = $("#previewEndDate");
    const $previewClause3Title = $("#previewClause3Title");
    const $previewAmountText = $("#previewAmountText");
    const $previewAmount = $("#previewAmount");

    const $previewPaymentTitle = $("#previewPaymentTitle");
    const $previewPayment = $("#previewPayment");
    const $previewNotes = $("#previewNotes");

    const $previewDueDateArea = $("#previewDueDateArea");

    const $previewDetailTitle = $("#previewDetailTitle");
    const $previewDetailContent = $("#previewDetailContent");
    const $previewUnitPrice = $("#previewUnitPrice");
    const $previewDetailAmount = $("#previewDetailAmount");

    const $previewTotalArea = $("#previewTotalArea");
    const $previewSubtotal = $("#previewSubtotal");
    const $previewTax = $("#previewTax");
    const $previewTotal = $("#previewTotal");

    const $signatureArea = $("#signatureArea");
    const $previewClient2 = $("#previewClient2");
    const $previewContractor2 = $("#previewContractor2");


    // ========================================================
    // プレビュー各ブロック
    // ========================================================

    const $clause1 = $('[data-element="clause1"]');

    const $clause2 = $('[data-element="clause2"]');

    const $clause3 = $('[data-element="clause3"]');

    const $paymentArea = $('[data-element="payment"]');

    const $notesArea =
        $('[data-element="notes"]');

    const $contractInfo = $('[data-element="contractInfo"]');

    const $titleArea = $('[data-element="title"]');

    const $numberArea = $('[data-element="documentNumber"]');

    const $dateArea = $('[data-element="contractDate"]');

    const $detailArea = $('[data-element="detail"]');

    const $totalArea = $('[data-element="total"]');


    // ========================================================
    // 書類タイプ設定
    // ========================================================

    const documentSettings = {

        contract: {
            title: "契約書",
            clientLabel: "契約先",
            contractorLabel: "契約者",
            dateLabel: "契約日",
            clause1Title: "第1条 契約内容",
            clause3Title: "第3条 契約金額",
            amountText: "契約金額",
            paymentTitle: "支払方法",
            detailTitle: "契約内容"
        },

        invoice: {
            title: "請求書",
            clientLabel: "請求先",
            contractorLabel: "請求元",
            dateLabel: "請求日",
            clause1Title: "",
            clause3Title: "",
            amountText: "請求金額",
            paymentTitle: "",
            detailTitle: "請求明細"
        },

        order: {
            title: "注文書",
            clientLabel: "注文先",
            contractorLabel: "注文者",
            dateLabel: "注文日",
            clause1Title: "",
            clause3Title: "",
            amountText: "注文金額",
            paymentTitle: "",
            detailTitle: "注文内容"
        },

        quotation: {
            title: "見積書",
            clientLabel: "見積先",
            contractorLabel: "見積元",
            dateLabel: "見積日",
            clause1Title: "",
            clause3Title: "",
            amountText: "見積金額",
            paymentTitle: "",
            detailTitle: "見積明細"
        },

        delivery: {
            title: "納品書",
            clientLabel: "納品先",
            contractorLabel: "納品元",
            dateLabel: "納品日",
            clause1Title: "",
            clause3Title: "",
            amountText: "",
            paymentTitle: "",
            detailTitle: "納品明細"
        },

        receipt: {
            title: "領収書",
            clientLabel: "宛名",
            contractorLabel: "発行者",
            dateLabel: "領収日",
            clause1Title: "",
            clause3Title: "",
            amountText: "領収金額",
            paymentTitle: "",
            detailTitle: "領収内容"
        }
    };


    // ========================================================
    // 要素表示・非表示
    // ========================================================

    function showElement($element) {

        if ($element && $element.length) {
            $element.show();
        }
    }


    function hideElement($element) {

        if ($element && $element.length) {
            $element.hide();
        }
    }


    // ========================================================
    // 要素位置設定
    // ========================================================

    function setPosition($element, left, top, width = null) {

        if (!$element || !$element.length) {
            return;
        }

        $element.css({
            position: "absolute",
            left: left + "px",
            top: top + "px",
            right: "auto",
            bottom: "auto",
            margin: "0"
        });

        if (width !== null) {

            $element.css(
                "width",
                width + "px"
            );
        }
    }


    // ========================================================
    // 各種レイアウト設定
    // ========================================================

    function applyContractLayout() {
        setPosition($titleArea, 120, 70, 550);
        setPosition($numberArea, 550, 175, 160);
        setPosition($dateArea, 520, 215, 190);
        setPosition($contractInfo, 100, 260, 590);
        setPosition($clause1, 100, 350, 590);
        setPosition($clause2, 100, 475, 590);
        setPosition($clause3, 100, 600, 590);
        setPosition($paymentArea, 100, 730, 590);
        setPosition($notesArea, 100, 835, 590);
        setPosition($signatureArea, 100, 950, 590);
    }

    function applyInvoiceLayout() {
        setPosition($titleArea, 120, 70, 550);
        setPosition($numberArea, 550, 175, 160);
        setPosition($dateArea, 520, 215, 190);
        setPosition($contractInfo, 100, 260, 590);
        setPosition($previewDueDateArea, 100, 325, 590);
        setPosition($detailArea, 100, 390, 590);
        setPosition($totalArea, 430, 700, 260);
    }

    function applyOrderLayout() {
        setPosition($titleArea, 120, 70, 550);
        setPosition($numberArea, 550, 175, 160);
        setPosition($dateArea, 520, 215, 190);
        setPosition($contractInfo, 100, 260, 590);
        setPosition($detailArea, 100, 350, 590);
        setPosition($totalArea, 430, 680, 260);
    }

    function applyReceiptLayout() {
        setPosition($titleArea, 120, 70, 550);
        setPosition($numberArea, 550, 175, 160);
        setPosition($dateArea, 520, 215, 190);
        setPosition($contractInfo, 100, 280, 590);
        setPosition($detailArea, 100, 370, 590);
        setPosition($totalArea, 430, 680, 260);
    }


    // ========================================================
    // 書類タイプ変更
    // ========================================================

    function changeDocumentType() {

        const type = $documentType.val();
        const settings = documentSettings[type] || documentSettings.contract;

        // 共通設定
        $previewTitle.text(settings.title);
        $previewClientLabel.text(settings.clientLabel); $previewContractorLabel.text(settings.contractorLabel);
        $previewDateLabel.text(settings.dateLabel); $previewClause1Title.text(settings.clause1Title);
        $previewClause3Title.text(settings.clause3Title); $previewAmountText.text(settings.amountText);
        $previewPaymentTitle.text(settings.paymentTitle); $previewDetailTitle.text(settings.detailTitle);

        // 一旦すべて非表示
        hideElement($clause1);
        hideElement($clause2);
        hideElement($clause3);
        hideElement($paymentArea);
        hideElement($notesArea);
        hideElement($signatureArea);
        hideElement($previewDueDateArea);
        hideElement($detailArea);
        hideElement($totalArea);

        // 書類ごとの表示切り替えとレイアウト
        if (type === "contract") {
            showElement($clause1);
            showElement($clause2);
            showElement($clause3);
            showElement($paymentArea);
            showElement($notesArea);
            showElement($signatureArea);
            applyContractLayout();
        } else if (type === "invoice" || type === "quotation") {
            showElement($previewDueDateArea);
            showElement($detailArea);
            showElement($totalArea);
            applyInvoiceLayout();
        } else if (type === "order" || type === "delivery") {
            showElement($detailArea);
            showElement($totalArea);
            applyOrderLayout();
        } else if (type === "receipt") {
            showElement($detailArea);
            showElement($totalArea);
            applyReceiptLayout();
        }

        // 入力フォーム側の表示切り替え
        $(".document-fields").hide();
        $("#" + type + "Fields").show();
        $("#titleInput").val(settings.title);

        updateDetailBorder(type);
        updatePreview();
    }


    // ========================================================
    // 金額取得 & プレビュー更新
    // ========================================================

    function getNumericAmount() {
        return Number(
            String($amount.val() || "").replace(/,/g, "").replace(/円/g, "")
        ) || 0;
    }
    function updatePreview() {
        const type = $documentType.val();
        const settings = documentSettings[type] || documentSettings.contract;

        $previewTitle.text($titleInput.val() || settings.title || "書類");
        $previewCompany.text($contractor.val() || "発行者");

        const number = $documentNumber.val();
        $previewDocumentNumber.text(number ? "No. " + number : "");

        $previewContractDate.text(formatDate($contractDate.val()));
        $previewClient.text($client.val() || "");
        $previewContractor.text($contractor.val() || "");
        $previewContent.text($content.val() || "");
        $previewStartDate.text(formatDate($startDate.val()));
        $previewEndDate.text(formatDate($endDate.val()));

        const numericAmount = getNumericAmount();
        const formattedAmount = numericAmount.toLocaleString("ja-JP") + "円";
        $previewAmount.text(formattedAmount);

        $previewPayment.text($payment.val() || "");
        $previewNotes.text($notes.val() || "");
        $("#previewDueDate").text(formatDate($dueDate.val()));

        updateDetailRows();

        if ($previewUnitPrice.length) {
            $previewUnitPrice.text(formattedAmount);
        }
        if ($previewDetailAmount.length) {
            $previewDetailAmount.text(formattedAmount);
        }

        // ========================================================
        // 明細表の全行の金額を合計して小計に反映させる
        // ========================================================
        let subtotal = 0;
        const $rows = $(".detail-data-row");

        if ($rows.length > 0) {
            $rows.each(function () {
                const $amountCell = $(this).find(".detail-amount");
                const rowAmount = Number(String($amountCell.text()).replace(/,/g, "").replace(/円/g, "")) || 0;
                subtotal += rowAmount;
            });
        } else {
            // 明細行がない場合は入力欄の金額を使用
            subtotal = numericAmount;
        }

        // 消費税と合計の計算 (税率10%の場合)
        const tax = Math.floor(subtotal * 0.1);
        const total = subtotal + tax;

        // 下部のエリアに反映
        $previewSubtotal.text(subtotal.toLocaleString("ja-JP") + "円");
        $previewTax.text(tax.toLocaleString("ja-JP") + "円");
        $previewTotal.text(total.toLocaleString("ja-JP") + "円");

        $previewClient2.text($client.val() || "");
        $previewContractor2.text($contractor.val() || "");
    }

    // ========================================================
    // 明細更新
    // ========================================================

    function updateDetailRows() {
        const $rows = $(".detail-data-row");
        if (!$rows.length) {
            return;
        }

        $rows.each(function () {
            const $row = $(this);
            const $contentCell = $row.find(".detail-content");
            const $quantityCell = $row.find(".detail-quantity");
            const $unitPriceCell = $row.find(".detail-unit-price");
            const $amountCell = $row.find(".detail-amount");

            if ($contentCell.length && !$contentCell.text().trim()) {
                $contentCell.text("内容");
            }
            if ($quantityCell.length && !$quantityCell.text().trim()) {
                $quantityCell.text("1");
            }
            if ($unitPriceCell.length && !$unitPriceCell.text().trim()) {
                $unitPriceCell.text("0");
            }
            if ($amountCell.length && !$amountCell.text().trim()) {
                $amountCell.text("0");
            }
        });
    }


    // ========================================================
    // 日付フォーマット & 今日の日付
    // ========================================================

    function formatDate(value) {
        if (!value) {
            return "";
        }
        const date = new Date(value);
        if (Number.isNaN(date.getTime())) {
            return "";
        }
        return (
            date.getFullYear() +
            "年" +
            String(date.getMonth() + 1).padStart(2, "0") +
            "月" +
            String(date.getDate()).padStart(2, "0") +
            "日"
        );
    }

    function setToday() {
        if (!$contractDate.length) {
            return;
        }
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, "0");
        const dd = String(today.getDate()).padStart(2, "0");
        $contractDate.val(`${yyyy}-${mm}-${dd}`);
    }


    // ========================================================
    // ズーム機能
    // ========================================================

    let zoom = 1;
    const $zoomValue = $("#zoomValue");
    const $paper = $("#paper");
    const $zoomIn = $("#zoomIn");
    const $zoomOut = $("#zoomOut");

    function updateZoom() {
        if ($paper.length) {
            $paper.css("transform", `scale(${zoom})`);
        }
        $zoomValue.text(Math.round(zoom * 100) + "%");
    }

    $zoomIn.on("click", function () {
        zoom = Math.min(zoom + 0.1, 2);
        updateZoom();
    });

    $zoomOut.on("click", function () {
        zoom = Math.max(zoom - 0.1, 0.5);
        updateZoom();
    });


    // ========================================================
    // 入力変更監視 & 書類タイプ変更イベント
    // ========================================================

    const $inputElements = $(
        "#documentType, #titleInput, #contractDate, #client, #contractor, " +
        "#startDate, #endDate, #amount, #content, #payment, #notes, #documentNumber, #dueDate"
    );

    $inputElements.on("input change", function () {
        updatePreview();
    });

    $documentType.on("change", function () {
        changeDocumentType();
    });

    // ========================================================
    // プレビュー上の要素（デザイン文字含む）をドラッグして移動する機能
    // ========================================================

    let isDragging = false;
    let $dragTarget = null;
    let startX = 0;
    let startY = 0;
    let initialLeft = 0;
    let initialTop = 0;

    // ドラッグ開始（動的に追加された .draggable-element にも対応）
    $(document).on("mousedown", ".draggable-element", function (e) {
        // 編集中のテキストや、明細セルの場合はドラッグさせずに文字入力を優先する
        if ($(e.target).is("input, textarea") || $(e.target).attr("contenteditable") === "true") {
            return;
        }

        isDragging = true;
        $dragTarget = $(this);

        // 選択状態を切り替え
        $(".draggable-element").removeClass("selected");
        $dragTarget.addClass("selected");
        window.$selectedElement = $dragTarget;

        // マウスの初期位置と要素の初期位置を記録
        startX = e.clientX;
        startY = e.clientY;
        initialLeft = parseInt($dragTarget.css("left")) || 0;
        initialTop = parseInt($dragTarget.css("top")) || 0;

        // テキスト選択などを防ぐ
        e.preventDefault();
    });

    // ドラッグ中（画面全体で追従）
    $(document).on("mousemove", function (e) {
        if (!isDragging || !$dragTarget) return;

        const dx = e.clientX - startX;
        const dy = e.clientY - startY;

        $dragTarget.css({
            left: (initialLeft + dx) + "px",
            top: (initialTop + dy) + "px"
        });
    });

    // ドラッグ終了
    $(document).on("mouseup", function () {
        if (isDragging) {
            isDragging = false;
            $dragTarget = null;
        }
    });

    // ========================================================
    // 保存・PDF出力・スタイル適用
    // ========================================================

    const $saveButton = $("#saveButton");
    $saveButton.on("click", async function () {
        const data = {
            documentType: $documentType.val(),
            title: $titleInput.val(),
            contractDate: $contractDate.val(),
            client: $client.val(),
            contractor: $contractor.val(),
            startDate: $startDate.val(),
            endDate: $endDate.val(),
            amount: $amount.val(),
            content: $content.val(),
            payment: $payment.val(),
            notes: $notes.val(),
            documentNumber: $documentNumber.val(),
            dueDate: $dueDate.val()
        };

        try {
            const response = await fetch("save_document.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(data)
            });
            const result = await response.json();
            if (result.success) {
                alert("書類を保存しました。");
            } else {
                alert(result.message || "保存に失敗しました。");
            }
        } catch (error) {
            console.error(error);
            alert("保存処理でエラーが発生しました。");
        }
    });

    const $pdfButton = $("#pdfButton");
    $pdfButton.on("click", async function () {
        const paperElement = $paper[0];
        if (!paperElement) {
            return;
        }

        try {
            const canvas = await html2canvas(paperElement, { scale: 2, backgroundColor: "#ffffff" });
            const imageData = canvas.toDataURL("image/png");
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF("p", "mm", "a4");
            const pdfWidth = 210;
            const pdfHeight = canvas.height * pdfWidth / canvas.width;

            pdf.addImage(imageData, "PNG", 0, 0, pdfWidth, pdfHeight);
            pdf.save(($titleInput.val() || "document") + ".pdf");
        } catch (error) {
            console.error(error);
            alert("PDF出力に失敗しました。");
        }
    });

    function applySelectedStyle(property, value) {
        if (!$selectedElement || !$selectedElement.length) {
            alert("プレビューから変更したい要素を選択してください。");
            return;
        }
        $selectedElement[0].style.setProperty(property, value, "important");
        $selectedElement.find("*").each(function () {
            this.style.setProperty(property, value, "important");
        });
    }

    $("#fontFamily").on("change", function () {
        applySelectedStyle("font-family", $(this).val());
    });
    $("#fontSize").on("change", function () {
        applySelectedStyle("font-size", $(this).val());
    });
    $("#textColor").on("input", function () {
        applySelectedStyle("color", $(this).val());
    });
    $("#textBackgroundColor").on("input", function () {
        applySelectedStyle("background-color", $(this).val());
    });
    $("#textAlign").on("change", function () {
        applySelectedStyle("text-align", $(this).val());
    });


    // ========================================================
    // 明細表の罫線設定
    // ========================================================

    function updateDetailBorder(type) {
        const $detailArea = $('[data-element="detail"]');
        $detailArea.removeClass(
            "detail-border-order detail-border-quotation detail-border-delivery detail-border-receipt"
        );

        if (type === "order") {
            $detailArea.addClass("detail-border-order");
        } else if (type === "quotation") {
            $detailArea.addClass("detail-border-quotation");
        } else if (type === "delivery") {
            $detailArea.addClass("detail-border-delivery");
        } else if (type === "receipt") {
            $detailArea.addClass("detail-border-receipt");
        } else {
            $detailArea.addClass("detail-border-quotation");
        }
    }

    // --------------------------------------------------------
    // 右クリック（明細エリア ＆ 罫線共通）
    // --------------------------------------------------------

    $(document).on(
        "contextmenu",
        ".document-detail, .line-element",
        function (event) {

            event.preventDefault();

            const $target = $(this);
            const $menu = $("#detailContextMenu");

            // マウスの位置にメニューを表示
            $menu.css({
                left: event.clientX + "px",
                top: event.clientY + "px"
            });

            if ($target.hasClass("line-element")) {
                // 罫線が右クリックされた場合
                $contextLineElement = $target;
                $contextDetailRow = null;

                $("#detailMenuActions").hide();
                $("#lineMenuActions").show();
            } else {
                // 明細エリアが右クリックされた場合
                const $clickedRow = $(event.target).closest(".detail-data-row");

                if ($clickedRow.length) {
                    $contextDetailRow = $clickedRow;
                } else {
                    $contextDetailRow = $(".detail-data-row").last();
                }

                $contextLineElement = null;

                $("#detailMenuActions").show();
                $("#lineMenuActions").hide();
            }

            $menu.show();
        }
    );

    // 行追加
    $("#addDetailRow").on("click", function () {
        if (!$contextDetailRow || !$contextDetailRow.length) {
            $contextDetailRow = $(".detail-data-row").last();
        }

        const $newRow = $(`
            <div class="detail-row detail-data-row">
                <span class="detail-content">新しい項目</span>
                <span class="detail-quantity">1</span>
                <span class="detail-unit-price">0</span>
                <span class="detail-amount">0</span>
            </div>
        `);

        if ($contextDetailRow.length) {
            $contextDetailRow.after($newRow);
        } else {
            $(".detail-table").append($newRow);
        }

        $("#detailContextMenu").hide();
        $contextDetailRow = null;
    });

    // 行削除
    $("#deleteDetailRow").on("click", function () {
        if (!$contextDetailRow || !$contextDetailRow.length) {
            return;
        }

        const rowCount = $(".detail-data-row").length;
        if (rowCount <= 1) {
            alert("明細行が1行しかないため削除できません。");
            $("#detailContextMenu").hide();
            return;
        }

        $contextDetailRow.remove(); $("#detailContextMenu").hide();
        $contextDetailRow = null;
    });

    // 罫線削除
    $("#deleteLineElement").on("click", function () {
        if ($contextLineElement && $contextLineElement.length) {
            $contextLineElement.remove(); $contextLineElement = null;
        }
        $("#detailContextMenu").hide();
    });

    // メニュー外クリックで閉じる
    $(document).on("mousedown", function (event) {
        if (
            !$(event.target).closest("#detailContextMenu").length &&
            !$(event.target).closest(".document-detail").length &&
            !$(event.target).closest(".line-element").length
        ) {
            $("#detailContextMenu").hide();
            $contextDetailRow = null;
            $contextLineElement = null;
        }
    });


    // ========================================================
    // 罫線追加ボタン
    // ========================================================

    $("#addLineButton").on("click", function () {
        if (!$paper.length) {
            return;
        }

        const $line = $("<div>")
            .addClass("draggable-element line-element")
            .attr("data-element", "line")
            .css({
                position: "absolute",
                left: "100px",
                top: "300px",
                width: "300px",
                height: "2px",
                background: "#000000",
                margin: "0",
                padding: "0",
                border: "0",
                boxSizing: "border-box",
                zIndex: "100"
            });

        $paper.append($line); $(".draggable-element").removeClass("selected");
        $line.addClass("selected");
        $selectedElement = $line;
    });


    // ========================================================
    // 選択要素の削除ボタン
    // ========================================================

    $("#deleteElementButton").on("click", function () {
        if (!$selectedElement || !$selectedElement.length) {
            alert("削除する要素を選択してください。");
            return;
        }

        if (!confirm("選択した要素を削除しますか？")) {
            return;
        }

        $selectedElement.removeClass("selected");
        $selectedElement.remove(); $selectedElement = null;
    });

    // ========================================================
    // 明細セルのダブルクリック編集機能
    // ========================================================

    // 1. ダブルクリックで編集可能にする
    $(document).on("dblclick", ".detail-row span, .detail-data-row span", function (event) {
        const $cell = $(this);

        // すでに編集中でなければ編集モードにする
        if ($cell.attr("contenteditable") !== "true") {
            $cell.attr("contenteditable", "true");
            $cell.addClass("cell-editing");
            $cell.focus();

            // テキスト全体を選択状態にする（必要に応じて）
            const range = document.createRange();
            range.selectNodeContents($cell[0]);
            const sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
        }
    });

    // 2. フォーカスが外れた（Enterキーを押した、または外をクリックした）ときに編集を確定する
    $(document).on("blur", ".detail-row span[contenteditable=\"true\"], .detail-data-row span[contenteditable=\"true\"]", function () {
        const $cell = $(this);
        $cell.attr("contenteditable", "false");
        $cell.removeClass("cell-editing");

        // 数量や単価が変更された場合、金額や合計を再計算・プレビュー更新する
        calculateDetailRow($cell.closest(".detail-data-row"));
        updatePreview();
    });

    // 3. Enterキーを押したら編集を確定（フォーカスを外す）させる
    $(document).on("keydown", ".detail-row span[contenteditable=\"true\"], .detail-data-row span[contenteditable=\"true\"]", function (event) {
        if (event.key === "Enter") {
            event.preventDefault(); // 改行を防ぐ
            $(this).blur(); // フォーカスを外して確定
        }
    });

    // 行ごとの金額自動計算サポート関数
    function calculateDetailRow($row) {
        if (!$row || !$row.length) return;

        const $qtyCell = $row.find(".detail-quantity");
        const $priceCell = $row.find(".detail-unit-price");
        const $amountCell = $row.find(".detail-amount");

        if ($qtyCell.length && $priceCell.length && $amountCell.length) {
            const qty = Number(String($qtyCell.text()).replace(/,/g, "")) || 0;
            const price = Number(String($priceCell.text()).replace(/,/g, "").replace(/円/g, "")) || 0;
            const amount = qty * price;

            $amountCell.text(amount.toLocaleString("ja-JP"));
        }
    }

    // ========================================================
    // デザイン文字・テンプレート検索＆反映機能
    // ========================================================

    // サンプルとなるテンプレートのデータ一覧
    const designTemplates = [
        { id: 1, name: "【重要】赤字タイトル", text: "【重要】ご確認事項", fontSize: "22px", color: "#dc3545", fontWeight: "bold" },
        { id: 2, name: "見出し（大・中央）", text: "■ 自由記載セクション ■", fontSize: "18px", color: "#1e293b", fontWeight: "bold" },
        { id: 3, name: "標準挨拶文", text: "平素は格別のご高配を賜り、厚く御礼申し上げます。", fontSize: "14px", color: "#334155", fontWeight: "normal" },
        { id: 4, name: "備考・注意書き", text: "※本書類に関するご質問は担当窓口までお問い合わせください。", fontSize: "12px", color: "#64748b", fontWeight: "normal" },
        { id: 5, name: "担当者コメント枠", text: "【担当者メモ】特記事項なし", fontSize: "14px", color: "#2563eb", fontWeight: "normal" }
    ];

    // 1. 検索窓に入力したときに一致するテンプレートをリストに表示する
    $("#designSearchInput").on("input", function () {
        const keyword = $(this).val().toLowerCase().trim();
        const $results = $("#designSearchResults");

        $results.empty();

        if (!keyword) {
            $results.hide();
            return;
        }

        // キーワードに一致するものをフィルター
        const filtered = designTemplates.filter(t =>
            t.name.toLowerCase().includes(keyword) || t.text.toLowerCase().includes(keyword)
        );

        if (filtered.length > 0) {
            filtered.forEach(t => {
                const $item = $("<div>")
                    .addClass("design-search-item")
                    .html(`<strong>${t.name}</strong><br><small style="color: #64748b;">${t.text}</small>`)
                    .data("template", t)
                    .css({
                        padding: "8px 10px",
                        cursor: "pointer",
                        borderBottom: "1px solid #f1f5f9",
                        borderRadius: "4px",
                        transition: "background 0.1s"
                    })
                    .hover(
                        function () { $(this).css("background", "#eff6ff"); },
                        function () { $(this).css("background", "transparent"); }
                    );
                $results.append($item);
            });
            $results.show();
        } else {
            $results.html("<div style='padding: 8px; color: #94a3b8; font-size: 13px;'>該当するテンプレートがありません</div>").show();
        }
    });

    // 検索ボタンを押したときも同様に動作させる
    $("#designSearchBtn").on("click", function () {
        $("#designSearchInput").trigger("input");
    });

    // 2. リストに表示された項目を「ダブルクリック」したときにプレビューに反映させる
    $(document).on("dblclick", ".design-search-item", function () {
        const t = $(this).data("template");
        const $paper = $("#paper");
        if (!$paper.length) return;

        // プレビューの紙面中央付近に新しいデザイン文字要素を追加
        const $newText = $("<div>")
            .addClass("draggable-element word-text-box")
            .attr("contenteditable", "true")
            .attr("data-element", "customDesignText")
            .text(t.text)
            .css({
                position: "absolute",
                left: "140px",
                top: "380px",
                fontSize: t.fontSize,
                color: t.color,
                fontWeight: t.fontWeight,
                padding: "8px 12px",
                background: "#ffffff",
                //   border: "1px solid #94a3b8",
                borderRadius: "4px",
                zIndex: "100",
                cursor: "move",
                outline: "none"
            });

        $paper.append($newText);

        // 追加した要素を選択状態にする
        $(".draggable-element").removeClass("selected");
        $newText.addClass("selected");
        $selectedElement = $newText;

        // 検索結果リストを隠して入力欄をクリアする
        $("#designSearchResults").hide();
        $("#designSearchInput").val("");
    });

    /*
        $(document).on("",function() {
    
    
    
    
        });
    */

    // ========================================================
    // 紙面の何もないところをクリックしたら選択を解除する
    // ========================================================
    $(document).on("click", function (e) {
        // クリックした場所が「ドラッグ可能要素」でも「編集ツールバー」でも「検索グループ」でもない場合
        if (
            !$(e.target).closest(".draggable-element").length &&
            !$(e.target).closest(".editor-toolbar").length &&
            !$(e.target).closest(".design-search-group").length &&
            !$(e.target).closest(".input-panel").length
        ) {
            // すべての選択状態を解除
            $(".draggable-element").removeClass("selected");
            window.$selectedElement = null;
        }
    });

    // ========================================================
    // 初期化
    // ========================================================

    setToday();
    changeDocumentType();
    updateDetailBorder($documentType.val());
    updatePreview();
    updateZoom();

});