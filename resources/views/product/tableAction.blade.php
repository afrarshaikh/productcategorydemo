
{!! link_to_route(
                                                'product.show', 'Show', $product->id,
                                                ['class' => 'action-datatable btn btn-info'] )
                            !!}
{!! link_to_route(
                                                'product.edit', 'Edit', $product->id,
                                                ['class' => 'action-datatable btn btn-info'] )
                            !!}
@if($product->deleted_at == '')
        {!! Form::open([
                        'method' => 'DELETE',
                        'route' => [
                                'product.destroy',
                                $product->id,
                                ],
                        'id' => "delete-$product->id",
                        'onclick'=>"return confirm('Are you sure you want to delete : $product->name?')",
                        'class' => 'action-datatable'
                        ])
        !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
@else
        {!! Form::open([
                        'method' => 'POST',
                        'route' => [
                                'product.restore',
                                $product->id,
                                ],
                        'id' => "restore-$product->id",
                        'onclick'=>"return confirm('Are you sure you want to restore : $product->name?')",
                        'class' => 'action-datatable'
                        ])
        !!}
                {!! Form::submit('Restore', ['class' => 'btn btn-success']) !!}
        {!! Form::close() !!}
@endif
