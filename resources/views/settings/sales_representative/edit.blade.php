@extends('layouts.app')

@section('content')
    <div class="ui-container">
        <div class="row">
                <div class="col-md-4">
                <section class="panel">
                    <header class="panel-heading">
                        {{ $title }}
                    </header>
                    <div class="panel-body">
                        <form id="validate" action="{{ route('sales_representative.update',$rep->id) }}" enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" value="{{ old('fullname',$rep->fullname) }}" required  class="form-control" name="fullname" placeholder="Full Name"/>
                                @if ($errors->has('fullname'))
                                    <label for="name-error" class="error"
                                           style="display: inline-block;">{{ $errors->first('fullname') }}</label>
                                @endif
                            </div>


                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" value="{{ old('username',$rep->username) }}" required  class="form-control" name="username" placeholder="Username"/>
                                @if ($errors->has('username'))
                                    <label for="name-error" class="error"
                                           style="display: inline-block;">{{ $errors->first('username') }}</label>
                                @endif
                            </div>



                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" value="{{ old('email_address',$rep->email_address) }}" required  class="form-control" name="email_address" placeholder="Email Address"/>
                                @if ($errors->has('email_address'))
                                    <label for="name-error" class="error"
                                           style="display: inline-block;">{{ $errors->first('email_address') }}</label>
                                @endif
                            </div>


                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" value="{{ old('address',$rep->address) }}" required  class="form-control" name="address" placeholder="Address"/>
                                @if ($errors->has('address'))
                                    <label for="name-error" class="error"
                                           style="display: inline-block;">{{ $errors->first('address') }}</label>
                                @endif
                            </div>



                            <div class="pull-left">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                            </div>
                            <br/> <br/>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
