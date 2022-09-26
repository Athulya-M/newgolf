@extends('layouts.admin.master')
@section('title'){{ __('Roles and Permissions') }}
@endsection
@push('css')
@endpush
@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Roles and Permissions</h3>
@endslot
<li class="breadcrumb-item"><a href="{{ route('roles.index') }}">{{ __('Roles') }}</a></li>
<li class="breadcrumb-item active">{{ __('Roles and Permissions') }}</li>
@endcomponent
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12 col-xl-12">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header pb-0">
                     
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="row">
                              <div class="col">
                                 <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">{{ __('Role name') }}</label>
                                    <div class="col-sm-9">
                                       <input readonly class="form-control" value="{{$role->name}}" type="text" name="name" required="" />
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                              <div class="row">
                                 <div class="col">
                                    <div class="mb-3 row">
                                       <label class="col-sm-3 col-form-label">{{ __('Permissions') }}</label>
                                       <div class="col-sm-9">
                                          <ol>
                                             @if(!empty($rolePermissions))
                                             @foreach($rolePermissions as $v)
                                             <li>{{ $v->name }}</li>
                                             @endforeach
                                             @endif
                                          </ol>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@push('scripts')
<script src="{{asset('assets/js/bootstrap/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap/bootstrap.min.js')}}"></script>
@endpush
@endsection