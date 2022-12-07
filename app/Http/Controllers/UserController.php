<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function Filter(){
        $filter = DB::table('users')->join('departments','departments.id','=','users.department_id')
        ->join('companies','companies.id','=','departments.company_id')->where()->get();
        return response()->json($filter);
    }
}
