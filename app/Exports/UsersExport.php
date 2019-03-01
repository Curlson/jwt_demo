<?php

namespace App\Exports;

use App\Model\User;
use Maatwebsite\Excel\Concerns\FromCollection; // 1. 入门
use Maatwebsite\Excel\Concerns\Exportable;  // 2. export table
use Illuminate\Contracts\Support\Responsable; // 3. 更简单的调用
// From Query 性能更好的查询
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
//WithMapping,
class UsersExport implements FromQuery, Responsable,  WithHeadings
{
    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName;

    public function __construct()
    {
        $this->fileName = $this->setFileName();
    }

    /**
     * 集合的方式查找
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all();
    }

    /**
     * 性能更好的  get 数据方式
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return User::query();
    }

    private function setFileName()
    {
        return 'users'.date('ymd').'.xlsx';
    }

    /**
     * @param mixed $invoice
     * @return array
     */
//    public function map($invoice): array
//    {
//        return [
//            $invoice->invoice_number,
//            Date::dateTimeToExcel($invoice->created_at),
//        ];
//    }

    public function headings(): array
    {
        return [
            '编号',
            '姓名',
            '手机',
            '邮箱',
            '密码',
            '创建时间',
        ];
    }
}
