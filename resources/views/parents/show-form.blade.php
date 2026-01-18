@extends('layouts.master')

@section('title')
    {{ trans('main_trans.Add_Parent') }}
@stop

@section('page-header')
    @section('PageTitle')
        {{ trans('main_trans.Add_Parent') }}
    @endsection
@stop

<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <livewire:add-parent />
            </div>
        </div>
    </div>
</div>

@section('js')
    @livewireScripts
@endsection
