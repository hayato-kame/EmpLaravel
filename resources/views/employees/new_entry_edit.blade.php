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
    社員{{$label}}ページ
@endsection

@section('content')
    @if (count($errors) > 0)
        <p style="color:red;">入力に問題があります</p>
    @endif

    @if (isset($employee))
        @if ($action == 'add')
            <h3>社員の{{ $label }}ページ</h3>
        @else
            <h3>社員ID:{{ $employee->employee_id }}の{{ $label }}ページ</h3>
        @endif

        {{-- フラッシュメッセージ リダイレクトされてくるので、セッションスコープから取り出す sessionメソッドの引数は、キーです --}}
        @if (session('flash_message'))
            <p class="notice">
                メッセージ：{{ session('flash_message') }}
            </p>
        @endif

        <div class="toolbar">
            {!! link_to_route('employees.index', '社員一覧ページへ戻る', []) !!}
        </div>

        {{-- laravelcollectiveを使用してる場合、 'files' => true とすれば、 フォームはファイルのアップロードをサポートします。 --}}
        {{-- 'method' => 'post'  は、 postなので、省略もできます --}}
        {!! Form::model($employee, ['route' => ['employees.emp_control', $employee->employee_id], 'method' => 'post', 'files' => true]) !!}

            {{-- バイナリーデータがあったら表示する isset関数 で条件分岐する--}}
            @php
                // dd(isset($employee->photo->photo_data));
            @endphp

            @if (isset($employee->photo->photo_data))
            <div class="row mt-4">
                <span class="col-sm-3">画像：</span>
                {{-- base64,{{$employee->photo->photo_data　のところ、ちょっと直したのでコントローラ側の 'photo_data'を送らないように修正すること --}}
                <img src="data:image/{{$employee->photo->mime_type}};base64,{{$employee->photo->photo_data}}"
                    alt="写真" title="社員の写真" width="300" height="250" class="col-sm-9">
            </div>
            @endif

            {{-- 画像のアップロード 　Form::model の  'files' => true  の設定が必要です --}}
            <div class="form-group form-inline row">
                {!! Form::label('photo_data', '写真:', ['class' => 'col-sm-3 col-form-label', ]) !!}
                {!! Form::file('photo_data', null, ['class' => 'col-sm-9 form-control', 'accept' => ".jpeg, .jpg, .png, .tmp"]) !!}
                {!! Form::hidden('photo_id', $employee->photo_id) !!}
            </div>


        {!! Form::close() !!}
    @endif


@endsection

@section('footer')
    copyright 2021 kameyama
@endsection
