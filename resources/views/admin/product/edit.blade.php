{{-- @php
  error_reporting(0);
@endphp --}}
@extends('layouts.dashboard_app')
@section('product')
  active
@endsection

@section('dashboard_content')

  <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="{{url('home')}}">Product</a>
          <a class="breadcrumb-item" href="{{url('product.index') }}">Product Edit</a>
            <a class="breadcrumb-item" href="">{{$product_info->product_name}}</a>

      </nav>

      <div class="sl-pagebody">
          <div class="sl-page-title">
              <h5>Product</h5>

          </div><!-- sl-page-title -->
</div>

<div class="container">
    <div class="row">


        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    Product Edit
                </div>
                <div class="card-body">
                  @if (session('product_status'))
                    <div class="alert alert-success">
                      {{session('product_status')}}
                    </div>
                  @endif

                    @if ($errors->all())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </div>
                    @endif
                    <form method="post" action="{{route('product.update', $product_info->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Name</label>
                            <select class="form-control" name="category_id">
                              <option value="">Select one-</option>
                            @foreach ($active_categories as $active_category)

                              <option {{ $active_category->id == $product_info->category_id ? "Selected" : ""  }} value="{{$active_category->id}}">{{ App\Category::find($active_category->id)->category_name }}</option>
                            @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Name</label>
                            <input type="" name="product_name"  class="form-control" value="{{$product_info->product_name}}">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Short Description</label>
                            <textarea placeholder="Category Description..." class="form-control" rows="5" name="product_short_description">{{$product_info->product_short_description}}</textarea>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Long Description</label>
                            <textarea placeholder="Category Description..." class="form-control" rows="5" name="product_long_description">{{$product_info->product_long_description}}</textarea>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Price</label>
                            <input type="" name="product_price"  class="form-control" value="{{$product_info->product_price}}">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Quentity</label>
                            <input type="" name="product_quentity"  class="form-control" value="{{$product_info->product_quentity}}">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Alert Quentity</label>
                            <input type="" name="product_alert_quentity"  class="form-control" value="{{$product_info->product_alert_quentity}}">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Photo</label>
                            <input type="file" name="product_photo"  class="form-control">

                            {{-- @error ('category_description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror --}}
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- <div class="col-lg-10 mt-4">
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
                      <button type="submit" name="button" class="btn btn-info">Mark delete</button>
                    </form>
                </div>
            </div>
        </div> --}}
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
