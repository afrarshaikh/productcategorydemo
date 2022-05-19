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
                        <a href="#1" aria-controls="1" role="tab" data-toggle="tab">Category: {!! $category->name !!}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="1">
                            <div class="contact-information">
                                <div class="phone-content">
                                <span class="contact-title">Name:</span>
                                <span class="phone-number">{!! $category->name !!}</span>
                                </div>
                                <div class="address-content">
                                <span class="contact-title">Category Code:</span>
                                <span class="mail-address">{!! $category->category_code !!}</span>
                                </div>
                                @if(!empty($category->parent_category_id))
                                <div class="email-content">
                                <span class="contact-title">Parent Category:</span>
                                    <span class="contact-email">
                                        {!! link_to_route(
                                                            'category.show', $category->parentcat->name, $category->parentcat->id,
                                                            ['class' => 'btn btn-link'] )
                                        !!}
                                    </span>
                                    </div>        
                                @endif
                                <div class="website-content">
                                <span class="contact-title">&nbsp;</span>
                                <span class="contact-website">{!! link_to_route('category.index', 'Back', null, ['class' => 'btn btn-link']) !!}</span>
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