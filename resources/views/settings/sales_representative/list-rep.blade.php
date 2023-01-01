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
                                    <th>Full name</th>
                                    <th>Username</th>
                                    <th>Email Address</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($reps as $rep)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $rep->fullname }}</td>
                                        <td>{{ $rep->username }}</td>
                                        <td>{{ $rep->email_address }}</td>
                                        <td>{{ $rep->address }}</td>
                                        <td>{!! $rep->status == 1 ? label("Active","success") : label("Inactive","danger") !!}</td>
                                        <td>
                                            @if (userCanView('sales_representative.toggle'))
                                                @if($rep->status == 1)
                                                    <a href="{{ route('sales_representative.toggle',$rep->id) }}" class="btn btn-danger btn-sm">Disable</a>
                                                @else
                                                    <a href="{{ route('sales_representative.toggle',$rep->id) }}" class="btn btn-success btn-sm">Enable</a>
                                                @endif
                                            @endif

                                                @if (userCanView('sales_representative.edit'))
                                                    <a href="{{ route('sales_representative.edit',$rep->id) }}" class="btn btn-success btn-sm">Edit</a>
                                                @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                    </div>
                </section>
            </div>
            @if(userCanView('bank.create'))
                <div class="col-md-4">
                <section class="panel">
                    <header class="panel-heading">
                        {{ $title2 }}
                    </header>
                    <div class="panel-body">
                        <form id="validate" action="{{ route('sales_representative.store') }}" enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" value="{{ old('fullname') }}" required  class="form-control" name="fullname" placeholder="Full Name"/>
                                @if ($errors->has('fullname'))
                                    <label for="name-error" class="error"
                                           style="display: inline-block;">{{ $errors->first('fullname') }}</label>
                                @endif
                            </div>


                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" value="{{ old('username') }}" required  class="form-control" name="username" placeholder="Username"/>
                                @if ($errors->has('username'))
                                    <label for="name-error" class="error"
                                           style="display: inline-block;">{{ $errors->first('username') }}</label>
                                @endif
                            </div>



                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" value="{{ old('email_address') }}" required  class="form-control" name="email_address" placeholder="Email Address"/>
                                @if ($errors->has('email_address'))
                                    <label for="name-error" class="error"
                                           style="display: inline-block;">{{ $errors->first('email_address') }}</label>
                                @endif
                            </div>


                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" value="{{ old('address') }}" required  class="form-control" name="address" placeholder="Address"/>
                                @if ($errors->has('address'))
                                    <label for="name-error" class="error"
                                           style="display: inline-block;">{{ $errors->first('address') }}</label>
                                @endif
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
