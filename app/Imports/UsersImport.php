<?php

namespace App\Imports;

use App\Model\User;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UsersImport implements ToModel, WithHeadingRow
{
    use Importable;

    const DIFF_DAYS = 25569;            // 1970 到 1900 之间相差的天数
    const DAY_SECONDS = 86400;   // 一天的时间戳

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name'     => $row['name'],
            'mobile'    => $row['mobile'],
            'email'    => $row['email'],
            'password' => bcrypt($row['password']),
            'email_verified_at' => $row['email_verified_at'] ?: null,
            'remember_token' => $row['remember_token'] ?: null,
            'created_at' => $row['created_at'] ? $this->getFormatDate($row['created_at']) : null,
        ]);
    }

    public function getFormatDate($dateTime) {
        if(is_float($dateTime) && $dateTime > self::DIFF_DAYS) { //Excel 类型的 float 型时间
            $timestamp = ($dateTime - self::DIFF_DAYS) * self::DAY_SECONDS ;
            $format = 'Y-m-d H:i:s';
            return date($format, $timestamp);
        }
        return $dateTime;
    }


}
