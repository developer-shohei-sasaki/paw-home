<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RescuePet extends Model
{
    // 年齢算出用のクエリ
    public const AGE_CALCULATION_SQL = 'CASE
        WHEN TIMESTAMPDIFF(YEAR, rescue_pets.birthday, CURDATE()) = 0
        THEN CONCAT(TIMESTAMPDIFF(MONTH, rescue_pets.birthday, CURDATE()), "ヶ月")
        ELSE CONCAT(TIMESTAMPDIFF(YEAR, rescue_pets.birthday, CURDATE()), "才")
        END AS age';
}
