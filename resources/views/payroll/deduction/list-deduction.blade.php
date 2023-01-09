@extends('layouts.app')


@section('content')
    <div class="ui-container">
        <div class="row">
            <div class="col-md-8">
                <section class="panel">
                    <header class="panel-heading">
                        {{ $title }}
                    </header>
                    <div class="panel-body">
                        @if(session('success'))
                            {!! alert_success(session('success')) !!}
                        @elseif(session('error'))
                            {!! alert_error(session('error')) !!}
                        @endif

                        <table class="table table-hover table-hover">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Default</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @foreach($deductions as $deduction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $deduction->name }}</td>
                                    <td>{!! $deduction->default == 1 ? label("Yes","success") : label("No","danger") !!}</td>
                                    <td>{!! $deduction->enabled == 1 ? label("Active","success") : label("Inactive","danger") !!}</td>
                                    <td>
                                        @if (userCanView('deduction.toggle') && $deduction->default != 1)
                                            @if($deduction->enabled == 1)
                                                <a href="{{ route('deduction.toggle',$deduction->id) }}" class="btn btn-danger btn-sm">Disable</a>
                                            @else
                                                <a href="{{ route('deduction.toggle',$deduction->id) }}" class="btn btn-success btn-sm">Enable</a>
                                            @endif
                                    @endif
                                     @if (userCanView('deduction.edit') && $deduction->default != 1)
                                                <a href="{{ route('deduction.edit',$deduction->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    @endif
                                </tr>
                            @endforeach
                        </table>

                    </div>
                </section>
            </div>
            @if(userCanView('category.create'))
                <div class="col-md-4">
                    <section class="panel">
                        <header class="panel-heading">
                            {{ $title2 }}
                        </header>
                        <div class="panel-body">
                            <form id="validate" action="{{ route('deduction.store') }}" enctype="multipart/form-data" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="{{ old('name') }}" required  class="form-control" name="name" placeholder="deduction Name"/>
                                    @if ($errors->has('name'))
                                        <label for="name-error" class="error"
                                               style="display: inline-block;">{{ $errors->first('name') }}</label>
                                    @endif
                                </div>
                                <!--
                             <div class="form-group">
                                 <label>Default</label>
                                 <select class="form-control" name="default">
                                     <option value="0">No</option>
                                     <option value="1">Yes</option>
                                 </select>
                             </div>
                             -->
                                <input type="hidden" value="0" name="default"/>
                                <div class="pull-left">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                </div>
                                <br/> <br/>
                            </form>
                        </div>
                    </section>
                </div>
            @endif
        </div>
    </div>

@endsection
