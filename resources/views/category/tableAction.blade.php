
{!! link_to_route(
                                                'category.show', 'Show', $category->id,
                                                ['class' => 'action-datatable btn btn-info'] )
                            !!}
{!! link_to_route(
                'category.edit', 'Edit', $category->id,
                ['class' => 'action-datatable btn btn-info'] )
!!}
@if($category->deleted_at == '')
        {!! Form::open([
                        'method' => 'DELETE',
                        'route' => [
                                'category.destroy',
                                $category->id,
                                ],
                        'id' => "delete-$category->id",
                        'onclick'=>"return confirm('Are you sure you want to delete : $category->name?')",
                        'class' => 'action-datatable'
                        ])
        !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
@else
        {!! Form::open([
                        'method' => 'POST',
                        'route' => [
                                'category.restore',
                                $category->id,
                                ],
                        'id' => "restore-$category->id",
                        'onclick'=>"return confirm('Are you sure you want to restore : $category->name?')",
                        'class' => 'action-datatable'
                        ])
        !!}
                {!! Form::submit('Restore', ['class' => 'btn btn-success']) !!}
        {!! Form::close() !!}
@endif
