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
                            <form id="validate" action="{{ route('deduction.update',$deduction->id) }}" enctype="multipart/form-data" method="post">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="{{ old('name', $deduction->name) }}" required  class="form-control" name="name" placeholder="Deduction"/>
                                    @if ($errors->has('name'))
                                        <label for="name-error" class="error"
                                               style="display: inline-block;">{{ $errors->first('name') }}</label>
                                    @endif
                                </div>
                                <!--
                                <div class="form-group">
                                    <label>Default</label>
                                    <select class="form-control" name="default">
                                        <option {{ old('default',$deduction->default) == "0" ? 'selected' : "" }} value="0">No</option>
                                        <option {{ old('default',$deduction->default) == "1" ? 'selected' : "" }} value="1">Yes</option>
                                    </select>
                                </div>
                                -->
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
