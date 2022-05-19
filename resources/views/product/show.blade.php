@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            <div class="user-profile">
                <div class="row">
                <div class="col-lg-12">
                    <div class="custom-tab user-profile-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                        <a href="#1" aria-controls="1" role="tab" data-toggle="tab">Product: {!! $product->name !!}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="1">
                            <div class="contact-information">
                                <div class="phone-content">
                                <span class="contact-title">Name:</span>
                                <span class="phone-number">{!! $product->name !!}</span>
                                </div>
                                <div class="address-content">
                                <span class="contact-title">product Code:</span>
                                <span class="mail-address">{!! $product->product_code !!}</span>
                                </div>
                                @if(sizeof($product->category) > 0 )
                                <div class="email-content">
                                <span class="contact-title">Category:</span>
                                    <span class="contact-email">
                                        @foreach ($product->category as $category)
                                        {!! link_to_route(
                                                                'category.show', $category->name, $category->id,
                                                                ['class' => 'btn btn-link'] )
                                            !!}
                                        @endforeach
                                    </span>
                                    </div>        
                                @endif
                                <div class="website-content">
                                <span class="contact-title">&nbsp;</span>
                                <span class="contact-website">{!! link_to_route('product.index', 'Back', null, ['class' => 'btn btn-link']) !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /# column -->
@endsection