@extends('layouts.admin')

@section('contents')
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
                                 <div class="form-group">
                                        <label for="exampleInputtitle">Category Name</label>
                                        <select name="cat_id" class="form-control" id="exampleInputistop" placeholder="">
                                            @foreach($homecategory as $category)
                                                <option value="{{$category->id}}" {{$product->cat_id==$category->id?'selected':''}}>{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputtitle">Sub Category Name</label>
                                        <select name="subcat_id" class="form-control" id="exampleInputistop" placeholder="">
                                            @foreach($subcategory as $subcat)
                                                <option value="{{$subcat->id}}" {{$product->subcat_id==$subcat->id?'selected':''}}>{{$subcat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                    <label for="exampleInputimage">Product Image</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputimage"
                                    placeholder="">
                                    <image src="{{$product->image}}" height="100" width="200">
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
                                          <input type="checkbox" name="out_of_stock" value="0"   {{$product->out_of_stock==0?'checked':''}}>
                                          <label for="exampleInputistop">Yes</label><br>
                                          <input type="checkbox" name="out_of_stock" value="1" {{$product->out_of_stock==1?'checked':''}}>
                                          <label for="exampleInputistop">No</label>

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
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
    @endsection
