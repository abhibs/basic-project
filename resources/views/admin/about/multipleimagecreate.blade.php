@extends('admin.layout.app')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Multi Image</h4> <br><br>

                            <form method="post" action="{{ route('multiple-image-store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">About Multi Image
                                    </label>
                                    <div class="col-sm-10">
                                        <input name="image[]" class="form-control" type="file" id="image" multiple>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"> </label>
                                    <div class="col-sm-10" id="imagePreview">
                                        @if (!isset($data))
                                          <img id="showImage" class="rounded avatar-lg" src="{{  url('no_image.jpg') }}" alt="Card image cap">
                                        @endif
                                    </div>
                                </div>
                                <!-- end row -->

                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Multi Image">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
    <style>
        #imagePreview {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 10px;
        }

        #imagePreview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var files = e.target.files;
                var previewContainer = $('#imagePreview');
                previewContainer.empty();

                for (var i = 0; i < files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = (function(file) {
                        return function(e) {
                            var image = $('<img>').attr('src', e.target.result);
                            previewContainer.append(image);
                        };
                    })(files[i]);
                    reader.readAsDataURL(files[i]);
                }
            });
        });
    </script>
@endsection
