@extends('admin.layout.app')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">data Edit Page </h4>

                            <form method="post" action="{{ route('portfolio-update') }}" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" name="old_image" value="{{ $data->image }}">

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">data Name</label>
                                    <div class="col-sm-10">
                                        <input name="name" class="form-control" type="text"
                                            value="{{ $data->name }}" id="example-text-input">
                                        @error('name')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">data Title </label>
                                    <div class="col-sm-10">
                                        <input name="title" class="form-control" type="text"
                                            value="{{ $data->title }}" id="example-text-input">

                                        @error('title')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Portfolio Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="type">
                                            <option value="Website" @if ($data->type == 'Website') selected @endif>Website</option>
                                            <option value="Mobile App" @if ($data->type == 'Mobile App') selected @endif>Mobile App</option>
                                            <option value="Dashboard" @if ($data->type == 'Dashboard') selected @endif>Dashboard</option>
                                            <option value="Landing Page" @if ($data->type == 'Landing Page') selected @endif>Landing Page</option>
                                            <option value="Brading" @if ($data->type == 'Brading') selected @endif>Brading</option>
                                            <option value="Graphic Design" @if ($data->type == 'Graphic Design') selected @endif>Graphic Design</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">data Description
                                    </label>
                                    <div class="col-sm-10">
                                        <textarea id="elm1" name="description">
      {{ $data->description }}
      </textarea>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">data Image </label>
                                    <div class="col-sm-10">
                                        <input name="image" class="form-control" type="file" id="image">
                                    </div>
                                </div>
                                <!-- end row -->


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"> </label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded avatar-lg" src="{{ asset($data->image) }}"
                                            alt="Card image cap">
                                    </div>
                                </div>
                                <!-- end row -->
                                <input type="submit" class="btn btn-info waves-effect waves-light"
                                    value="Update Portfolio Data">
                            </form>



                        </div>
                    </div>
                </div> <!-- end col -->
            </div>



        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
