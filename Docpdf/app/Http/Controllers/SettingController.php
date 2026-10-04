<?php

namespace App\Http\Controllers;

use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;

class SettingController extends Controller
{
    /**
     * 設定画面
     */
    public function index()
    {
        $user = Auth::user();

        $setting = UserSetting::firstOrCreate(
            ['user_id' => $user->id],
            [
                'default_font' => 'Noto Sans JP',
                'default_font_size' => 16,
                'paper_size' => 'A4',
                'orientation' => 'portrait',
                'auto_save' => true,
                'default_document_type' => 'contract',
            ]
        );

        return view('Setting.Settings', compact('setting'));
    }


    /**
     * エディタ設定を更新
     */
    public function updateEditor(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'default_font' => [
                'required',
                'string',
                'max:100',
            ],

            'default_font_size' => [
                'required',
                'integer',
                'min:8',
                'max:72',
            ],

            'paper_size' => [
                'required',
                'in:A4,A3,B5',
            ],

            'orientation' => [
                'required',
                'in:portrait,landscape',
            ],

            'auto_save' => [
                'nullable',
                'boolean',
            ],

            'default_document_type' => [
                'required',
                'in:contract,invoice,order,quotation,delivery,receipt',
            ],
        ]);


        $setting = UserSetting::firstOrCreate([
            'user_id' => $user->id,
        ]);


        $setting->default_font =
            $validated['default_font'];

        $setting->default_font_size =
            $validated['default_font_size'];

        $setting->paper_size =
            $validated['paper_size'];

        $setting->orientation =
            $validated['orientation'];

        $setting->auto_save =
            $request->boolean('auto_save');

        $setting->default_document_type =
            $validated['default_document_type'];


        $setting->save();


        return back()->with(
            'success',
            '設定を保存しました。'
        );
    }



    //エクスポート
    public function export()
    {


    return "exportしました";
    }
}
