<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Maker;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index(Maker $maker)
    {
        return view('groups/index')->with(['makers' => $maker->getByPagination()]);
    }

    public function show(Maker $maker)
    {
        return view('groups/show')->with(['maker' => $maker]);
    }

    public function create()
    {
        return view('groups/create');
    }

    public function store(Request $request, Group $group)
    {
        $members = array_filter($request['members']); // メンバー（連想配列）
        $group_number = (int) $request['group_number']; // グループ数（整数）
        $group_name = $group->formatGroupName($request['group_name']); // グループ名（配列）

        // ランダム性のあるグループ作成
        $groups = $group->makeGroups($members, $group_number, $group_name);

        // グループを全テーブルに保存
        $maker = $group->storeGroups($members, $groups);

        return redirect('/groups/'.$maker->id);
    }
}
