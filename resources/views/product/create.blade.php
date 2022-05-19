@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-title">
                <h4>Create Product</h4>
            </div>
            <div class="card-body">
                <div class="input-states">
                    {!! Form::open(['route'=> 'product.store', 'method' => 'POST', 'class' => 'form-horizontal','files'=>'true']) !!}
                            @include('product.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /# column -->
@endsection