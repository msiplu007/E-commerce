@extends('layouts.dashboard_app')
@section('category')
  active
@endsection

@section('dashboard_content')
  @section('title')
   Add Category
  @endsection
  <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="{{url('home')}}">Home</a>
          <a class="breadcrumb-item" href="#">Category</a>

      </nav>

      <div class="sl-pagebody">
          <div class="sl-page-title">
              <h5>Category</h5>
              <p>This is a Dynamic Dashboard</p>
          </div><!-- sl-page-title -->
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                  Category List
                </div>
                @if (session('delete_status'))
                <div class="alert alert-danger">
                    {{session('delete_status')}}
                </div>
                @endif
                @if (session('edit_status'))
                  <div class="alert alert-success">
                    {{session('edit_status')}}
                  </div>
                @endif
                <div class="card-body">
                  <form method="post" action="{{url('mark/delete')}}">
                    @csrf
                    <table class="table table-dark" id="category_table">
                        <thead>
                            <tr>
                                <th scope="col">Mark</th>
                                <th scope="col">Serial no.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                {{-- <th scope="col">created By</th> --}}
                                <th scope="col">Photo</th>
                                <th scope="col">create time</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr>
                                <td>
                                   <input type="checkbox" name="category_id[]" value="{{$category->id}}">
                                </td>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$category->category_name}}</td>
                                <td>{{$category->category_description}}</td>
                                {{-- <td>{{App\user::find($category->user_id)->name}}</td> --}}
                                <td>
                                  <img src="{{asset('uploads/category_photos')}}/{{ $category->category_photo}}" width="50" class="img-fluid" alt="not found">
                                </td>
                                <td>
                                   @isset($category->created_at)
                                     {{$category->created_at->diffForHumans()}}
                                   @endisset
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ url('edit/category')}}/{{ $category->id }}" type="button" class="btn btn-success">Edit</a>
                                        <a href="{{ url('delete/category')}}/{{ $category->id }}" type="button" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="50" class="text-center text-danger">No data available</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                    @if ($categories->count() > 0)
                      <button type="submit" name="button" class="btn btn-danger">Mark delete</button>
                    @endif
                  </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Add Category
                </div>
                <div class="card-body">
                    @if (session('success_status'))
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
                    @endif
                    <form method="post" action="{{url('addcategory/post')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="{{old('category_name')}}" placeholder="Category name" name="category_name">
                            @error ('category_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Category Description</label>
                            <textarea placeholder="Category Description..." class="form-control" rows="5" name="category_description"></textarea>
                            @error ('category_description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Category Description</label>
                            <input type="file" name="category_photo"  class="form-control">

                            {{-- @error ('category_description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror --}}
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-10 mt-4">
            <div class="card bg-danger">
                <div class="card-header">
                    <h4 class="text-success">  Deleted Category</h4>
                </div>
                @if (session('restore_status'))
                  <div class="alert alert-success">
                    {{session('restore_status')}}
                  </div>
                @endif
                @if (session('force_delete_status'))
                  <div class="alert alert-success">
                    {{session('force_delete_status')}}
                  </div>
                @endif
                <form method="post" action="{{url('mark/restore')}}">
                  @csrf
                <div class="card-body">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Mark</th>
                                <th scope="col">Serial no.</th>
                                <th scope="col">Nmae</th>
                                <th scope="col">Description</th>
                                <th scope="col">created By</th>
                                <th scope="col">created_at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($deleted_categories as $deleted_category)
                            <tr>
                                <td>
                                    <input type="checkbox" name="category_id[]" value="{{$deleted_category->id}}">
                                </td>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$deleted_category->category_name}}</td>
                                <td>{{$deleted_category->category_description}}</td>
                                <td>{{App\user::find($deleted_category->user_id)->name}}</td>
                                <td>{{$deleted_category->created_at->format('d/y/m h:i:s A')}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ url('force/delete/category')}}/{{ $deleted_category->id }}" type="button" class="btn btn-danger">F.D</a>
                                        <a href="{{ url('restore/category')}}/{{ $deleted_category->id }}" type="button" class="btn btn-success">Restore</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="50" class="text-center text-danger">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                      <button type="submit" name="button" class="btn btn-info">Mark Restore</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection

@section('footer_scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#category_table').DataTable({
          responsive: true,
          language: {
          searchPlaceholder: 'Search...',
          sSearch: '',
          lengthMenu: ' _MENU_ items/pages',
          }
        });
    });
  </script>
@endsection
