@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-title">
            <h4>Edit Product : {!! $product->name !!}</h4>
            </div>
            <div class="card-body">
                <div class="input-states">
                    {!! Form::model($product, [
                                'route' => ['product.update', $product->id],
                                'method' => 'PATCH',
                                'class' => 'form-horizontal',
                                'files'=>'true'
                                ]) !!}
                            @include('product.form', ['update', true])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /# column -->
@endsection