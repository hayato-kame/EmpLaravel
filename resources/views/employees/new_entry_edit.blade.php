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
    

@endsection

@section('footer')
    copyright 2021 kameyama
@endsection
