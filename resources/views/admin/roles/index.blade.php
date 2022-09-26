@extends('layouts.admin.master')
@section('title')
{{ __('Roles') }}
@endsection
@push('css')
@endpush
@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>{{ __('Roles') }}</h3>
@endslot
<li class="breadcrumb-item active">{{ __('Roles') }}</li>
@endcomponent
<div class="container-fluid">
   @if ($message = Session::get('success'))
   <div class="alert alert-success">
      <p>{{ $message }}</p>
   </div>
   @endif
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <h5></h5>
               <br>
               @can('role-create')
               <a class="btn btn-success" href="{{ route('roles.create') }}" > {{ __('Add') }}</a>
               @endcan
            </div>
            <div class="table-responsive">
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th scope="col">{{ __('No') }}</th>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col" width="280px">{{ __('Action') }}</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($roles as $key => $role)
                     <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                              <a class="btn btn-info btn-xs" href="{{ route('roles.show', $role->id) }}" data-bs-original-title="" title=""> <i class="fa fa-eye"></i></a>
                             
                              @can('role-edit')
                              <a class="btn btn-primary btn-xs" href="{{ route('roles.edit', $role->id) }}" data-bs-original-title="" title=""> <i class="fa fa-pencil"></i></a>
                              @endcan 
                              @can('role-delete')
                              <a class="btn btn-danger btn-xs delete-item" href="{{ route('roles.destroy', $role->id) }}" data-bs-original-title="" title=""> <i class="fa fa-trash-o"></i></a> 
                               @endcan
                        </td>
                     </tr>
                     @endforeach
               </table>
               </tbody>
               </table>
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