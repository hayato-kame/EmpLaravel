<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Photo;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::all();  // 戻り値は、Illuminate\Database\Eloquent\Collection のオブジェクトです
        // dd($employees);
        // dd(count($employees));  // 12 などの整数が帰る
        return view('employees.index', [ 'employees' => $employees ]);
    }

    public function new_entry_edit(Request $request)
    {
        $action = $request->action;
        // dd($action);
        switch ($action) {
            case 'add':
                $photo = new Photo(); // 親データのインスタンス
                $employee = new Employee(); // 子データのインスタンス

                return view('employees.new_entry_edit',
                    [ 'photo' => $photo, 'employee' => $employee, 'action' => $action ]);
                break;

            case 'edit':

                break;
        }



    }

    public function emp_control()
    {

    }

    public function find()
    {

    }

    public function postCSV()
    {

    }

}
