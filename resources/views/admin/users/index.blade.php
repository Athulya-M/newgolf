@extends('layouts.admin.master')

@section('title')
{{ __('Users') }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
 @component('components.breadcrumb')
    @slot('breadcrumb_title')
      <h3>{{ __('Users') }}</h3>
    @endslot
        <li class="breadcrumb-item active">{{ __('Users') }}</li>
@endcomponent
  
<div class="container-fluid">
@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
      <div class="row">
          <!-- Zero Configuration  Starts-->
          <div class="col-sm-12">
              <div class="card">
                  <div class="card-body">
                    <a class="btn btn-primary mb-3" href="{{ route('users.create') }}">{{ __('Add') }}</a>
                      <div class="table-responsive">
                          <table class="display" id="basic-1">
                              <thead>
                                  <tr><th>{{ __('No') }}</th>
                                      <th>{{ __('Name') }}</th>
                                      <th>{{ __('Email') }}</th>
                                      <th>{{ __('Account Type') }}</th>
                                      <th>{{ __('Created On') }}</th>
                                      <th >{{ __('Action') }}</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($users as $key=>$user)
                                  <tr>
                                      <td>{{++$key}}</td>
                                      <td>{{$user->first_name}}</td>
                                      <td>{{$user->email}}</td>
                                      <td>{{$user->account_type}}</td>
                                      <td>{{$user->created_at}}</td>
                                      <td>
                                        <a class="btn btn-info btn-xs" href="{{ route('users.show', $user->id) }}" data-bs-original-title="" title=""> <i class="fa fa-eye"></i></a>

                                        @can('role-edit')
                                        <a class="btn btn-primary btn-xs" href="{{ route('users.edit', $user->id) }}" data-bs-original-title="" title=""> <i class="fa fa-pencil"></i></a>
                                        @endcan 
                                        @can('role-delete')
                                        <a class="btn btn-danger btn-xs delete-item" href="{{ route('users.destroy', $user->id) }}" data-bs-original-title="" title=""> <i class="fa fa-trash-o"></i></a>
                                        @endcan
                                      </td>
                                    </tr>
                                   @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Zero Configuration  Ends-->
        </div>
  </div>

  
  @push('scripts')
  <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
  <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
  <script src="{{ asset('assets/js/common/delete.js') }}"></script>
  @endpush

@endsection