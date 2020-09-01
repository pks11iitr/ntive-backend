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
                            <li class="breadcrumb-item active">Coupon</li>
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
                                <h3 class="card-title">Coupon Add</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data" action="{{route('coupon.store')}}">
                                @csrf

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputimage">Code</label>
                                        <input type="text" name="code" class="form-control" id="exampleInputimage" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea id="w3review" name="description"  class="form-control" rows="4" cols="120"> </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Discount</label>
                                        <input type="text" name="discount" class="form-control" id="exampleInputimage" placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputistop">Type</label>
                                        <select name="type" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="">Please Select Type</option>
                                            <option value="fixed">Fixed</option>
                                            <option value="percent">Percent</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Is Active</label>
                                        <select name="isactive" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
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
