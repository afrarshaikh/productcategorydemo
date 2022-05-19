<div class="form-group">
    <div class="row">
        {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {{Form::text('name',isset($product->name) ? $product->name :'' ,['class'=>'form-control','maxlength'=>'50'])}}  
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        {!! Form::label('name', 'Product Code', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {{Form::text('name',$product_code ,['class'=>'form-control','disabled'=>true])}}
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        {!! Form::label('name', 'Product Image', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {{Form::file('image',['class'=>'form-control','accept'=>'image/*','onChange'=>'ValidateSize(this)'])}}
            <span>Note: Did not get chance to implement remove image after upload </span>
        </div>
    </div>
</div>
<!-- Note: Did not get chance to implement remove image  -->
@if(isset($product->image) && !empty($product->image))
    <div class="form-group">
        <div class="row">
            <img src="{{asset('uploads/'.$product->image)}}" class="img-rounded" alt="{{ $product->name }}" width="304" height="236">
        </div>
    </div>
@endif
<div class="form-group">
    <div class="row">
            {!! Form::label('product_category_ids', 'Category Code', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {{Form::select('product_category_ids[]',$all_categoies,isset($product_categoies) ? $product_categoies :[],['class'=>'form-control','multiple'=>'multiple'])}}  
        </div>
    </div>
</div>
{!! link_to_route('product.index', 'Back', null, ['class' => 'btn btn-link']) !!}
@if(isset($product))
    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
@else
    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
@endif
<script>
    //check file size 
    function ValidateSize(file) {
        var FileSize = file.files[0].size / 1024 / 1024; // in MiB
        if (FileSize > 2) {
            alert('File size exceeds 2 MB');
            $(file).val(''); //for clearing with Jquery
        } else {

        }
    }
</script>
