<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DocumentService;
use Illuminate\Support\Facades\Auth;
use App\Models\Documents;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    //


    public function index( Request $request, DocumentService $documentService )
     {


   $keyword = $request->input('keyword', '');

    try {
        $documents = $documentService->search(Auth::id(), $keyword);

        return view('documents.index', compact('documents', 'keyword'));
    } catch (\Throwable $e) {
        Log::error('ドキュメント検索に失敗しました。', [
            'user_id' => Auth::id(),
            'message' => $e->getMessage(),
        ]);

        return back()
            ->withInput()
            ->with('error', 'ドキュメントの検索に失敗しました。時間をおいて再度お試しください。');
    }

    }

    //作成ページでテーブルに書き込み処理
    public function store(Request $request, DocumentService $documentService)
    {
        $validated = $request->validate([
            'document_type' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],

            'contract_date' => ['nullable', 'date'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'contractor_name' => ['nullable', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'amount' => ['nullable', 'numeric', 'min:0'],
            'business_content' => ['nullable', 'string'],

            // hidden inputからJSON文字列で送られてくる
            'content' => ['nullable', 'json'],
        ]);

        if (!empty($validated['content'])) {
            $validated['content'] = json_decode(
                $validated['content'],
                true
            );
        }

        $document = $documentService->create(
            Auth::id(),
            $validated
        );

        return redirect()
            ->route('documents.index', $document->id)
            ->with('success', 'ドキュメントを保存しました。');
    }



    //データ削除
    public function destroy($id)
    {


        try {
            $document = Documents::findOrFail($id);

            $document->delete();

            return redirect()
                ->route('dashboard')
                ->with('success', 'データを削除しました。');

        } catch (\Exception $e) {

            return redirect()
                ->route('dashboard')
                ->with('error', 'データの削除に失敗しました。');
        }

    }

    //ドキュメントの検索
    public function Search(Request $request)
    {
        $keyword = $request->input('input_text');

        $recentDocuments = Documents::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('title', 'like', '%' . $keyword . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();


            $documentCount = Documents::where('user_id', Auth::id())->count();

            // 今月作成した契約書の数
            $monthlyDocumentCount = Documents::where('user_id', Auth::id())
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();

                $user=Auth::user();

        $notifications = $user->unreadNotifications()->latest()->get();


            return view('Dashboard.dashboard', compact('recentDocuments', 'keyword','documentCount','monthlyDocumentCount','notifications'));
    }

    public function edit(Request $request, Documents $document)
    {
        $userId = $request->user()->getAuthIdentifier();

        abort_unless((int) $document->user_id === (int) $userId, 403);
        return view('documents.edit', compact('document'));
    }
}
