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
        $group_number = (int) $request['group_number']; // グループ数（整数）
        $group_name = $request['group_name'];
        $members = $request['members']; // メンバー（連想配列）
        dd($group_name);

        // ランダム性のあるグループ作成
        $groups = $group->makeGroups($group_number, $members);

        dd($groups);
    }
}
