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
                            @foreach($allowances as $allowance)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $allowance->name }}</td>
                                    <td>{!! $allowance->default == 1 ? label("Yes","success") : label("No","danger") !!}</td>
                                    <td>{!! $allowance->enabled == 1 ? label("Active","success") : label("Inactive","danger") !!}</td>
                                    <td>
                                        @if (userCanView('allowance.toggle'))
                                            @if($allowance->enabled == 1)
                                                <a href="{{ route('allowance.toggle',$allowance->id) }}" class="btn btn-danger btn-sm">Disable</a>
                                            @else
                                                <a href="{{ route('allowance.toggle',$allowance->id) }}" class="btn btn-success btn-sm">Enable</a>
                                            @endif
                                    @endif
                                     @if (userCanView('allowance.edit'))
                                                <a href="{{ route('allowance.edit',$allowance->id) }}" class="btn btn-success btn-sm">Edit</a>
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
                            <form id="validate" action="{{ route('allowance.store') }}" enctype="multipart/form-data" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="{{ old('name') }}" required  class="form-control" name="name" placeholder="Allowance Name"/>
                                    @if ($errors->has('name'))
                                        <label for="name-error" class="error"
                                               style="display: inline-block;">{{ $errors->first('name') }}</label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Default</label>
                                    <select class="form-control" name="default">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
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
