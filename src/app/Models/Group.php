<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function maker()
    {
        return $this->belongsTo(Maker::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class);
    }

    public function makeGroups(array $members, int $group_number, array $group_name)
    {
        // メンバーの並びをシャッフルする（ランダム性を持たせる）
        shuffle($members);

        $each_group_number = floor(count($members) / $group_number); // メンバー数 ÷ グループ数 の商を整数で切り捨て
        $rest_member_number = count($members) % $group_number; // メンバー数 ÷ グループ数 の余り


        $groups = array(); // ここに完成したグループ分けを入れていく
        $offset = 0;
        for ($i = 0; $i < $group_number; $i++) {
            if (empty($rest_member_number)) {
                // メンバー数 ÷ グループ数 の余りが0の時
                $length = $each_group_number;
            } else {
                // メンバー数 ÷ グループ数 の余りが1以上の時
                $length = $each_group_number + 1;
                $rest_member_number--;
            }
            // 各グループを名前付きで作成
            $groups[$group_name[$i]] = array_slice($members, $offset, $length);
            $offset += $length;
        }

        return $groups;
    }
}
