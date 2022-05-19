@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <h1>Category<span> List</span></h1>
                    {!! link_to_route('category.create', 'Add', null, ['class' => 'btn btn-primary m-b-10 m-l-5']) !!}
                </div>
            </div>
        </div>
    </div>
    <!-- /# row -->
    <section id="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="bootstrap-data-table-panel">
                        <div class="table-responsive"> 
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Category Code</th>
                                        <th>Parent Category Code</th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>
            <!-- /# column -->
        </div>
        <!-- /# row -->
    </section>
@endsection
@section('pagescript')
<script>
    $('.table').DataTable({
            processing: false,
            serverSide: true,
            responsive: false,
            stateSave: true,
            //autoWidth: true,
            scrollX: true,
            "bDestroy": true,
            //scrollCollapse: true,
            ajax: '{{ route('category.datatable.list') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'category_code', name: 'category_code' },
                { data: 'parent_category_name', name: 'parent_category_name' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            order: [[3,'desc']],
        });
</script>
@endsection