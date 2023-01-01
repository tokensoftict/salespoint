@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}">
    <link href="{{ asset('bower_components/datatables/media/css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-tabletools/css/dataTables.tableTools.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-colvis/css/dataTables.colVis.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-responsive/css/responsive.dataTables.scss') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables-scroller/css/scroller.dataTables.scss') }}" rel="stylesheet">
@endpush


@section('content')
    <div class="ui-container">
        <div class="row">
            <div class="col-md-9">
                <section class="panel">
                    @if(session('success'))
                        {!! alert_success(session('success')) !!}
                    @elseif(session('error'))
                        {!! alert_error(session('error')) !!}
                    @endif
                    <div class="panel-heading">
                        {{ $title2 }}
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-responsive table convert-data-table table-striped" style="font-size: 10px">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Stock</th>
                                <th>Quantity</th>
                                <th>Date</th>
                                <th>Product Type</th>
                                <th>Usage Type</th>
                                <th>Department</th>
                                <th>Selling Price</th>
                                <th>Cost Price</th>
                                <th>By</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $log)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $log->stock->name }}</td>
                                    <td>{{ $log->quantity }}</td>
                                    <td>{{ convert_date2($log->log_date) }}</td>
                                    <td>{{ array_search($log->product_type,config('stock_type_name.'.config('app.store'))) }}</td>
                                    <td>{{ $log->usage_type }}</td>
                                    <td>{{ $log->department }}</td>
                                    <td>{{ number_format($log->selling_price,2) }}</td>
                                    <td>{{ number_format($log->cost_price,2) }}</td>
                                    <td>{{ $log->user->name }}</td>
                                    <td>
                                        @if(userCanView('stocklog.edit',$log->id))
                                            <a href="{{ route('stocklog.edit',$log->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        @endif
                                        @if(userCanView('stocklog.delete_log',$log->id))
                                            <a href="{{ route('stocklog.delete_log',$log->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                        @endif
                                    </td>
                                </tr>
                                 @empty

                                 @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
            <div class="col-md-3">
                <section class="panel">
                    <div class="panel-heading">
                        {{ $title }}
                    </div>
                    <div class="panel-body">
                        <form  action="{{ route('stocklog.add_log') }}" enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Select Stock</label>
                                <select name="stock_id"  class="form-control select2" id="products">
                                    <option value="">-Select One-</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label style="white-space: nowrap;">Quantity</label>
                                <input required type="number" name="qty" placeholder="Quantity" class="form-control" id="qty"/>
                            </div>

                            <div class="form-group" >
                                <label>Select Usage Type</label>
                                <select required id="usage_type" name="usage_type" class="form-control">
                                    @if(config('app.store') == "hotel")
                                    <option value="">-Select One-</option>
                                    @endif
                                    <option value="DAMAGES">DAMAGES</option>
                                    @if(config('app.store') == "hotel")
                                        <option value="USED">IN-STORE USED</option>
                                    @endif
                                </select>
                                @if ($errors->has('usage_type'))
                                    <label for="name-error" class="error"
                                           style="display: inline-block;">{{ $errors->first('supplier') }}</label>
                                @endif
                            </div>

                            @if(config('app.store') == "hotel")
                                <div cclass="form-group">
                                    <label>Select Department</label>
                                    <select required id="department" name="department" class="form-control select2">
                                        @foreach(config('app.departments.'.config('app.store')) as $department)
                                            <option  value="{{ $department }}">{{ $department }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('department'))
                                        <label for="name-error" class="error"
                                               style="display: inline-block;">{{ $errors->first('department') }}</label>
                                    @endif
                                    <input type="hidden" id="product_type" name="product_type" value="BAR STOCK" />
                                </div>
                            @else
                                <div class="form-group">
                                    <label>Select Product Type</label>
                                    <select required id="product_type" name="product_type" class="form-control select2">
                                        @foreach(config('stock_type_name.'.config('app.store')) as $key=>$type)
                                            <option  value="{{ $type }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('product_type'))
                                        <label for="name-error" class="error"
                                               style="display: inline-block;">{{ $errors->first('product_type') }}</label>
                                    @endif
                                </div>
                                <input type="hidden" id="department" name="department" value="STORE" />
                            @endif

                            <div class="form-group">
                                <label>Select Store</label>
                                <select required id="store" name="store" class="form-control select2">
                                    @foreach($stores as $store)
                                        <option  value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('store'))
                                    <label for="name-error" class="error"
                                           style="display: inline-block;">{{ $errors->first('store') }}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <input class="form-control datepicker js-datepicker" data-min-view="2" data-date-format="yyyy-mm-dd" style="background-color: #FFF; color: #000;"  name="date_created" value="{{ \Carbon\Carbon::today()->toDateString() }}"/>
                                @if ($errors->has('date_created'))
                                    <label for="name-error" class="error"
                                           style="display: inline-block;">{{ $errors->first('date_created') }}</label>
                                @endif
                            </div>
                            <button class="btn btn-primary btn-lg" type="submit" name="save" value="save_and_create"><i class="fa fa-save"></i> Log Stock</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="{{ asset('bower_components/select2/dist/js/select2.min.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="{{ asset('assets/js/init-select2.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables-tabletools/js/dataTables.tableTools.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables-colvis/js/dataTables.colVis.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables-responsive/js/dataTables.responsive.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false"  src="{{ asset('bower_components/datatables-scroller/js/dataTables.scroller.js') }}"></script>
    <script src="{{ asset('assets/js/init-datatables.js') }}"></script>
    <script  src="{{ asset('assets/js/init-datepicker.js') }}"></script>
    <script>
        $(document).ready(function(e){
            var path = "{{ route('findselectstock') }}?select2=yes";
            var select =  $('#products').select2({
                placeholder: 'Search for product',
                ajax: {
                    url: path,
                    dataType: 'json',
                    delay: 250,
                    data: function (data) {
                        return {
                            searchTerm: data.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results:response
                        };
                    },
                }
            });


            $("#products").on('change',function(eventData){
                var data = $(this).select2('data');
                data = data[0];
            });

        });
    </script>
@endpush
