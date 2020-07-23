@extends('layouts.dashboard_app')
@section('home')
active
@endsection
@section('title')
Dashboard
@endsection
@section('dashboard_content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Home</a>

    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Dashboard</h5>
            <p>This is a Dynamic Dashboard</p>
            <h4>
             @if(Auth::user()->role == 1)
             you are admin
              @else
              You are customer
             @endif
            </h4>
        </div><!-- sl-page-title -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{url('send/sendnewslatter') }}" class="btn btn-success">Email NewsLatter to {{ $total_user }} users</a>
                        </div>

                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h1>Dashboard</h1>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <h3>Total :{{$total_user}}</h3>
                        </div>
                    </div>
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Serial no.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Created_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th>{{$users->firstitem() + $loop->index}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <li>Date :{{$user->created_at->format('d/m/y')}}</li>
                                    <li>Time :{{$user->created_at->format('h:i:s A')}}</li>
                                    <li>Time :{{$user->created_at->diffForHumans()}}</li>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                      <div class="card-header">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Contact name</th>
                                <th scope="col">Contact email</th>
                                <th scope="col">Contact subject</th>
                                <th scope="col">Contact message</th>
                                <th scope="col"> contact attectment</th>
                                <th scope="col">File</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($contacts as $contact)


                            <tr>
                                <th>{{ $loop->index + 1 }}</th>
                                <td>{{ $contact->contact_name }}</td>
                                <td>{{ $contact->contact_email }}</td>
                                <td>{{ $contact->contact_subject }}</td>
                                <td>{{ $contact->contact_message }}</td>
                                <td>{{ $contact->contact_attectment }}</td>
                                <td>
                                  @if ($contact->contact_attectment )
                                    <a href="{{ url('contact/upload/file') }}/{{ $contact->id }}"><i class="fas fa-download"></i></a>
                                    <a target="_blank" href="{{ asset('storage') }}/{{ $contact->contact_attectment }}"><i class="fas fa-file"></i></a>
                                  @endif
                                </td>

                            </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

@endsection
