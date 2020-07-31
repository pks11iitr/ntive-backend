@extends('layouts.admin')
@section('contents')
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
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Category Name</th>
                    <th>Sub CatName</th>
                    <th>Product Name</th>
                    <th>Actual Price</th>
                    <th>Cut Price</th>
                    <th>Weight</th>
                    <th>Image</th>
                    <th>Isactive</th>
                   <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
				@foreach($products as $product)
                  <tr>
                      <td>{{$product->category->title}}</td>
                      <td>{{$product->subcategory->name}}</td>
                      <td>{{$product->name}}</td>
                      <td>{{$product->actual_price}}</td>
                      <td>{{$product->cut_price}}</td>
                      <td>{{$product->weight}} {{$product->unit}}</td>
                      <td><img src="{{$product->image}}" height="80px" width="80px"/></td>
                       <td>
                        @if($product->isactive==1){{'Yes'}}
                             @else{{'No'}}
                             @endif
                        </td>
                      <td><a href="{{route('product.edit',['id'=>$product->id])}}" class="btn btn-success">Edit</a></td>
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

