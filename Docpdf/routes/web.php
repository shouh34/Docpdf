<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\DocupdfController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SharingController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\FriendController;


// ==========================================
// トップ画面
// ==========================================
Route::get('/', [TopController::class, 'top'])->name('top');


// ==========================================
// 未ログインでもアクセスできるページ
// ==========================================

Route::middleware('guest')->group(function () {

    // ログイン画面
    Route::get('/Login', [TopController::class, 'Login'])->name('Login.top');
    // 新規登録画面
    Route::get('/Register', [RegisterController::class, 'index'])->name('Register');

});




// ==========================================
// ログインしている人だけが見られるページ
// ==========================================

Route::middleware('auth')->group(function () {

    // ------------------------------------------
    // ダッシュボード
    // ------------------------------------------

    Route::get('/Authenticated/Dashboard',[DashboardController::class, 'index'])->name('dashboard');

    //承認済みの友達を表示
    Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');
    //友達を申請
    Route::post('/friends', [FriendController::class, 'store'])->name('friends.store');

    Route::patch('/friendships/{friendship}/accept', [FriendController::class, 'accept'])->name('friendships.accept');
    // ------------------------------------------
    // ドキュメント作成
    // ------------------------------------------
    Route::get('/Document/Generate', [DocupdfController::class, 'index'])->name('Docu.Gene');

    // ドキュメント保存
    Route::post('/Document/Generate/Save', [DocupdfController::class, 'SaveDocument'])->name('SaveDocument');

    Route::get('/friends/{friend}/documents', [FriendController::class, 'documents'])->name('friends.documents.index');

    Route::get('/friends/{friend}/documents/{document}', [FriendController::class, 'showDocument'])->name('friends.documents.show');

    Route::put('/settings/password', [AccountSettingsController::class, 'updatePassword'])->name('settings.password.update');

    // ドキュメント一覧
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');

    // 新規ドキュメント保存
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');

    //削除
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    // 保存したドキュメントを開く
    Route::get('/documents/edit/{document}', [DocumentController::class, 'edit'])->middleware('auth')->name('documents.edit');
    Route::get('/documents/search', [DocumentController::class, 'search'])->name('documents.search');


    //共有
    Route::get('/documents/share/{document}', [SharingController::class, 'index'])->name('documents.share');




    // ------------------------------------------
    // 設定
    // ------------------------------------------

    //設定を表示
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');

    //データ管理タブ
    Route::get('/settings/document/export', [SettingController::class, 'export'])->name('settings.document.export');

    //エディタタブ
    //エディタの設定を更新
    Route::put('/settings/editor', [SettingController::class, 'updateEditor'])->name('settings.editor.update');

    //ドキュメントの
    Route::put('/settings/document', [SettingController::class, 'updateDocument'])->name('settings.document.update');

    //アカウント情報を更新
    Route::put('/settings/account/profile', [AccountController::class, 'updateProfile'])->name('account.profile.update');

    Route::post('/settings/account/profile-image', [AccountController::class, 'updateProfileImage'])->name('account.profile-image');

    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->middleware('auth')->name('notifications.read');


    // ------------------------------------------
    // プロフィール
    // ------------------------------------------

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});


require __DIR__.'/auth.php';
