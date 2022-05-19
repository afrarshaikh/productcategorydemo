<div class="form-group">
    <div class="row">
        {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {{Form::text('name',isset($category->name) ? $category->name :'' ,['class'=>'form-control','maxlength'=>'50'])}}  
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        {!! Form::label('name', 'Category Code', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {{Form::text('name',$category_code ,['class'=>'form-control','disabled'=>true])}}
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
            {!! Form::label('name', 'Parent Category Code', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {{Form::select('parent_category_id',$categories,isset($category->parent_category_id) ? $category->parent_category_id :'',['class'=>'form-control'])}}  
        </div>
    </div>
</div>
{!! link_to_route('category.index', 'Back', null, ['class' => 'btn btn-link']) !!}
@if(isset($category))
    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
@else
    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
@endif
