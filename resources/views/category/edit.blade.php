@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-title">
            <h4>Edit Category : {!! $category->name !!}</h4>
            </div>
            <div class="card-body">
                <div class="input-states">
                    {!! Form::model($category, [
                                'route' => ['category.update', $category->id],
                                'method' => 'PATCH',
                                'class' => 'form-horizontal'
                                ]) !!}
                            @include('category.form', ['update', true])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /# column -->
@endsection