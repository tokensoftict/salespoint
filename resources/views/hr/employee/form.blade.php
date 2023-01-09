@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}">
@endpush

@section('content')

    <div class="ui-container">
        @if(isset($employee->id))
            <form role="form"  action="{{ route('employee.update',$employee->id) }}" enctype="multipart/form-data" method="post">
                {{ method_field('PUT') }}
        @else
           <form role="form"  action="{{ route('employee.store') }}" enctype="multipart/form-data" method="post">
       @endif
               {{ csrf_field() }}

               <div class="row">
                   <div class="col-md-4">
                       @if(session('success'))
                           {!! alert_success(session('success')) !!}
                       @elseif(session('error'))
                           {!! alert_error(session('error')) !!}
                       @endif
                       <section class="panel">
                           <header class="panel-heading panel-border">
                               Basic Information
                           </header>
                           <div class="panel-body" >

                               <div class="form-group">
                                   <label>Surname <span  style="color:red;">*</span></label>
                                   <div class="input-group col-md-12">
                                       <input type="text" value="{{ old('surname', $employee->surname) }}" required  class="form-control" id="surname" name="surname" placeholder="Surname"/>
                                   </div>
                                   @if ($errors->has('surname'))
                                       <label for="name-error" class="error"
                                              style="display: inline-block;">{{ $errors->first('surname') }}</label>
                                   @endif
                               </div>

                               <div class="form-group">
                                   <label>Other names <span  style="color:red;">*</span></label>
                                   <div class="input-group col-md-12">
                                       <input type="text" value="{{ old('other_names', $employee->other_names) }}" required  class="form-control" id="other_names" name="other_names" placeholder="Other names"/>
                                   </div>
                                   @if ($errors->has('other_names'))
                                       <label for="name-error" class="error"
                                              style="display: inline-block;">{{ $errors->first('other_names') }}</label>
                                   @endif
                               </div>

                               <div class="form-group">
                                   <label>Gender  <span style="color:red;">*</span></label>
                                   <select class="form-control" required name="gender">
                                       <option {{ old("gender",$employee->gender) == "Male" ? "selected" : "" }} value="Male">Male</option>
                                       <option {{ old("gender",$employee->gender) == "Female" ? "selected" : "" }} value="Female">Female</option>
                                   </select>
                               </div>

                               <div class="form-group">
                                   <label>Date Of Birth</label>
                                   <div class="input-group col-md-12">
                                       <input type="text" value="{{ old('dob', $employee->dob) }}" required  class="form-control datepicker js-datepicker" data-min-view="2" data-date-format="yyyy-mm-dd" id="dob" name="dob" placeholder="Date Of Birth"/>
                                   </div>
                                   @if ($errors->has('dob'))
                                       <label for="name-error" class="error"
                                              style="display: inline-block;">{{ $errors->first('dob') }}</label>
                                   @endif
                               </div>


                               <div class="form-group">
                                   <label>Email Address</label>
                                   <input placeholder="Email Address" value="{{ old("email",$employee->email) }}" type="email" name="email" class="form-control">
                               </div>


                               <div class="form-group">
                                   <label>Phone Number</label>
                                   <input placeholder="Phone Number" value="{{ old("phone",$employee->phone) }}" type="text" name="phone" class="form-control">
                               </div>

                               <div class="form-group">
                                   <label>Address</label>
                                   <textarea placeholder="Address"  name="address" class="form-control">{{ old("address",$employee->address) }}</textarea>
                               </div>


                               <div class="form-group">
                                   <label>Marital Status</label>
                                   <select class="form-control" required name="marital_status">
                                       <option {{ old("marital_status",$employee->marital_status) == "Single" ? "selected" : "" }} value="Single">Single</option>
                                       <option {{ old("marital_status",$employee->marital_status) == "Married" ? "selected" : "" }} value="Married">Married</option>
                                       <option {{ old("marital_status",$employee->marital_status) == "Divorced" ? "selected" : "" }} value="Divorced">Divorced</option>
                                       <option {{ old("marital_status",$employee->marital_status) == "Widowed" ? "selected" : "" }} value="Widowed">Widowed</option>
                                   </select>
                               </div>

                           </div>
                       </section>
                   </div>
                   <div class="col-md-4">
                       <section class="panel">
                           <header class="panel-heading panel-border">
                               Official Information
                           </header>

                           <div class="panel-body" >
                               <div class="form-group">
                                   <label>Employee Status </label>
                                   <select class="form-control" required name="status">
                                       <option {{ old('status', $employee->status) == "1" ? "selected" : "" }} value="1">Enabled</option>
                                       <option {{ old('status', $employee->status) == "0" ? "selected" : "" }} value="0">Disabled</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <label>Scale</label>
                                   <select class="form-control" name="scale_id">
                                       <option value="">-Select Scale-</option>
                                       @foreach($scales as $scale)
                                           <option {{ old('scale_id', $employee->scale_id) == $scale->id ? "selected" : ""  }} value="{{ $scale->id }}">{{ $scale->name }}</option>
                                       @endforeach
                                   </select>
                               </div>

                               <div class="form-group">
                                   <label>Rank </label>
                                   <select class="form-control" name="rank_id">
                                       <option value="">-Select Rank-</option>
                                       @foreach($ranks as $rank)
                                           <option {{ old('rank_id', $employee->rank_id) == $rank->id ? "selected" : ""  }} value="{{ $rank->id }}">{{ $rank->name }}</option>
                                       @endforeach
                                   </select>
                               </div>

                               <div class="form-group">
                                   <label>Designation </label>
                                   <select class="form-control" name="designation_id">
                                       <option value="">-Select Designation-</option>
                                       @foreach($designations as $designation)
                                           <option {{ old('designation_id', $employee->designation_id) == $designation->id ? "selected" : ""  }} value="{{ $designation->id }}">{{ $designation->name }}</option>
                                       @endforeach
                                   </select>
                               </div>

                               <div class="form-group">
                                   <label>Salary</label>
                                   <input type="number" step="0.00001"  value="{{ old('salary',$employee->salary) }}"  class="form-control" name="salary" placeholder="Salary"/>
                               </div>

                               <input type="hidden" name="permanent" value="1">
                           </div>
                       </section>

                       <section class="panel">
                           <header class="panel-heading panel-border">
                               Bank Account Information
                           </header>
                           <div class="panel-body">
                               <div class="form-group">
                                   <label>Bank </label>
                                   <select class="form-control" name="bank_id">
                                       <option value="">-Select Bank-</option>
                                       @foreach($banks as $bank)
                                           <option {{ old('bank_id', $employee->bank_id) == $bank->id ? "selected" : ""  }} value="{{ $bank->id }}">{{ $bank->name }}</option>
                                       @endforeach
                                   </select>
                               </div>

                               <div class="form-group">
                                   <label>Bank Account Number</label>
                                   <input type="text"  value="{{ old('bank_account_no',$employee->bank_account_no) }}"   class="form-control" name="bank_account_no" placeholder="Bank Account Number"/>
                               </div>


                               <div class="form-group">
                                   <label>Bank Account Name</label>
                                   <input type="text"  value="{{ old('bank_account_name',$employee->bank_account_name) }}"   class="form-control" name="bank_account_name" placeholder="Bank Account Name"/>
                               </div>

                           </div>
                       </section>
                   </div>
                   <div class="col-md-4">
                       <section class="panel">
                           <header class="panel-heading panel-border">
                              Passport
                           </header>
                           <div class="panel-body" >
                           @if(isset($employee->photo))
                               <img src="{{ $employee->image }}" id="product_image" class="img-thumbnail"/>
                               <br/>
                           @else
                               <img src="{{ asset('assets/products.jpg') }}" id="product_image" class="img-thumbnail"/>
                               <br/>
                           @endif
                           <br>
                           <input type="file" class="form-control" name="photo">
                           </div>

                       </section>
                       <section class="panel">

                           <div class="panel-body" >
                               <input class="btn btn-info btn-block btn-lg" type="submit" name="save" value="Save Employee">
                           </div>
                       </section>
                   </div>
               </div>

           </form>
    </div>

@endsection

@push('js')
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script data-turbolinks-eval="false" data-turbo-eval="false" src="{{ asset('assets/js/init-datepicker.js') }}"></script>
@endpush
