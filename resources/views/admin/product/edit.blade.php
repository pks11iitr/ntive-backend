@extends('layouts.admin')

@section('contents')
    <link rel="stylesheet" href="{{asset('../admin-theme/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('../admin-theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Product Edit</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" enctype="multipart/form-data" action="{{route('product.update',['id'=>$product->id])}}">
                            @csrf
                                  <div class="card-body">
{{--                                 <div class="form-group">--}}
{{--                                        <label for="exampleInputtitle">Category Name</label>--}}
{{--                                        <select name="cat_id" class="form-control" id="exampleInputistop" placeholder="">--}}
{{--                                            @foreach($homecategory as $category)--}}
{{--                                                <option value="{{$category->id}}" {{$product->cat_id==$category->id?'selected':''}}>{{$category->title}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="exampleInputtitle">Sub Category Name</label>--}}
{{--                                        <select name="subcat_id" class="form-control" id="exampleInputistop" placeholder="">--}}
{{--                                            @foreach($subcategory as $subcat)--}}
{{--                                                <option value="{{$subcat->id}}" {{$product->subcat_id==$subcat->id?'selected':''}}>{{$subcat->name}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
                                <div class="form-group">
                                    <label for="exampleInputimage">Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputimage"
                                    placeholder="" value="{{$product->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputimage">Actual Price</label>
                                    <input type="number" min="0" name="actual_price" class="form-control" id="exampleInputimage" placeholder="" value="{{$product->actual_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputimage">Cut Price</label>
                                    <input type="number" min="0" name="cut_price" class="form-control" id="exampleInputimage" placeholder="" value="{{$product->cut_price}}">
                                </div>
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Description</label>
                                          <textarea id="w3review" name="description"  class="form-control" rows="4" cols="120">{{$product->description}}</textarea>
                                      </div>
                                <div class="form-group">
                                    <label for="exampleInputimage">Weight</label>
                                    <input type="number" min="0" name="weight" class="form-control" id="exampleInputimage" placeholder="" value="{{$product->weight}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputimage">Unit</label>
                                    <input type="text" name="unit" class="form-control" id="exampleInputimage" placeholder=""  value="{{$product->unit}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputistop">Is Featured</label>
                                    <select name="is_featured" class="form-control" id="exampleInputistop" placeholder="">
                                      <option  selected="selected" value="1" {{$product->is_featured==1?'selected':''}}>Yes</option>
                                          <option value="0" {{$product->is_featured==0?'selected':''}}>No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputistop">Is Discount</label>
                                    <select name="is_discount" class="form-control" id="exampleInputistop" placeholder="">
                                      <option  selected="selected" value="1" {{$product->is_discount==1?'selected':''}}>Yes</option>
                                          <option value="0" {{$product->is_discount==0?'selected':''}}>No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputistop">Is New Arrivel</label>
                                    <select name="is_newarrivel" class="form-control" id="exampleInputistop" placeholder="">
                                      <option  selected="selected" value="1" {{$product->is_newarrivel==1?'selected':''}}>Yes</option>
                                          <option value="0" {{$product->is_newarrivel==0?'selected':''}}>No</option>
                                    </select>
                                </div>
                                      <div class="form-group">
                                          <label for="exampleInputtitle">Category</label>
                                          <select name="category_id[]"  class="form-control select2" id="exampleInputistop" data-placeholder="Select a Category" multiple>
                                              <option value="">Please Select Category</option>
                                              @foreach($categories as $category)
{{--                                                  <option value="{{$category->id}}">{{$category->title}}</option>--}}

                                                  <option value="{{$category->id}}" @foreach($product->category as $s) @if($s->id==$category->id){{'selected'}}@endif @endforeach >{{$category->title}}</option>
                                              @endforeach
                                          </select>
                                      </div>


                                <div class="form-group">
                                    <label for="exampleInputtitle">Sub Category</label>
                                    {{--                            <select name="sub_cat_id" class="form-control" id="exampleInputistop" placeholder="">--}}
                                    <select class="form-control select2" multiple data-placeholder="Select a subcategory" style="width: 100%;" name="sub_cat_id[]">

                                        <option value="">Please Select Category</option>
                                        @foreach($subcategories as $subcategory)

                                            <option value="{{$subcategory->id}}" @foreach($product->subcategory as $s) @if($s->id==$subcategory->id){{'selected'}}@endif @endforeach >{{$subcategory->name}}</option>


                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputimage">Product Image</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputimage"
                                    placeholder="">
                                    <img src="{{$product->image}}" height="100" width="200">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputistop">Is Active</label>
                                    <select name="isactive" class="form-control" id="exampleInputistop" placeholder="">
                                      <option  selected="selected" value="1" {{$product->isactive==1?'selected':''}}>Yes</option>
                                          <option value="0" {{$product->isactive==0?'selected':''}}>No</option>
                                    </select>
                                </div>

                                      <div class="form-group">

                                          <label for="exampleInputistop">Out Of Stock</label><br>
                                          <input type="radio" name="out_of_stock" value="0"   {{$product->out_of_stock==0?'checked':''}}>
                                          <label for="exampleInputistop">Yes</label><br>
                                          <input type="radio" name="out_of_stock" value="1" {{$product->out_of_stock==1?'checked':''}}>
                                          <label for="exampleInputistop">No</label>

                                      </div>
                                      </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>


                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Images</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" enctype="multipart/form-data" action="{{route('product.upload.image',['id'=>$product->id])}}">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputimage">Product Image</label>
                                    <input type="file" name="file_path[]" class="form-control" id="exampleInputimage"
                                           placeholder="" multiple>

                                </div>

                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div><br>

                                <div class="row">
                                    <!-- /.col -->
                                    @foreach($documents as $document)
                                        <div class="form-group">
                                            <img src="{{$document->file_path}}" height="100" width="200"> &nbsp; &nbsp; <a href="{{route('product.delete',['id'=>$document->id])}}">X</a>
                                            &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;          &nbsp; &nbsp; &nbsp; &nbsp;
                                        </div>
                                @endforeach
                                <!-- /.form-group -->
                                    <!-- /.form-group -->
                                    <!-- /.col -->
                                </div>
                                </div>

                        </form>
                    </div>
                    <!-- /.card -->
                </div>
              </div>

                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->

    </section>
{{--    *********************************Size Price*******************************************--}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Size Price</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" enctype="multipart/form-data" action="{{route('product.sizeprice',['id'=>$product->id])}}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Size</label>
                                            <input type="text" name="size" class="form-control" id="exampleInputEmail1" placeholder="Enter size" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Price</label>
                                            <input type="number" name="price" min="0" class="form-control" id="exampleInputEmail1" placeholder="Enter price" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Cut Price</label>
                                            <input type="number" min="0" name="cut_price" class="form-control" id="exampleInputEmail1" placeholder="Enter price" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Is Active</label>
                                            <select name="isactive" class="form-control" id="exampleInputistop" placeholder="">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    {{--      *************************************************************************************--}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-3">
                                    List Size Price</div>

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Cut Price</th>
                                    <th>Isactive</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sizeprice as $size)
                                    <tr>
                                        <td>{{$size->size}}</td>
                                        <td>{{$size->price}}</td>
                                        <td>{{$size->cut_price}}</td>

                                        <td>
                                            @if($size->isactive==1){{'Yes'}}
                                            @else{{'No'}}
                                            @endif
                                        </td>
                                        <td><a href="{{route('product.delete.sizeprice',['id'=>$size->id])}}" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Cut Price</th>
                                    <th>Isactive</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
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
</div>
    @endsection
@section('scripts')
    <script src="{{asset('admin-theme/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('admin-theme/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <script>
        $(function () {
            // Summernote
            $('.textarea').summernote()
        })
    </script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('#category_id_sel').select2();
        });
    </script>
@endsection
