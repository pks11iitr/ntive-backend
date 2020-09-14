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
                        <h1>Order</h1>
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
           {{-- <div class="container-fluid">--}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <form class="form-validate form-horizontal"  method="get" action="" enctype="multipart/form-data">
                                    <div class="row">

                                        <div class="col-4">
                                            <input   class="form-control" name="datefrom" placeholder=" search name" value="{{request('datefrom')}}"  type="date" />
                                        </div>
                                        <div class="col-4">
                                            <input  class="form-control" name="dateto" placeholder=" search name" value="{{request('dateto')}}"  type="date" />
                                        </div>

                                    <div class="col-4">
                                        <select id="ordertype" name="ordertype" class="form-control" >
                                            <option value="">Please Select Order</option>
                                            <option value="DESC" {{ request('ordertype')=='DESC'?'selected':''}}>DESC</option>
                                            <option value="ASC" {{ request('ordertype')=='ASC'?'selected':''}}>ASC</option>
                                        </select>
                                    </div><br><br>

                                        <div class="col-4">
                                            <select id="status" name="status" class="form-control" >

                                                <option value="">Please Select Status</option>

                                                <option value="processing" {{ request('status')=='processing'?'selected':''}}>Processing</option>
                                                <option value="dispatched" {{ request('status')==='dispatched'?'selected':''}}>Dispatched</option>
                                                <option value="cancelled" {{ request('status')=='cancelled'?'selected':''}}>Cancelled</option>
                                                <option value="delivered" {{ request('status')=='delivered'?'selected':''}}>Delivered</option>
                                                <option value="return-accepted" {{ request('status')=='return-accepted'?'selected':''}}>Return-accepted</option>
                                                <option value="refunded" {{ request('status')=='refunded'?'selected':''}}>Refunded</option>
                                                <option value="completed" {{ request('status')=='completed'?'selected':''}}>Completed</option>
                                            </select>
                                        </div><br><br>

                                        <div class="col-4">
                                            <input  class="form-control" name="search" placeholder=" search by name/email/mobile" value="{{request('search')}}"  type="text" />
                                        </div>
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
                                        <th>Refid</th>
                                        <th>UserId</th>
                                        <th>Total Cost</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->refid}}</td>
                                            <td>{{$order->customer->name??''}}</td>
                                            <td>{{$order->total_cost}}</td>
                                            <td>{{$order->status}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td><a href="{{route('order.orderview',['id'=>$order->id])}}" class="btn btn-primary">View</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        {{$orders->links()}}
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

