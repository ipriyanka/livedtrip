@extends('master')
@section('content')


<div class="box_p">
    <div class="titel_bar clear">
        <div class="p_titel">Update Hotel Gallery</div>

    </div>

    <div class="from_p">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @foreach ($hotel_gallery as $gallery)
        <div class="row" >
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-6"></label>
                    <div class="col-md-6">
                        <img src="{{url('/images/hotel_gallery/'. $gallery->image_name) }}" height="70" width="70" alt="No Image Available">
                        <a id="{{$gallery->id }}" class="remove_gallery" href="#">Remove</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach




        {!! Form::open(array('url' => 'hotelgallery','method'=>'POST', 'files'=>true)) !!}
        <div class="row" id="first">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-md-6">Select Image (550X336):</label>
                    <div class="col-md-6">
                        <span class="file">
                            {!! Form::file('gallery_img[]',['class'=>'upload']) !!}                            
                        </span>
                        <p class="errors">{!!$errors->first('image')!!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mart15" id="add_more_div">
            <div class="col-12">
                <a id="add_more" href="javascript:void()">Add More</a>
            </div>   
        </div> 

        <div class="row">
            <div class="col-md-12 tar">
                {!! Form::hidden('hotel_id',$hotel_id)!!}
                {!! Form::submit('Add Hotel',['class'=>'btn_small bg_blue'])!!}

            </div>
        </div>                     
        {!!  Form::close()  !!}

    </div>

    <script>
        $(document).ready(function() {
            $("#add_more").click(function() {
                $("#add_more_div").before('<div class="row" id="first"><div class="col-md-6"><div class="form-group"><label class="col-md-6">Select Image (550X336):</label><div class="col-md-6"><span class="file"><input class="upload" name="gallery_img[]" type="file"><input type="text" readonly="" class="file_tbox"> <button class="btn-file"></button></span><p class="errors"></p></div></div></div><a class="remove_div" href="javascript:void(0)">Remove</a></div>');
                $('.file').click(function() {
                    $(this).find('.upload').show();
                    $(this).find('.btn-file').prop('disabled', false);

                    $(this).find('.upload').change(function() {
                        var filename = $(this).val();
                        $(this).next('.file_tbox').val(filename);
                        alert(filename.attr('src'));
                    });
                });
            });
            $("body").on("click", ".remove_div", function() {
                $(this).closest("div").remove();
            });

            $(".remove_gallery").click(function() {
                var id = $(this).attr('id');
                var ele = $(this);
                $.ajax({
                    method: "GET",
                    url: '<?php echo url('removeGallery/'); ?>/'+id,
                    success: function(data) {
                       ele.closest("div").remove();
                    }
                });
            });



        });
    </script>

</div>
@stop

