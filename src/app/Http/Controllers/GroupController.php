<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Maker;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function create()
    {
        return view('groups/create');
    }

    public function store(Request $request, Group $group)
    {
        $members = array_filter($request['members']); // メンバー（連想配列）
        $group_number = (int) $request['group_number']; // グループ数（整数）
        $group_name = $request['group_name']; // グループ名（配列）
        // グループ名が入力されていなかった時 or 足りなかった時、自動的に数字（配列番号）をグループ名とする
        for ($i = 0; $i < count($group_name); $i++) {
            if (is_null($group_name[$i])) {
                $group_name[$i] = (string) ($i + 1);
            }
        }

        // ランダム性のあるグループ作成
        $groups = $group->makeGroups($members, $group_number, $group_name);

        dd($groups);
    }
}
