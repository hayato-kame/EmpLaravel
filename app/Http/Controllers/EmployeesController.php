<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        // dd($employees);
        return view('employees.index', [ 'employees' => $employees ]);
    }

    public function new_entry_edit()
    {

    }

    public function emp_control()
    {

    }


}
