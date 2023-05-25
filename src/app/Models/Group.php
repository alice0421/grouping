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

    // グループ名が入力されていなかった時 or 足りなかった時、自動的に数字（配列番号）をグループ名とする
    public function formatGroupName(array $group_name)
    {
        for ($i = 0; $i < count($group_name); $i++) {
            if (is_null($group_name[$i])) {
                $group_name[$i] = (string) ($i + 1);
            }
        }

        return $group_name;
    }

    // ランダムなグループを作成
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
