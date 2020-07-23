@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Category List
                </div>
              @if(session('delete_status'))
                <div class="alert alert-danger">
                     {{session('delete_status')}}
                </div>
              @endif
            </div>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Serial no.</th>
                        <th scope="col">Category name</th>
                        <th scope="col">Category Description</th>
                        <th scope="col">created By</th>
                        <th scope="col">created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $loop->index + 1}}</th>
                        <td>{{$category->category_name}}</td>
                        <td>{{$category->category_description}}</td>
                        <td>{{App\user::find($category->user_id)->name}}</td>
                        <td>{{$category->created_at->format('d/y/m h:i:s A')}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-success">Edit</button>
                                <a type="button" href="{{'delete/category'}}/{{$category->id}}" class="btn btn-danger">Delete</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <div class="card">

                <div class="card-header">
                    <h4>ADD CATEGORY</h4>
                </div>
                <div class="card-body">
                    @if (session('succss_status'))

                    <div class="alert alert-success">
                        {{ (session('succss_status')) }}
                    </div>
                    @endif
                    <form method="post" action="{{url('addcategorypost')}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-primary">Add Category</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Add category" name="category_name" value="{{old('category_name')}}">
                            @error('category_name')
                            <span class="text-danger">{{ $message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-primary">Category Description</label>
                            <textarea type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category Description" name="category_description"></textarea>
                            @error('category_description')
                            <span class="text-danger">{{ $message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
