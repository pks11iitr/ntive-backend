@extends('layouts.admin')
@section('contents')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Customers Contacts</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('customer.list')}}">Customers</a></li>
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



                                            <div class="row">
                                                <div class="col-4">
                                                    <input  class="form-control" name="search" placeholder="search name/number" value=""  type="text" id="myInput"/>
                                                </div>



                                            </div>

                                    </div>

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Contact No</th>
{{--                                        <th>Email</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody id="myTable">
                                    @foreach($contacts as $c)
                                    <tr>

                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$c->name}}</td>
                                        <td>{{$c->mobile}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>



                            <!-- /.card-body -->
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
@section('scripts')

        <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

    </script>
@endsection
