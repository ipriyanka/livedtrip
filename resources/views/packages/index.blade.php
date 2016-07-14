@extends('master')
@section('content')
<div class="box_p">
      <div class="titel_bar clear">
        <div class="p_titel">Package Management</div>
        <a class="btn_o fr" href="package/create"><i class="fa fa-plus"></i> Add Package</a>
      </div>
      <div class="from_p"> 
      	<div class="res_table">
      	<table width="100%" cellspacing="0" cellpadding="0" border="0" class="table table-striped">
        <thead>
            <tr>
                <th>Package Title</th>
                <th>Package Cost</th>
                <th>Package Validity</th>
                <th class="tac">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($packages as $package)
        <tr>
            <th>{{$package->package_title}}</th>
            <th>{{$package->package_cost}}</th>
            <td>{{$package->validfrom}} To {{$package->validto}}</td>
            <td class="tac">
                @if ($package->active == 'Y')
                <a class="stat" id="{!! $package->id !!}" href="#" title="active"><i class="fa fa-check-circle fc_blue"></i></a>
                @elseif ($package->active == 'N')
                <a class="stat" id="{!! $package->id !!}" href="#" title="inactive"><i class="fa fa-check-circle fc_grey"></i></a>
                @endif
                <a class="marr15" title="Edit" href="{{url('package',$package->id)}}/edit">Package<i class="fa fa-edit fc_blue"></i></a>
                <a class="marr15" title="Edit" href="{{url('packagedetail',$package->id)}}">Package Details<i class="fa fa-edit fc_blue"></i></a>
                <a class="marr15" title="Edit" href="{{url('packagegallery',$package->id)}}/edit"><i class="fa fa-edit fc_blue"></i>Gallery</a>
                <a class='delete_link' class="marr15" title="Delete" href="#"><i class="fa fa-trash"></i></a>
                <!-- TODO: Delete Button -->
                {!! Form::open([
                'method' => 'DELETE',
                'class' => 'delete_class',
                'action'=>['PackagesController@destroy',$package->id]
                ]) !!}
                {!! Form::close() !!}
                
               <!-- <a href="#" class="marr15" title="view" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i></a>
                <a href="#" title="Active"><i class="fa fa-check-circle fc_blue"></i></a>-->
            </td>                        
        </tr> 
        @endforeach
        </tbody>
    </table>
    	</div>
      </div>
    </div>
<script>
    $(document).ready(function() {
        $(".stat").click(function() {
            var id = $(this).attr('id');
            $.ajax({
                method: "GET",
                url: '<?php echo url('packageChangeStatus/'); ?>/' + id,
                success: function(data) {
                    window.location.href = "<?php echo url('package'); ?>";
                }
            });
        });

    });
</script>
@stop

