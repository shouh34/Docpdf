<?php

namespace App\Services;

use App\Models\Documents;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DocumentService
{
    /**
     * ドキュメントを検索する
     */
    public function search(int $userId,?string $keyword = null):LengthAwarePaginator {

        $query = Documents::query()
            ->where('user_id', $userId);

        // キーワードが入力されている場合
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                  ->orWhere('document_type', 'like', '%' . $keyword . '%');
            });
        }

        return $query
            ->orderByDesc('updated_at')
            ->paginate(10)
            ->withQueryString();
    }
public function create(int $userId, array $data): Documents
{
    return Documents::create([
        'user_id' => $userId,

        'document_type' => $data['document_type'] ?? 'contract',

        'title' => $data['title'] ?? '',

        'contract_date' => $data['contract_date'] ?? null,
        'client_name' => $data['client_name'] ?? null,
        'contractor_name' => $data['contractor_name'] ?? null,
        'start_date' => $data['start_date'] ?? null,
        'end_date' => $data['end_date'] ?? null,
        'amount' => $data['amount'] ?? null,
        'business_content' => $data['business_content'] ?? null,

        'content' => $data['content'] ?? null,
    ]);
}
}
