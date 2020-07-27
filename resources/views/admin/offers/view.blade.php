@extends('layouts.admin')
@section('contents')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Loan Offers</h1>
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
                <a href="{{route('offers.create')}}" class="btn btn-primary">Add Offer</a>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Amount</th>
                    <th>Days</th>
                    <th>Interest</th>
                    <th>Isactive</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
				@foreach($offers as $offer)
                  <tr>
                      <td>
                      {{$offer->id}}
                      </td>
                      <td>
                      {{$offer->amount}}
                       </td>
                      <td>
                      {{$offer->day}}
                       </td>
                      <td>
                          {{$offer->interest}} %
                      </td>
                      <td>
                        @if($offer->isactive==1){{'Yes'}}
                             @else{{'No'}}
                             @endif
                        </td>
                      <td><a href="{{route('offers.edit',['id'=>$offer->id])}}" class="btn btn-success">Edit</a>
                      </td>
                 </tr>
                 @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                      <th>S.No</th>
                      <th>Amount</th>
                      <th>Days</th>
                      <th>Interest</th>
                      <th>Isactive</th>
                      <th></th>
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

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@endsection

