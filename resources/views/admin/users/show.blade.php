@extends('layouts.admin.master')
@section('title')
{{ __('User Profile') }}
@endsection
@push('css')
@endpush
@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>User Profile</h3>
@endslot
<li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ __('Users') }}</a></li>
<li class="breadcrumb-item active">{{ __('User Profile') }}</li>
@endcomponent
<div class="container-fluid">
<div class="edit-profile">
   <div class="row">
      <div class="col-xl-12">
         <div class="card">
            <div class="card-header pb-0">
               <h4 class="card-title mb-0">{{ __('User Profile') }}</h4>
               <div class="card-options">
                  <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
               </div>
            </div>
            <div class="card-body">
               <form>
                  <div class="row mb-2">
                     <div class="profile-title">
                        <div class="media">
                           <img class="img-70 rounded-circle" alt="" src="{{asset('files/images/'.$user->image)}}" />
                           <div class="media-body">
                              <h3 class="mb-1 f-20 txt-primary">{{$user->first_name}}</h3>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                           <label class="form-label">{{ __('First Name') }}</label>
                           <input type="text" class="form-control"  value="{{$user->first_name}}" readonly />
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                           <label class="form-label">{{ __('Last Name') }}</label>
                           <input  class="form-control" id="" type="text" value="{{$user->last_name}}" readonly />
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                           <label class="form-label">{{ __('Date Of Birth') }}</label>
                           <input  class="form-control" id="" type="text" value="{{$user->date_of_birth}}" readonly />
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                           <label class="form-label">{{ __('Email') }}</label>
                           <input  class="form-control" id="" type="text" value="{{$user->email}}" readonly />
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                           <label class="form-label">{{ __('Email') }}</label>
                           <input  class="form-control" id="" type="text" value="{{$user->email}}" readonly />
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                           <label class="form-label">{{ __('Gender') }}</label>
                           <input  class="form-control" id="" type="text" value="{{$user->gender}}" readonly />
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                           <label class="form-label">{{ __('Role') }}</label>
                           <ol>
                              @foreach($userRole as $role)
                              <li>{{$role}}</li>
                              @endforeach
                           </ol>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                           <label class="form-label">{{ __('Contact') }}</label>
                           <input  class="form-control" id="" type="text" value="{{$user->phone}}" readonly />
                        </div>
                     </div>
               </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@push('scripts')
@endpush
@endsection