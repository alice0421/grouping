<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Maker;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    // グループ一覧画面表示
    public function index(Maker $maker)
    {
        return view('groups/index')->with(['makers' => $maker->getByPagination()]);
    }

    // 各グループ詳細画面（グループ分け結果画面）表示
    public function show(Maker $maker)
    {
        return view('groups/show')->with(['maker' => $maker]);
    }

    // グループ作成画面表示
    public function create()
    {
        return view('groups/create');
    }

    // グループ分け+グループ保存機能
    public function store(Request $request, Group $group)
    {
        $title = $request['title'];
        $members = array_filter($request['members']); // メンバー（連想配列）
        $group_number = (int) $request['group_number']; // グループ数（整数）
        $group_name = $group->formatGroupName($request['group_name']); // グループ名（配列）
        // グループ名は、App\Models\Group.phpのformatGroupNameメソッドを使用して、グループ名が入力されていなかった時 or 足りなかった時、自動的に数字（配列番号）をグループ名にするように変更処理を行っている。

        // ランダム性のあるグループ作成（App\Models\Group.phpのmakeGroupsメソッド使用）
        $groups = $group->makeGroups($members, $group_number, $group_name);

        // グループを全テーブルに保存（App\Models\Group.phpのstoreGroupsメソッド使用）
        $maker = $group->storeGroups($title, $members, $groups);

        return redirect('/groups/'.$maker->id);
    }
}
