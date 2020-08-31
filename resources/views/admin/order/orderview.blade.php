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
                            <li class="breadcrumb-item active"><a href="#">Order </a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{--<div class="card-header">
                            <h3 class="card-title">Order Detail</h3>
                        </div>--}}
                        <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Order Details</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>RefId</td><td>{{$order->refid}}</td>
                                    </tr>
                                    <tr>
                                        <td>Date & Time</td><td>{{$order->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td><td>{{$order->total_cost}}</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Status</td><td>{{$order->payment_status}}</td>
                                    </tr>

                                    <tr>
                                        <td>Status</td>
                                        <td>{{$order->status}}<br><br>

                                            <a href="" name='status' class="btn btn-primary">Pending</a>
                                            <a href="" name='status' class="btn btn-primary">Confirmed</a>
                                            <a href="" name='status' class="btn btn-primary">Processing</a>
                                            <a href="" name='status' class="btn btn-primary">Dispatched</a>
                                            <a href="" name='status' class="btn btn-primary">Delivered</a><br><br>
                                            <a href="" name='status' class="btn btn-primary">Cancelled</a>
                                            <a href="" name='status' class="btn btn-primary">Return-request</a>
                                            <a href="" name='status' class="btn btn-primary">Return-accepted</a>
                                            <a href="" name='status' class="btn btn-primary">Refunded</a>
                                            <a href="" name='status' class="btn btn-primary">Completed</a>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>@if(!empty($order->details[0]->entity) && $order->details[0]
->entity instanceof \App\Models\Therapy) <th></th> @else Product Details @endif </th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->details as $detail)
                                        <tr>
                                            <td>{{$detail->entity->name??''}}</td>
                                            <td>Quantity: {{$detail->quantity}}</td>
                                            <td>Rs. {{$detail->cost}}/Item</td>
                                            <td>Rs. {{$detail->cost*$detail->quantity}} Total</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Customer Details</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Name</td><td>{{$order->name}}</td>
                                </tr>
                                <tr>
                                    <td>Mobile</td><td>{{$order->mobile}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td><td>{{$order->email}}</td>
                                </tr>
                                <tr>
                                    <td>Adress</td><td>{{$order->address}}</td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

@endsection
