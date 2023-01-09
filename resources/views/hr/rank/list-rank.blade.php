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
                                <th>Salary</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @foreach($ranks as $rank)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rank->name }}</td>
                                    <td>{{ number_format($rank->salary,2) }}</td>
                                    <td>{!! $rank->enabled == 1 ? label("Active","success") : label("Inactive","danger") !!}</td>
                                    <td>
                                        @if (userCanView('department.toggle'))
                                            @if($rank->enabled == 1)
                                                <a href="{{ route('rank.toggle',$rank->id) }}" class="btn btn-danger btn-sm">Disable</a>
                                            @else
                                                <a href="{{ route('rank.toggle',$rank->id) }}" class="btn btn-success btn-sm">Enable</a>
                                            @endif
                                        @endif
                                        @if (userCanView('rank.edit'))
                                            <a href="{{ route('rank.edit',$rank->id) }}" class="btn btn-success btn-sm">Edit</a>
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
                            <form id="validate" action="{{ route('rank.store') }}" enctype="multipart/form-data" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="{{ old('name') }}" required  class="form-control" name="name" placeholder="Name"/>
                                    @if ($errors->has('name'))
                                        <label for="name-error" class="error"
                                               style="display: inline-block;">{{ $errors->first('name') }}</label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Salary</label>
                                    <input type="number" value="{{ old('salary') }}" required  class="form-control" name="salary" placeholder="Salary"/>
                                    @if ($errors->has('salary'))
                                        <label for="name-error" class="error"
                                               style="display: inline-block;">{{ $errors->first('salary') }}</label>
                                    @endif
                                </div>
                                <input type="hidden" name="status" value="1">
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
