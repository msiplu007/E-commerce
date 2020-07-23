@extends('layouts.dashboard_app')


@section('dashboard_content')

  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Starlight</a>
          <a class="breadcrumb-item" href="index.html">Pages</a>
          <span class="breadcrumb-item active">Blank Page</span>
      </nav>

      <div class="sl-pagebody">
          <div class="sl-page-title">
              <h5>Dashboard</h5>
              <p>This is a Dynamic Dashboard</p>
          </div><!-- sl-page-title -->
          <div class="container">
              <div class="row">
                  <div class="col-lg-6">
                      <div class="card">
                          @error ('name')
                          <div class="alert alert-danger">
                              {{ $message }}
                          </div>
                          @enderror
                          <div class="card-header">
                              @if (session('name_status'))
                              <div class="alert alert-success">
                                  {{session('name_status')}}
                              </div>
                              @endif
                              Change Name

                          </div>

                          <div class="card-body">
                              <form method="post" action="{{url('editprofilepost')}}">
                                  @csrf
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Name</label>
                                      <input type="text" class="form-control" id="exampleInputEmail1" value="{{Auth::user()->name}}" placeholder="Change name" name="name">
                                  </div>
                                  <button type="submit" class="btn btn-primary">Change Name</button>
                              </form>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="card">
                          @error ('name')
                          <div class="alert alert-danger">
                              {{ $message }}
                          </div>
                          @enderror
                          <div class="card-header">
                              {{-- @if (session('name_status'))
                              <div class="alert alert-success">
                                  {{session('name_status')}}
                              </div>
                              @endif --}}
                              Change Photo
                          </div>
                          <div class="card-body">
                            @if ($errors->all())
                              <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                                @endforeach
                              </div>
                            @endif
                              <form method="post" action="{{url('changeprofilephoto')}}" enctype="multipart/form-data">
                                  @csrf
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Change Photo</label>
                                      <input type="file" class="form-control" placeholder="Change photo" name="profile_photo">
                                  </div>
                                  <button type="submit" class="btn btn-warning">Change Photo</button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="container mt-4">
              <div class="row">
                  <div class="col-lg-4 m-auto">
                      <div class="card">
                          <div class="card-header bg-success">

                              Change Password
                          </div>
                          <div class="card-body">

                              <form method="post" action="{{url('editpasswordpost')}}">
                                  @csrf
                                  @if (session('old_password'))
                                  <div class="alert alert-danger">
                                      {{ session('old_password') }}
                                  </div>
                                  @endif
                                  @error ('password')
                                  <div class="alert alert-danger">
                                      {{ $message }}
                                  </div>
                                  @enderror
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Old Password</label>
                                      <input type="text" class="form-control" id="exampleInputEmail1" value="" placeholder="Old password" name="old_password">
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">New Password</label>
                                      <input type="text" class="form-control" id="exampleInputEmail1" value="" placeholder="New password" name="password">
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Confirm Password</label>
                                      <input type="text" class="form-control" id="exampleInputEmail1" value="" placeholder="confirm password" name="password_confirmation">
                                  </div>
                                  <button type="submit" class="btn btn-primary">Change password</button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>

@endsection
