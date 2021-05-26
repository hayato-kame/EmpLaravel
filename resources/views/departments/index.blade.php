@extends('layouts.myapp')

@section('title','Index')

@section('menubar')
    @parent
    部署一覧ページ
@endsection

@section('content')

<h3>部署一覧:</h3>

{{-- フラッシュメッセージ --}}
@if(session('flash_message'))
<p class="notice">
    メッセージ:{{session('flash_message')}}
</p>
@endif

<div class="toolbar">
    {!! link_to_route('dashboard', 'Dashboardへ戻る', []) !!}
</div>

@if(count($departments) > 0)
    <table border="1">
        <tr>
            <th>部署ID</th>
            <th>部署名</th>
            <th colspan="2"></th>
        </tr>
    @foreach($departments as $department)
        <tr>
            <td>{{$department->department_id}}</td>
            <td>{{$department->department_name}}</td>
            <td>
                {{-- {!! Form::open(['route'=> ['departments.new_entry_edit', ]]) !!} --}}
            </td>
        </tr>
    </table>
    @endforeach

@endif
