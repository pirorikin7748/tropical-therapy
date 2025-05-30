<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = User::withTrashed();

        // ステータス絞り込み
        if ($request->filled('status') && in_array($request->status, ['active', 'withdrawn'])) {
            if ($request->status === 'active') {
                $query->whereNull('deleted_at');
            } elseif ($request->status === 'withdrawn') {
                $query->whereNotNull('deleted_at');
            }
        }

        // 名前検索（全角/半角スペース除去・結合して部分一致）
        if ($request->filled('name')) {
            $keyword = preg_replace('/\s+/u', '', $request->name); // 全角・半角スペースを削除
            $query->whereRaw("REPLACE(CONCAT(family_name, first_name), ' ', '') LIKE ?", ["%{$keyword}%"]);
        }

        // 並び順
        $sortField = $request->get('sort', 'kana');
        $sortOrder = $request->get('order', 'asc');
        if ($sortField === 'kana') {
            $query->orderBy('family_name_kana', $sortOrder)
                  ->orderBy('first_name_kana', $sortOrder);
        } elseif ($sortField === 'registered_at') {
            $query->orderBy('created_at', $sortOrder);
        }

        $members = $query->paginate(10)->appends($request->all());

        return view('admin.members.index', compact('members'));
    }

    public function csv(Request $request)
    {
        $query = User::withTrashed();

        if ($request->filled('status') && in_array($request->status, ['active', 'withdrawn'])) {
            if ($request->status === 'active') {
                $query->whereNull('deleted_at');
            } elseif ($request->status === 'withdrawn') {
                $query->whereNotNull('deleted_at');
            }
        }

        if ($request->filled('name')) {
            $keyword = preg_replace('/\s+/u', '', $request->name);
            $query->whereRaw("REPLACE(CONCAT(family_name, first_name), ' ', '') LIKE ?", ["%{$keyword}%"]);
        }

        $sortField = $request->get('sort', 'kana');
        $sortOrder = $request->get('order', 'asc');
        if ($sortField === 'kana') {
            $query->orderBy('family_name_kana', $sortOrder)
                  ->orderBy('first_name_kana', $sortOrder);
        } elseif ($sortField === 'registered_at') {
            $query->orderBy('created_at', $sortOrder);
        }

        $members = $query->get();

        $csvHeader = ['ID', '名前', 'カナ', '住所', '電話番号', '登録日時', 'ステータス'];
        $csvData = [];

        foreach ($members as $member) {
            $csvData[] = [
                $member->id,
                $member->family_name . ' ' . $member->first_name,
                $member->family_name_kana . ' ' . $member->first_name_kana,
                $member->address,
                "$member->tel1-$member->tel2-$member->tel3",
                $member->created_at->format('Y-m-d H:i:s'),
                $member->deleted_at ? '退会済み' : '会員'
            ];
        }

        $filename = 'members_' . now()->format('Ymd_His') . '.csv';

        $response = Response::stream(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            stream_filter_append($handle, 'convert.iconv.utf-8/cp932');

            fputcsv($handle, $csvHeader);
            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);

        return $response;
    }

    public function withdraw(Request $request)
    {
        $userIds = $request->input('member_ids', []);

        if (empty($userIds)) {
            return redirect()->back()->with('error', '会員が選択されていません。');
        }

        //一括削除
        User::whereIn('id', $userIds)->delete();

        return redirect()->back()->with('success', '選択した会員を退会させました。');
    }

    public function edit($id)
    {
        $member = User::withTrashed()->findOrFail($id);

        //論理削除されている場合は操作不可
        if ($member->deleted_at !== null) {
            return redirect()->route('admin.members.index')->with('error', '退会済みの会員は編集できません。');
        }

        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'family_name' => 'required|max:20',
            'first_name' => 'required|max:20',
            'family_name_kana' => 'required|max:20|regex:/^[ァ-ヶー]+$/u',
            'first_name_kana' => 'required|max:20|regex:/^[ァ-ヶー]+$/u',
            'address' => 'required|max:255',
            'tel1' => 'required|digits_between:1,5',
            'tel2' => 'required|digits_between:1,5',
            'tel3' => 'required|digits_between:1,5',
        ]);

        $member = User::withTrashed()->findOrFail($id);
        $member->update($request->only([
            'family_name', 'first_name',
            'family_name_kana', 'first_name_kana',
            'address', 'tel1', 'tel2', 'tel3',
        ]));

        return redirect()->route('admin.members.index')->with('success', '会員情報を更新しました。');
    }
}
