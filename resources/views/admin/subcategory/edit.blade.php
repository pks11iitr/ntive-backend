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
                        <li class="breadcrumb-item active">Sub Category</li>
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
                            <h3 class="card-title">Sub Category Edit</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" enctype="multipart/form-data" action="{{route('subcategory.update',['id'=>$subcategory->id])}}">
                            @csrf
                                  <div class="card-body">
                                 <div class="form-group">
                                        <label for="exampleInputtitle">Category Name</label>
                                        <select name="category_id" class="form-control" id="exampleInputistop" placeholder="">
                                            @foreach($homecategory as $category)
                                                <option value="{{$category->id}}" {{$subcategory->category_id==$category->id?'selected':''}}>{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                               
                                    <div class="form-group">
                                    <label for="exampleInputimage">Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputimage"
                                    placeholder="" value="{{$subcategory->name}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputistop">Is Active</label>
                                    <select name="isactive" class="form-control" id="exampleInputistop" placeholder="">
                                      <option  selected="selected" value="1" {{$subcategory->isactive==1?'selected':''}}>Yes</option>
                                          <option value="0" {{$subcategory->isactive==0?'selected':''}}>No</option>
                                    </select>
                                </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
