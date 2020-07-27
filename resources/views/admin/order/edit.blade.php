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
                            <li class="breadcrumb-item active">Banner</li>
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
                                <h3 class="card-title">Application Edit <a href="{{route('order.view',[$order->id])}}"><span style="color:yellow">Back</span></a></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data" action="{{route('orders.edit', ['id'=>$order->id])}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputistop">Loan Offer</label>
                                        <select name="offer_id" class="form-control" id="offer_id" placeholder="" onchange="changeOffer()">
                                            @foreach($offers as $offer)
                                                <option value="{{$offer->id}}" {{$offer->id==$order->offer_id?'selected':''}}  day="{{$offer->day}}" amount="{{$offer->amount}}" interest="{{$offer->interest}}">{{$offer->id.'/ Rs.'.$offer->amount.'/'.$offer->day.' days'.'/'.$offer->interest.'%'}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Offer Amount</label>
                                        <input type="text" name="amount" class="form-control" id="offer_amount" placeholder="" value="{{$selected_offer->amount}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Days</label>
                                        <input type="text" name="day" class="form-control" id="offer_days" placeholder="" value="{{$selected_offer->day}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Interest(%)</label>
                                        <input type="text" name="interest" class="form-control" id="offer_interest" placeholder="" value="{{$selected_offer->interest}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Approval Status</label>
                                        <select name="approval_status" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="pending" {{$order->approval_status=='pending'?'selected':''}}>Pending</option>
                                            <option value="approved" {{$order->approval_status=='approved'?'selected':''}}>Approved</option>
                                            <option value="disbursed" {{$order->approval_status=='disbursed'?'selected':''}}>Disbursed</option>
                                            <option value="rejected" {{$order->approval_status=='rejected'?'selected':''}}>Rejected</option>
                                            <option value="completed" {{$order->approval_status=='completed'?'selected':''}}>Completed</option>
                                            <option value="default" {{$order->approval_status=='default'?'selected':''}}>Default</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Payback Status</label>
                                        <select name="payback_status" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="pending" {{$order->payback_status=='pending'?'selected':''}}>Pending</option>
                                            <option value="paid" {{$order->payback_status=='paid'?'selected':''}}>Paid</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Amount Transfer Date</label>
                                        <input type="date" name="amount_transfer_date" class="form-control" id="exampleInputimage" placeholder="" value="{{$order->amount_transfer_date}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Tentative Payback Date</label>
                                        <input type="date" name="tentative_payback_date" class="form-control" id="exampleInputimage" placeholder="" value="{{$order->tentative_payback_date}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Paid Back Date</label>
                                        <input type="date" name="paidback_date" class="form-control" id="exampleInputimage" placeholder="" value="{{$order->paidback_date}}">
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
@section('scripts')
<script>
    function changeOffer(){

        amount=$("#offer_id").children("option:selected").attr('amount')
        days=$("#offer_id").children("option:selected").attr('day')
        interest=$("#offer_id").children("option:selected").attr('interest')
        $('#offer_amount').val(amount)
        $('#offer_days').val(days)
        $('#offer_interest').val(interest)
    }
</script>
@endsection
