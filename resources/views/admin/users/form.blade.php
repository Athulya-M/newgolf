@extends('layouts.admin.master')
@section('title')
{{ isset($user) ? __('Edit User') : __('Add User') }}
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush
@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>{{ isset($user) ? __('Edit User') : __('Add User') }}</h3>
@endslot
<li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ __('Users') }}</a></li>
<li class="breadcrumb-item active">{{ isset($user) ?  __('Edit User') : __('Add User') }}</li>
@endcomponent
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-body">
               <form class="needs-validation" enctype="multipart/form-data" novalidate="" method="POST" action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}">
                  @isset($user)
                  @method('PUT')
                  <input type="hidden" name="id" value="{{ $user->id }}">
                  @endisset
                  @csrf
                  <div class="row">
                     <div class="col-md-6">
                        <label class="form-label" for="validationCustom04">{{ __('First Name') }}</label>
                        <input type="text" class="form-control" id="validationCustom04" name="first_name" placeholder="{{ __('First Name') }}"  required="" id="validationCustom01" value="{{ isset($user) ? $user->first_name : old('first_name')  }}" />
                        <div class="invalid-feedback">{{ __('Please enter your first name.') }}</div>
                        @if ($errors->has('first_name'))
                        <div class="alert alert-danger mt-1 mb-1">{{ $errors->first('first_name') }}</div>
                        @endif
                     </div>
                     <div class="col-md-6">
                        <label class="form-label" for="validationCustom01">{{ __('Last Name') }}</label>
                        <input  class="form-control" id="" type="text" name="last_name"   required="" placeholder="{{ __('Last Name') }}" value="{{ isset($user) ? $user->last_name :  old('last_name') }}" />
                        <div class="invalid-feedback">{{ __('Please enter your last name.') }}</div>
                        @if ($errors->has('last_name'))
                        <div class="alert alert-danger mt-1 mb-1">{{ $errors->first('last_name') }}</div>
                        @endif
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <label class="form-label" for="validationCustom01">{{ __('Date Of Birth') }}</label>
                        <input  class="form-control" id="" type="date" name="date_of_birth"   required="" value="{{ isset($user) ? $user->date_of_birth :  old('date_of_birth') }}" />
                        <div class="invalid-feedback">{{ __('Please enter date of birth.') }}</div>
                        @if ($errors->has('date_of_birth'))
                        <div class="alert alert-danger mt-1 mb-1">{{ $errors->first('date_of_birth') }}</div>
                        @endif
                     </div>
                     <div class="col-md-6">
                        <label class="form-label" for="gender">{{ __('Gender') }}</label>
                        <select class="form-select" id="gender" required="" name="gender">
                           <option name="gender" selected="" disabled="" value="">{{ __('Choose...') }}</option>
                           <option @if(old('gender')=='male') selected @endif @if(isset($user) && $user->gender=='male') selected @endif value="male" >{{ __('Male') }}</option>
                           <option @if(old('gender')=='female') selected @endif @if(isset($user) && $user->gender=='female') selected @endif value="female" >{{ __('Female') }}</option>
                        </select>
                        <div class="invalid-feedback">{{ __('Please select Gender.') }}</div>
                        @if ($errors->has('gender'))
                        <div class="alert alert-danger mt-1 mb-1">{{ $errors->first('gender') }}</div>
                        @endif
                     </div>
                  </div>
                  <div class="row">
                        <div class="col-md-6">
                        <label class="form-label" for="validationCustom01">{{ __('Phone') }}</label>
                        <input class="form-control" id="inputnumber" type="number" required name="phone" placeholder="Phone" value="{{ isset($user) ? $user->phone : old('phone') }}" />
                        <div class="invalid-feedback">{{ __('Please enter a valid phone number.') }}</div>
                        @if ($errors->has('phone'))
                        <div class="alert alert-danger mt-1 mb-1">{{ $errors->first('phone') }}</div>
                        @endif      
                     </div>
                     <div class="col-md-6">
                        <label class="form-label" for="validationRole">{{ __('Role') }}</label>
                        <select data-placeholder="Choose..." class="form-control form-select js-example-basic-multiple" multiple="multiple" id="validationRole" required name="role[]">
                           @foreach ($roles as  $key=>$role) 
                           @if(isset($user) && in_array($role->name,$userRole))
                           <option value="{{ $role->name }}" selected>{{ $role->name }}</option>
                           @endif
                           @if(old('role') && in_array($role->name,old('role') ))
                           <option value="{{ $role->name }}" selected>{{ $role->name }}</option>
                           @else
                           <option value="{{ $role->name }}" >{{ $role->name }}</option>
                           @endif
                           @endforeach
                        </select>
                        <div class="invalid-feedback">{{ __('Please select Role.') }}</div>
                        @if ($errors->has('role'))
                        <div class="alert alert-danger mt-1 mb-1">{{ $errors->first('role') }}</div>
                        @endif
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <label class="form-label" for="validationCustom01">{{ __('Email') }}</label>
                        <input class="form-control" id="inputEmail3" type="email" placeholder="{{ __('Email') }}" name="email"  value="{{ isset($user) ? $user->email :  old('email') }}" />
                        <div class="invalid-feedback">{{ __('Please enter a valid email.') }}</div>
                        @if ($errors->has('email'))
                        <div class="alert alert-danger mt-1 mb-1">{{ $errors->first('email') }}</div>
                        @endif
                     </div>
                     <div class="col-md-6">
                        <label class="form-label" for="validationCustom01">{{ __('Password') }}</label>
                        <input class="form-control" id="inputPassword3" type="password"  name="password" placeholder="{{ __('Password') }}" @if(!isset($user))required=""@endif 
                        value="{{ old('password') }}"/>
                        <div class="invalid-feedback">{{ __('Please enter a valid password.') }}</div>
                        @if ($errors->has('password'))
                        <div class="alert alert-danger mt-1 mb-1">{{ $errors->first('password') }}</div>
                        @endif
                     </div>
                  </div>
                  <div class="mb-3">
                  </div>
                  <button class="btn btn-primary" type="submit">{{ isset($user) ? 'Update' : 'Save' }}</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@push('scripts')
<script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>

<script type="text/javascript">
   $('select').select2({
    minimumResultsForSearch: -1,
    placeholder: function(){
        $(this).data('placeholder');
    }
}):

</script>
@endpush
@endsection