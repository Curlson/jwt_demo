<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function profile(Request $request) {
        $user = \Auth::user();
        return response()->json(compact('user'));
    }

    public function export()
    {
        $uncode = date('ymd');
        // 1. 快速启动
        // return Excel::download(new UsersExport, 'users'.$uncode.'.xlsx');
        // 2. 出口品
        // return app(UsersExport::class)->download( 'users'.$uncode.'.xlsx');
        // 3. 更方便
        return new UsersExport();
    }

    public function import(Request $request)
    {
        $file = $request->file('excel');  //获取UploadFile实例

        if ( !$file->isValid()) { //判断文件是否有效
            return redirect()
                ->back()
                ->withErrors('文件上传失败,请重新上传');
        }

        //Excel::import(new UsersImport, request()->file('excel'));

        try {
            $collection = app(UsersImport::class)->toCollection(request()->file('excel'));
            dd($collection);
        } catch (\Exception $e) {
            $failures = $e->getMessage();
            dd($failures);
        }

    }
}
