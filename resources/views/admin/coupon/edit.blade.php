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
                                <h3 class="card-title">Coupon Edit</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data" action="{{route('coupon.update',['id'=>$coupon->id])}}">
                                @csrf

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputimage">Code</label>
                                        <input type="text" name="code" class="form-control" id="exampleInputimage" placeholder="" value="{{$coupon->code}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea id="w3review" name="description"  class="form-control" rows="4" cols="120" >{{$coupon->description}} </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Discount</label>
                                        <input type="text" name="discount" class="form-control" id="exampleInputimage" placeholder="" value="{{$coupon->discount}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputistop">Type</label>
                                        <select name="type" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="">Please Select Type</option>
                                            <option value="fixed" {{$coupon->type=='fixed'?'selected':''}}>Fixed</option>
                                            <option value="percent" {{$coupon->type=='percent'?'selected':''}}>Percent</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Usage Type</label>
                                        <select name="use_type" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="">Please Select Type</option>
                                            <option value="Single" {{$coupon->use_type=='Single'?'selected':''}}>Single</option>
                                            <option value="Multiple" {{$coupon->use_type=='Multiple'?'selected':''}}>Multiple</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputistop">Is Active</label>
                                        <select name="isactive" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="1" {{$coupon->isactive==1?'selected':''}}>Yes</option>
                                            <option value="0" {{$coupon->isactive==0?'selected':''}}>No</option>
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
