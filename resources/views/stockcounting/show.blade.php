@extends('layouts.app')

@push('css')
    <link href="{{ asset('bower_components/datatables/media/css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-tabletools/css/dataTables.tableTools.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-colvis/css/dataTables.colVis.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-responsive/css/responsive.dataTables.scss') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-scroller/css/scroller.dataTables.scss') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="ui-container">
        <div class="row">
            <div class="col-sm-12">
                @if(session('success'))
                    {!! alert_success(session('success')) !!}
                @elseif(session('error'))
                    {!! alert_error(session('error')) !!}
                @endif
                <section class="panel">
                    <header class="panel-heading">
                        {{ $title }}
                        <span class="tools pull-right">
                            @if(userCanView('counting.destroy') && $counting->status == "Pending")
                                <a href="{{ route('counting.destroy',$counting->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                &nbsp; &nbsp; &nbsp;
                            @endif

                            @if(userCanView('counting.export_excel'))
                                <a  href="{{ route('counting.export_excel',$counting->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Export Excel</a>
                                &nbsp; &nbsp; &nbsp;
                            @endif
                            @if(userCanView('counting.import_excel'))
                                <a  href="#" data-toggle="modal" data-target="#myModal"  class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Import Excel</a>
                                &nbsp; &nbsp; &nbsp;
                            @endif
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Name</label><br/>
                                    <span class="form-control">{{ $counting->name }}</span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Date</label><br/>
                                    <span class="form-control">{{ convert_date2($counting->date) }}</span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Created By</label><br/>
                                    <span class="form-control">{{ $counting->user->name }}</span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Status</label><br/>
                                    <span class="form-control">{!! showStatus($counting->status) !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 12px;">
                            <div class="col-sm-12">
                                <h4>Stock List</h4>
                                <table class="table table-bordered table-responsive table convert-data-table table-striped" style="font-size: 12px">
                                    <thead>
                                    <tr>
                                        <th>Stock Name</th>
                                        <th>Available Quantity</th>
                                        <th>Available Yard Quantity</th>
                                        <th>Counted Quantity</th>
                                        <th>Counted Yard Quantity</th>
                                        <th>Quantity Difference</th>
                                        <th>Quantity Yard Difference</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($counting->stock_taking_items as $count)
                                        <tr>
                                            <td>{{ $count->stock->name }}</td>
                                            <td>{{ $count->available_quantity }}</td>
                                            <td>{{ $count->available_yard_quantity }}</td>
                                            <td>{{ $count->counted_available_quantity }}</td>
                                            <td>{{ $count->counted_yard_quantity }}</td>
                                            <td>{{ $count->available_quantity_diff }}</td>
                                            <td>{{ $count->available_yard_quantity_diff }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    @if(userCanView('counting.import_excel'))
        <div id="myModal" class="modal fade" role="dialog">
            <form action="{{ route('counting.import_excel',$counting->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Imported Counted Stock</h4>
                        </div>
                        <div class="modal-body">
                            <input type="file" name="excel_file"/>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default">Upload</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endif
@endsection


@push('js')
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables-tabletools/js/dataTables.tableTools.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables-colvis/js/dataTables.colVis.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables-responsive/js/dataTables.responsive.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables-scroller/js/dataTables.scroller.js') }}"></script>
    <script src="{{ asset('assets/js/init-datatables.js') }}"></script>
@endpush
