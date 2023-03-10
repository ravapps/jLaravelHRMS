@extends('layouts.dashboard')
@section('page-title')
    {{__('Create Document Upload')}}
@endsection
@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box-hori">
            <h4 class="page-title">{{__('Create Document Uploads')}}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{__('home')}}">{{__('Dashboard')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('document-upload.index')}}">{{__('Document Uploads')}}</a></li>
                  <li class="breadcrumb-item active">{{__('Create Document Upload')}}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<hr class="mt-0">

{{Form::open(array('url'=>'document-upload','method'=>'post', 'enctype' => "multipart/form-data"))}}
        <div class="row">
            <div class="col-md-12 ">
                <div class="card ">
                    <!-- <div class="card-header"><h4>{{__('Document Uploads')}}</h4></div> -->
                    <div class="card-body ">


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                {{Form::label('name',__('Name'))}}
                                 {{Form::text('name',null,array('class'=>'form-control','required'=>'required'))}}
                                 <input type="hidden" name="role" value="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">Upload Documents</label>
                                  <input type="file" id="check_format" name="images[]" class="form-control" multiple required>
                                  <em>Upload files only: png,jpg,jpeg,pdf,xlsx,csv</em>
                                </div>
                            </div>



                        </div>

                        <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            {!! Form::submit('Create', ['class' => 'btn btn-success float-right']) !!}
                        </div>
                        </div>

                    </div>
                </div>
            </div>

    </div>

{!! Form::close() !!}

@endsection
@push('script-page')
<script>
$(document).ready(function(){
    $("#check_format").on("change",function(){
        var check_format=$(this).val();
        var ext = check_format.split('.').pop();
        if(ext=='png' || ext=='jpg' || ext=='jpeg' || ext=='xlsx' || ext=='csv' || ext=='pdf' || ext=='PDF')
        {

        }
        else
        {
            alert("Please select valid file format");
            $("#check_format").val('');
            return false;
        }
    });
});
</script>
@endpush
<!-- @push('script-page')
<script>
    $(function () {

        $('.input-images-1').imageUploader();

        let preloaded = [];

        $('.input-images-2').imageUploader({
            preloaded: preloaded,
            imagesInputName: 'photos',
            preloadedInputName: 'old'
        });

        $('form').on('submit', function (event) {

            // Stop propagation


            // Get some vars
            let $form = $(this),
                $modal = $('.modal');

            // Set name and description
            $modal.find('#display-name span').text($form.find('input[id^="name"]').val());
            $modal.find('#display-description span').text($form.find('input[id^="description"]').val());

            // Get the input file
            let $inputImages = $form.find('input[name^="images"]');
            if (!$inputImages.length) {
                $inputImages = $form.find('input[name^="photos"]')
            }

            // Get the new files names
            let $fileNames = $('<ul>');
            for (let file of $inputImages.prop('files')) {
                $('<li>', {text: file.name}).appendTo($fileNames);
            }

            // Set the new files names
            $modal.find('#display-new-images').html($fileNames.html());

            // Get the preloaded inputs
            let $inputPreloaded = $form.find('input[name^="old"]');
            if ($inputPreloaded.length) {

                // Get the ids
                let $preloadedIds = $('<ul>');
                for (let iP of $inputPreloaded) {
                    $('<li>', {text: '#' + iP.value}).appendTo($preloadedIds);
                }

                // Show the preloadede info and set the list of ids
                $modal.find('#display-preloaded-images').show().html($preloadedIds.html());

            } else {

                // Hide the preloaded info
                $modal.find('#display-preloaded-images').hide();

            }

            // Show the modal
            $modal.css('visibility', 'visible');
        });

        // Input and label handler
        $('input').on('focus', function () {
            $(this).parent().find('label').addClass('active')
        }).on('blur', function () {
            if ($(this).val() == '') {
                $(this).parent().find('label').removeClass('active');
            }
        });

        // Sticky menu
        let $nav = $('nav'),
            $header = $('header'),
            offset = 4 * parseFloat($('body').css('font-size')),
            scrollTop = $(this).scrollTop();

        // Initial verification
        setNav();

        // Bind scroll
        $(window).on('scroll', function () {
            scrollTop = $(this).scrollTop();
            // Update nav
            setNav();
        });

        function setNav() {
            if (scrollTop > $header.outerHeight()) {
                $nav.css({position: 'fixed', 'top': offset});
            } else {
                $nav.css({position: '', 'top': ''});
            }
        }
    });
</script>

@endpush
 -->
