@extends('layouts.myapp')

@section('title','Index')

@section('menubar')
    @parent
    部署一覧ページ
@endsection

@section('content')

    <h3>部署一覧:</h3>

    {{-- フラッシュメッセージ --}}
    @if(session('f_message'))
        <p class="notice">
            メッセージ:{{session('f_message')}}
        </p>
    @endif

    <div class="toolbar">
        {!! link_to_route('dashboard', 'Dashboardへ戻る', []) !!}
    </div>

    @if(count($departments) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>部署ID</th>
                    <th>部署名</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                    <tr>
                        <td>{{$department->department_id}}</td>
                        <td>{{$department->department_name}}</td>
                        <td>
                            {!! Form::model($department, ['route' => ['departments.new_entry_edit', $department->department_id], 'method' => 'get']) !!}
                                {!! Form::hidden('action',"edit") !!}
                                {!! Form::hidden('department_id', $department->department_id) !!}
                                {!! Form::submit('編集', ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </td>
                        <td>
                            {!! Form::model($department, ['route' => ['departments.dep_control', $department->department_id], 'method' => 'post']) !!}
                                {!! Form::hidden('action', "delete") !!}
                                {!! Form::hidden('department_id', $department->department_id) !!}
                                {!! Form::submit('削除', ['class' => 'btn btn-danger', 'onclick' => 'confirm("本当に削除してよろしいですか")']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <div>
        {{-- 第三引数で ? 以降のクエリー文字列を指定できます --}}
        <button type="button" class="btn btn-light" display="inline-block">
            {!! link_to_route('departments.new_entry_edit', "部署新規作成ページ", ['action' => "add", ], []) !!}
        </button>
    </div>
@endsection

@section('footer')
    copyright 2021 kameyama
@endsection
