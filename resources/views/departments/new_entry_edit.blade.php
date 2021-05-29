@extends('layouts.myapp')

@php
    $label = "";
@endphp
@if($action === "add")
    @php
        $label = "新規作成";
    @endphp
@else
    @php
        $label = "編集";
    @endphp
@endif

@section('title',$label)

@section('menubar')
    @parent
    部署{{$label}}ページ
@endsection

@section('content')
    @if (count($errors)> 0)
        <p style="color:red;">入力に問題があります</p>
    @endif

    @if (isset($department))
        <h3>部署の{{$label}}ページ</h3>
        {{-- フラッシュメッセージ --}}
        @if (session('flash_message'))
            <p class="notice">
                メッセージ:{{ session('flash_message') }}
            </p>
        @endif

        <div class="toolbar">
            {!! link_to_route('departments.index', '部署一覧ページへ戻る', []) !!}
        </div>

        {!! Form::model($department, ['route' => ['departments.dep_control', $department->department_id], 'method' => 'post']) !!}
            @error('department_name')
                <p class="validation">{{$message}}</p>
            @enderror
            <div class="form-group form-inline row">
                {!! Form::label('department_name', '部署名:', [ 'class' => 'col-sm-3 col-form-label' ]) !!}
                {!! Form::text('department_name', null, [ 'class' => 'form-control col-sm-9' ]) !!}
            </div>

            {!! Form::hidden('action', $action) !!}
            {!! Form::hidden('department_id', $department->department_id) !!}
            @php
                // dd($department->department_id); //新規の時には、nullが、department_idプロパティに設定されている
            @endphp

            {!! Form::submit('送信', ['class' => 'btn btn-secondary offset-3 ', 'confirm' => 'この内容で送信しますか？']) !!}
        {!! Form::close() !!}

    @endif

@endsection

@section('footer')
    copyright 2021 kameyama
@endsection
