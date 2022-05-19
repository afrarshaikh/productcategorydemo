@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-title">
                <h4>Create Category</h4>
            </div>
            <div class="card-body">
                <div class="input-states">
                    {!! Form::open(['route'=> 'category.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                            @include('category.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /# column -->
@endsection