@extends('layouts.admin.master')

@section('page')
    Reply Messages
@endsection
@section('content')
    <div class="col-xl-12" id="reply_table">

        <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            @yield('page')
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table" >
                                <thead>
                                    <tr>
                                        <th width="10%">Serial</th>
                                        <th width="70%">Your Previous Reply</th>
                                        <th width="10%">Type</th>
                                        <th width="10%">Date</th>
                                    </tr>
                                    <tbody>
                                        @foreach ($data->replies as $reply)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$reply->content}}</td>
                                            <td>{{$reply->type}}</td>
                                            <td>{{date('d-m-Y',strtotime('reply->created_at'))}}</td>
                                        </tr>
                                     @endforeach
                                    </tbody>
                                </thead>
                            </table>
                        </div>
                        
                    </div>
                    <div id="success_message"></div>
                    <form class="kt-form" method="post" id="reply_message" data-action="{{ route('admin.reply_submit') }}">
                        @csrf
                        <div class="kt-portlet__body">

                            <div class="form-group form-group-last" id="success_message"></div>

                            <div class="form-group form-group-last" id="error_message"></div>
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <div class="row">
                                <div class="form-group col-md-8 ">
                                    <label>Customer Message</label>
                                  <textarea class="form-control" rows="5" cols="20" disabled="true">{{$data->content}}</textarea>
                                </div>

                                <div class="form-group col-md-8 ">
                                    <label>Your Message</label>
                                  <textarea class="form-control" required="" name="content" rows="5" cols="20"></textarea>
                                </div>

                            </div>

                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary">Reply</button>
                                <a href="{{ route('admin.get_user_message') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

    </div>
@endsection

@push('js')

<script>
    $(document).ready(function () {
        $("#reply_message").on("submit",function (e) {
            e.preventDefault();
            var formData = new FormData( $("#reply_message").get(0));
            $.ajax({
                url : $(this).attr('data-action'),
                method: "post",
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {

                    $("#success_message").html('<div class="alert alert-success">'+response.message+'</div>')
                    $("form").trigger("reset");
                   // $("#reply_table").load("#reply_table");
                    location.reload();
                },

               
            });
        })
    })
</script>
@endpush