@extends('layouts.admin')
@section('contents')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Loan Applications</h1>
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
                      <div class="row">
                          <div class="col-12">

        <form class="form-validate form-horizontal"  method="get" action="" enctype="multipart/form-data">

                     <div class="row">
					      <div class="col-4">
                           <input  id="fullname" onfocus="this.value=''" class="form-control" name="search" placeholder="ApplicationID/Use Name/Mobile/Email" value="{{request('search')}}"  type="text" />
                           </div>
					  <div class="col-4">
                          <select id="status" name="approval_status" class="form-control" >

                             <option value="">Select Loan Status</option>
                             <option value="pending" {{request('approval_status')=='pending'?'selected':''}}>Pending</option>
                             <option value="approved" {{request('approval_status')=='approved'?'selected':''}}>Approved</option>
                             <option value="disbursed" {{request('approval_status')=='disbursed'?'selected':''}}>Disbursed</option>
                             <option value="rejected" {{request('approval_status')=='rejected'?'selected':''}}>Rejected</option>
                             <option value="completed" {{request('approval_status')=='completed'?'selected':''}}>Completed</option>
                             <option value="default" {{request('approval_status')=='default'?'selected':''}}>Default</option>
                          </select>
                      </div>
                      <div class="col-4">
                          <select id="payment_status" name="payback_status" class="form-control" >
                             <option value="">Select Payback Status</option>

                             <option value="pending" {{request('payback_status')=='pending'?'selected':''}}>Pending</option>
                             <option value="paid" {{request('payback_status')=='paid'?'selected':''}}>Paid</option>
                          </select>
                      </div><br><br>
                      <div class="col-4">
                           <input  id="fullname" onfocus="this.value=''" class="form-control" name="fromdate" placeholder=" search name" value="{{request('fromdate')}}"  type="date" />
                       </div>
                       <div class="col-4">
                       <input  id="fullname" onfocus="this.value=''" class="form-control" name="todate" placeholder=" search name" value="{{request('todate')}}"  type="date" />
                       </div>
                         <div class="col-4">
                             <select id="payment_status" name="ordertype" class="form-control" >
                                 <option value="">Order By</option>

                                 <option value="desc" {{request('ordertype')=='desc'?'selected':''}}>Recent First</option>
                                 <option value="asc" {{request('ordertype')=='asc'?'selected':''}}>Oldest First</option>
                             </select>
                         </div>
                    <div class="col-4">
                       <button type="submit" name="save" class="btn btn-primary">Submit</button>
                     </div>
                  </div>
              </form>
         </div>

     </div>
              </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Application ID</th>
                                        <th>User</th>
                                        <th>Verification Status</th>
                                        <th>Application Date</th>
                                        <th>Amount</th>
                                        <th>Days</th>
                                        <th>Approval Status</th>
                                        <th>Payback Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)

                                        <tr>
                                            <td>{{$order->refid}}</td>
                                            <td>{{$order->customer->name??''}} <br>Mob: {{$order->customer->mobile??''}}</td>
                                            <td>{{!empty($order->customer->is_verified) && $order->customer->is_verified==1?'Yes':'No'}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->amount}}</td>
                                            <td>{{$order->days}}</td>
                                            <td>{{$order->approval_status}}</td>
                                            <td>{{$order->payback_status}}</td>
                                            <td><a href="{{route('order.view',['id'=>$order->id])}}" class="btn btn-success">View</a>
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Application ID</th>
                                        <th>User</th>
                                        <th>Verification Status</th>
                                        <th>Application Date</th>
                                        <th>Amount</th>
                                        <th>Days</th>
                                        <th>Approval Status</th>
                                        <th>Payback Status</th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
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
