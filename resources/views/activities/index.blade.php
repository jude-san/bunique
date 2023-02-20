@extends('layouts.dashboard')
@section('page_content')
    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Activities</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item">Activities</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <button class="btn btn-success btn-icon float-right" type="button"><i class="zmdi zmdi-plus"></i></button>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <h4>Notes</h4>
                <form class="row" action="{{ route('activity.store') }}" method="POST">
                    <div class="col-md-12">@include('layouts.error_messages')</div>
                    @csrf
                    @method('POST')
                    <div class="form-group col-md-4">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="4"></textarea>
                    </div>
                    <div class="form-group col-md-4 mt-4">
                        <button type="submit" class="btn btn-primary">Submit Activity</button>
                    </div>
                </form>
                <div class="table-responsive">
                    {!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}
                </div>
            </div>
        </div>
    </section>
@endsection
@push('page_js')
    {!! $dataTable->scripts() !!}
@endpush
