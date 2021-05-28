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
            <td>{{$employee->employee_name}}</td>
            <td>
                {{-- buttonの中に aリンク aリンクはGETアクセスになる --}}
                <button type="button" class="btn btn-primary" display="inline-block">
                    {!! link_to_route('employees.new_entry_edit', "編集", [ 'action' => 'edit', 'employee_id' => $employee->employee_id ], [] ) !!}
                </button>
            </td>
            <td>
                <button type="button" class="btn btn-primary" display="inline-block">
                    {!! link_to_route('employees.emp_control', "削除", [ 'action' => 'delete', 'employee_id' => $employee->employee_id ], [] ) !!}
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- <li><a href="{{ url('/users') }}" class="text-lg text-gray-700 underline">ユーザー一覧画面</a></li> --}}
<li><a href="{{ url('/departments') }}" class="text-lg text-gray-700 underline">部署一覧画面ページへ</a></li>

@endsection

@section('footer')
    copyright 2021 kameyama
@endsection
