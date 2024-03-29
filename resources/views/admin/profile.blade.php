@extends('admin.layout.app')
@section('content')
    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-6">
                    <div class="card"><br><br>
                        <center>
                            <img class="rounded-circle avatar-xl"
                                src="{{ !empty($admin->image) ? url('storage/admin/' . $admin->image) : url('no_image.jpg') }}"
                                alt="Card image cap">
                        </center>

                        <div class="card-body">
                            <h4 class="card-title">Admin Name : {{ $admin->name }} </h4>
                            <hr>
                            <h4 class="card-title">Admin Email : {{ $admin->email }} </h4>
                            <hr>
                            <h4 class="card-title">Admin Phone : {{ $admin->phone }} </h4>
                            <hr>
                            <h4 class="card-title">Admin Address : {{ $admin->address }} </h4>
                            <hr>
                            <a href="{{ route('admin-profile-edit') }}" class="btn btn-info btn-rounded waves-effect waves-light">
                                Edit Profile</a>

                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>
@endsection
