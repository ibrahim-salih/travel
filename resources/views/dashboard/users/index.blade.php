@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> Admins </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Main</a>
                                </li>
                                <li class="breadcrumb-item active"> Admins
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Admin   </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                            <tr>
                                                <th>Name </th>
                                                <th>Email</th>
                                                <th>Image </th>
                                                <th>Change</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($users)
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td>{{$user -> name}}</td>
                                                         <td>{{$user -> email}}</td>
                                                        <td>
                                                        @csrf 
                                                        @if($user -> image != '' ) 
                                                        <img style="width: 150px; height: 100px;" src="{{asset('assets/images/users')}}/{{$user -> image }}">
                                                        @else
                                                        <img style="width: 150px; height: 100px;" src="{{asset('assets/images/users')}}/default.jpg">
                                                        @endif
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                @if (auth()->user()->hasPermission('update_users'))
                                                                <a href="{{route('admin.users.edit',$user -> id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">Edit</a>
                                                                <a href="{{route('admin.userspassword.edit',$user -> id)}}"
                                                                   class="btn btn-outline-info btn-min-width box-shadow-3 mr-1 mb-1">Chanage Password</a>   
																@else
																<a href="#"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1 disabled">Edit</a>
                                                                   <a href="#"
                                                                   class="btn btn-outline-info btn-min-width box-shadow-3 mr-1 mb-1">Chanage Password</a>
																@endif
																@if (auth()->user()->hasPermission('delete_users'))
                                                                <a href="{{route('admin.users.delete',$user -> id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">Delete</a>
																@else
																<a href="#"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1 disabled">Delete</a>
																@endif

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <nav aria-label="Page navigation">
                                            @if ($users->lastPage() > 1)
                                            <ul class="pagination justify-content-center">
                                            
                                                <li class="page-item {{ ($users->currentPage() == 1) ? ' disabled' : '' }}">
                                                    <a class="page-link" href="{{ $users->url(1) }}">Previous</a>
                                                </li>
                                                @for ($i = 1; $i <= $users->lastPage(); $i++)
                                                    <li class="page-item {{ ($users->currentPage() == $i) ? ' active' : '' }}">
                                                        <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                                                    </li>
                                                @endfor
                                                <li class=" page-item{{ ($users->currentPage() == $users->lastPage()) ? ' disabled' : '' }}">
                                                    <a class="page-link" href="{{ $users->url($users->currentPage()+1) }}" >Next</a>
                                                </li>
                                            </ul>
                                            @endif
                                              
                                            </nav>
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@stop
