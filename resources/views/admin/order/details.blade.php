@extends('layouts.admin')
@section('contents')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Customers</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('orders.list')}}">Order Details</a></li>
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

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Application Details <a href="{{route('orders.edit', ['id'=>$order->id])}}">Edit</a></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Order ID</td>
                                        <td>{{$order->refid}}</td>
                                    </tr>
                                    <tr>
                                        <td>Date & Time</td>
                                        <td>{{$order->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>{{$order->amount}}</td>
                                    </tr>
                                    <tr>
                                        <td>Duration</td>
                                        <td>{{$order->days}} Days</td>
                                    </tr>
                                    <tr>
                                        <td>Approval Status</td>
                                        <td>{{$order->approval_status}}</td>
                                    </tr>
                                    <tr>
                                        <td>Amount Transfer Date</td>
                                        <td>{{$order->amount_transfer_date}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tentative Payback Date</td>
                                        <td>{{$order->tentative_payback_date}}</td>
                                    </tr>
                                    <tr>
                                        <td>Paid Back Date</td>
                                        <td>{{$order->paidback_date}}</td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Customer Details <a href="{{route('customer.edit', ['id'=>$order->customer->id??''])}}" target="_blank">View Details</a></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{$order->customer->name??''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Mobile</td>
                                        <td>{{$order->customer->mobile??''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{$order->customer->email??''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{$order->adderss}}</td>
                                    </tr>

                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>

                        <!-- /.card-body -->
                        </div>

                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Customer Documents <span><a style="color:yellow" href="{{route('customer.download',['id'=>$order->customer->id])}}"><b>(Download All)</b></a></span></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($order->customer)
                                <tr>
                                    <td>Pan Card</td>
                                    <td>@if($order->customer->documents()->where('documents.document_name', 'Pancard')->first())<a href="{{route('document.view', ['id'=>$order->customer->documents()->where('documents.document_name', 'Pancard')->first()->id??''])}}">View</a>@endif</td>
                                </tr>
                                <tr>
                                    <td>Adhaar Card</td>
                                    <td>@if($order->customer->documents()->where('documents.document_name', 'Adhaar Front')->first())<a href="{{route('document.view', ['id'=>$order->customer->documents()->where('documents.document_name', 'Adhaar Front')->first()->id??''])}}">Front View</a>@endif/ <a href="{{route('document.view', ['id'=>$order->customer->documents()->where('documents.document_name', 'Adhaar Back')->first()->id??''])}}">Back View</a></td>
                                </tr>
                                <tr>
                                    <td>Income Documents</td>
                                    <td>
                                        @foreach($order->customer->documents()->where('documents.document_name', 'Income Document')->get() as $doc)
                                            <a href="{{route('document.view', ['id'=>$doc->id??''])}}">View{{$loop->iteration}}</a>/
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address Documents</td>
                                    <td>
                                        @foreach($order->customer->documents()->where('documents.document_name', 'Address Document')->get() as $doc)
                                            <a href="{{route('document.view', ['id'=>$doc->id??''])}}">View{{$loop->iteration}}</a>/
                                        @endforeach
                                    </td>
                                </tr>
                                @endif
                                </tbody>
                                <tfoot>
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

        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
@endsection
