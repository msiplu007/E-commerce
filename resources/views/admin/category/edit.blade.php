@extends('layouts.dashboard_app')
@section('category')
  active
@endsection
@section('dashboard_content')
  <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="{{url('home')}}">Home</a>
          <a class="breadcrumb-item" href="{{url('addcategory')}}">Category</a>
          <span class="breadcrumb-item active">{{$category_info->category_name}}</span>
      </nav>

      <div class="sl-pagebody">
          <div class="sl-page-title">
              <h5>{{$category_info->category_name}}</h5>
              <p>This is a Dynamic Dashboard</p>
          </div><!-- sl-page-title -->

<div class="container">
    <div class="row">
        <div class="col-lg-4 m-auto">
            <div class="card">
                <div class="card-header">
                    Add Category
                </div>
                <div class="card-body">
                  @if (session('edit_status'))
                    <div class="alert alert-success">
                      {{session('edit_status')}}
                    </div>
                  @endif

                    {{-- @if (session('success_status'))
                    <div class="alert alert-success">
                        {{session('success_status')}}
                    </div>
                    @endif
                    @if ($errors->all())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                    @endif --}}
                    <form method="post" action="{{url('edit/category/post')}}">
                      <input type="hidden" name="category_id" value="{{$category_info->id}}">
                        @csrf
                        <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('addcategory')}}">Addcategory</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$category_info->category_name}}</li>
    </ol>
  </nav>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Nameame</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="{{$category_info->category_name}}" placeholder="Category name" name="category_name">
                            @error ('category_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Category Description</label>

                            <textarea placeholder="Category Description..." class="form-control" rows="5" value="" name="category_description">{{$category_info->category_description}}</textarea>
                            @error ('category_description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Edit Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
