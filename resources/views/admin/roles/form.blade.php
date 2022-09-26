@extends('layouts.admin.master')

@section('title')
{{ isset($category) ? __('Edit Role') : __('Add Role') }}

@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
		<h3>{{ isset($category) ? __('Edit Role') : __('Add Role') }}</h3>
		@endslot
		<li class="breadcrumb-item"><a href="{{ route('roles.index') }}">__('Roles')</a></li>
        <li class="breadcrumb-item active">{{ isset($role) ? __('Edit Role') : __('Add Role') }}</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<form class="needs-validation" novalidate="" method="POST" action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}">
						@isset($role)
                    		@method('PUT')
                    		<input type="hidden" name="id" value="{{ $role->id }}">
                		@endisset
                		@csrf
							 <div class="mb-3 row">
                     <label class="col-sm-3 col-form-label" for="inputPassword3">{{ __('Name') }}</label>
                     <div class="col-sm-9">
                        <input class="form-control" id="Name" required type="text" placeholder="{{ __('Name') }}" name="name" value="{{ isset($role) ? $role->name : '' }}" />
                        @if ($errors->has('name'))
                        <div class="alert alert-danger mt-1 mb-1">{{ $errors->first('name') }}</div>
                        @endif	
                     </div>
                  </div>
                  <div class="row mb-0">
                     <label class="col-sm-3 col-form-label pb-0">{{ __('Permissions') }}</label>
                     <div class="col-sm-9">
                        <div class="mb-0">
                           @foreach($permission as $value)
                           <div class="form-check form-check-inline checkbox checkbox-primary">
                              <input class="form-check-input" id="inline-form-{{$value->id}}" type="checkbox"  name="permission[]" value="{{$value->id}}" 
                             @if(isset($role) && (in_array($value->id, $rolePermissions))) checked
                              @endif />
                              <label class="form-check-labe{{$value->id}}" for="inline-form-{{$value->id}}">{{$value->name}}</label>
                           </div>
                           @endforeach
                           @if ($errors->has('permission'))
                        	<div class="alert alert-danger mt-1 mb-1">{{ $errors->first('permission') }}</div>
                        	@endif
                        </div>
                     </div>
                  </div>
                  <button class="btn btn-primary" type="submit">{{ isset($role) ? __('Update') : __('Save') }}</button>
                  
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	@push('scripts')
	<script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
	@endpush

@endsection