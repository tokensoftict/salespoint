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
                            <form id="validate" action="{{ route('rank.update',$rank->id) }}" enctype="multipart/form-data" method="post">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="{{ old('name', $rank->name) }}" required  class="form-control" name="name" placeholder="Name"/>
                                    @if ($errors->has('name'))
                                        <label for="name-error" class="error"
                                               style="display: inline-block;">{{ $errors->first('name') }}</label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Salary</label>
                                    <input type="number"  value="{{ old('salary', $rank->salary) }}" required  class="form-control" name="salary" placeholder="Salary"/>
                                    @if ($errors->has('salary'))
                                        <label for="name-error" class="error"
                                               style="display: inline-block;">{{ $errors->first('salary') }}</label>
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
