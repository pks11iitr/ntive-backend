@extends('layouts.admin')
@section('contents')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="{{route('product.create')}}" class="btn btn-primary">Add Product</a>
              </div>
                <div class="card-header">
                    <form class="form-validate form-horizontal"  method="get" action="" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-4">
                                <select name="subcategory" class="form-control">
                                    <option value="">Select Sub Category:</option>
                                    @foreach($subcategorys as $subcategory)
                                        <option value="{{$subcategory->id}}" @if(request('subcategory')== $subcategory->id){{'selected'}}@endif>{{$subcategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-4">
                        <select name="category" class="form-control">
                            <option value="">Select Category:</option>
                            @foreach($homecategorys as $homecategory)
                                <option value="{{$homecategory->id}}" @if(request('category')== $homecategory->id){{'selected'}}@endif>{{$homecategory->title}}</option>
                            @endforeach
                        </select>
                            </div>

                        <div class="col-4">
                            <select id="ordertype" name="ordertype" class="form-control" >
                                <option value="">Please Select Order</option>
                                <option value="DESC" {{ request('ordertype')=='DESC'?'selected':''}}>DESC</option>
                                <option value="ASC" {{ request('ordertype')=='ASC'?'selected':''}}>ASC</option>
                            </select>
                        </div><br><br>

                            <div class="col-4">
                                <input  class="form-control" name="search" placeholder=" Search by Product" value="{{request('search')}}"  type="text" />
                            </div><br><br>

                        <div class="col-4">
                            <button type="submit" name="save" class="btn btn-primary">Submit</button>
                        </div>
                        </div>
                    </form>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
{{--                    <th>Category Name</th>--}}
{{--                    <th>Sub CatName</th>--}}
                    <th>Product Name</th>
{{--                    <th>Actual Price</th>--}}
{{--                    <th>Cut Price</th>--}}
{{--                    <th>Weight</th>--}}
                    <th>Image</th>
                    <th>Isactive</th>
                   <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
				@foreach($products as $product)
                  <tr>
{{--                      <td>{{$product->category->title}}</td>--}}
{{--                      <td>{{$product->subcategory->name}}</td>--}}
                      <td>{{$product->name}}</td>
{{--                      <td>{{$product->actual_price}}</td>--}}
{{--                      <td>{{$product->cut_price}}</td>--}}
{{--                      <td>{{$product->weight}} {{$product->unit}}</td>--}}
                      <td><img src="{{$product->image}}" height="80px" width="80px"/></td>
                       <td>
                        @if($product->isactive==1){{'Yes'}}
                             @else{{'No'}}
                             @endif
                        </td>
                      <td><a href="{{route('product.edit',['id'=>$product->id])}}" class="btn btn-primary">Edit</a></td>
                 </tr>
                 @endforeach
                  </tbody>
                 {{$products->appends(request()->query())->links()}}
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@endsection

