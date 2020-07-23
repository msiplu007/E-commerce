@php
  error_reporting(0);
@endphp
@extends('layouts.dashboard_app')
@section('product')
  active
@endsection

@section('dashboard_content')

  <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="{{url('home')}}">Home</a>
          <a class="breadcrumb-item" href="{{route('product.index')}}">Product</a>
      </nav>
      <div class="sl-pagebody">
          <div class="sl-page-title">
              <h5>Product</h5>

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
                                {{-- <th scope="col">Mark</th> --}}

                                <th scope="col">ID</th>
                                <th scope="col">Coupon Name</th>
                                <th scope="col">Discount Amount</th>
                                <th scope="col"> Minimum Purchage Amount</th>
                                <th scope="col"> Validity till</th>


                            </tr>
                        </thead>
                        <tbody>
                             @forelse($coupons as $coupon)
                            <tr>
                                {{-- <td>
                                   <input type="checkbox" name="category_id[]" value="{{$category->id}}">
                                </td> --}}
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$coupon->coupon_name}}</td>
                                <td>{{$coupon->discount_amount}}%</td>
                                <td>{{$coupon->minimum_purchage_amount}}</td>
                                <td>{{$coupon->validity_till}}</td>

                             </tr>
                            @empty
                            <tr>
                                <td colspan="50" class="text-center text-danger">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                  </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Add Coupon
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
                    <form method="post" action="{{route('coupon.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputPassword1">Coupon Name</label>
                            <input type="" name="coupon_name"  class="form-control">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Discount Amount</label>
                            <input type="" name="discount_amount"  class="form-control">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Minimum Purchage Amount</label>
                            <input type="" name="minimum_purchage_amount"  class="form-control">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Validity Till</label>
                            <input type="date" name="validity_till"  class="form-control">

                        </div>

                        <button type="submit" class="btn btn-primary">Add Coupon</button>
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
      $('#category_table').DataTable();
        ClassicEditor
                .create( document.querySelector( '#product_short_description' ) )
                .then( editor => {
                        console.log( editor );
                } )
                .catch( error => {
                        console.error( error );
                } );
    });
  </script>
@endsection
