@extends('layouts.myapp')

@section('title','Index')

@section('menubar')
    @parent
    社員一覧ページ
@endsection

@section('content')

<p>社員一覧:<p>

{{-- フラッシュメッセージ リダイレクトされてきたので、セッションスコープから取り出すには sessionメソッドで引数にキーを指定する --}}
@if(session('f_message'))
    <p class="notice">{{session('f_message')}}</p>
@endif

<div class="toolbar">
    {!! link_to_route('dashboard', 'Dashboardへ戻る', []) !!}
</div>

    {{-- もし コレクションの中身の要素数が 0以上なら、テーブルを表示する --}}
    @if (count($employees) > 0)
        <table class="table table-stripe">
            <thead>
                <tr>
                    <th>社員ID</th><th>名前</th><th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>{{$employee->employee_id}}</td>
                    <td>{{$employee->name}}</td>
                    <td>
                        {{-- buttonの中に aリンク aリンクはGETアクセスになる  第三引数には ?以降のクエリー文字列を設定できる
                            ルーティングは
                            Route::get('/employees/new_entry_edit', [ EmployeesController::class, 'new_entry_edit' ])->name('employees.new_entry_edit');
                            --}}
                        <button type="button" class="btn btn-primary" display="inline-block">
                            {!! link_to_route('employees.new_entry_edit', "編集", [ 'action' => 'edit', 'employee_id' => $employee->employee_id ], ['style' => 'color: white;'] ) !!}
                        </button>
                    </td>
                    <td>
                        {{-- buttonの中に aリンク aリンクはGETアクセスになる 第三引数には ?以降のクエリー文字列を設定できる
                            ルーティングは
                            Route::get('/employees/emp_control', [ EmployeesController::class, 'emp_control' ])->name('employees.emp_control');
                            --}}
                        <button type="button" class="btn btn-danger" display="inline-block" onclick='confirm("本当に削除してよろしいですか")'>
                            {!! link_to_route('employees.emp_control', "削除", [ 'action' => 'delete', 'employee_id' => $employee->employee_id ], ['style' => 'color: white;'] ) !!}
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

{{-- <li><a href="{{ url('/users') }}" class="text-lg text-gray-700 underline">ユーザー一覧画面</a></li> --}}
<li><a href="{{ url('/departments') }}" class="text-lg text-gray-700 underline">部署一覧画面ページへ</a></li>

@endsection

@section('footer')
    copyright 2021 kameyama
@endsection


{{--
link_to_route の代わりに、このようにもできる
Form::open を使うか 　Form::model を使う
{!! Form::open(['route' => ['employees.new_entry_edit', $employee->employee_id], 'method' => 'get'])  !!}
    {!! Form::hidden('action', "edit")  !!}
    {!! Form::hidden('employee_id', $employee->employee_id)  !!}
    {!! Form::submit('編集', ['class' => 'btn btn-primary' ]) !!}
{!! Form::close() !!}



{!! Form::open(['route' => ['employees.emp_control', $employee->employee_id], 'method' => 'post'])  !!}
    {!! Form::hidden('photo_id', $employee->photo->photo_id)  !!}
    {!! Form::hidden('employee_id', $employee->employee_id)  !!}
    {!! Form::submit('削除', ['class' => 'btn btn-danger' , 'onclick' => 'confirm("本当に削除してよろしいですか")']) !!}
{!! Form::close() !!}


    --}}
