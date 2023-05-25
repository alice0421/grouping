<?php

namespace App\Http\Controllers;

use App\Http\Models\Group;
use App\Http\Models\Maker;
use App\Http\Models\Member;
use App\Http\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function create()
    {
        return view('groups/create');
    }

    public function store(Request $request)
    {
        $group_number = (int) $request['group_number'];
        $members = $request['members'];
        dd($group_number, $members);
    }
}
