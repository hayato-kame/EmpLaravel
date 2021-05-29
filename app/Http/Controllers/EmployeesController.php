<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::all();  // 戻り値は、Illuminate\Database\Eloquent\Collection のオブジェクトです
        // dd($employees);
        // dd(count($employees));  // 12 などの整数が帰る
        return view('employees.index', [ 'employees' => $employees ]);
    }

    public function new_entry_edit()
    {

    }

    public function emp_control()
    {

    }


}
