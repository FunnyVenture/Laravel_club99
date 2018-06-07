{{--notifications are messages generated by the system automatically for admin
  This view generates a GUI with a list of notifications in the admin dashboard--}}

@extends('layouts.admin.app')

@section('title', 'Notifications')

@section('css')
@endsection

@section('content')
    <section class="content">
        {{--header content--}}
        <div class="row">
            <div class="col-xs-9 col-md-6 col-lg-9 page-head-line">Notifications</div>
            <div class="col-xs-12 col-md-6 col-lg-3 filter-search">
                <div class="col-xs-4 text-right" style="top:8px;">Search</div>
                <div class="col-xs-8 padding0">
                    <input type="text" class="search" id="notificationsInput" style="width:100%">
                </div>
            </div>
        </div>
        {{--end header content--}}

        {{--the following message appears when member doesn't have any notifications--}}
        @if($notifications->count() == 0)
            <p class="size50 os-regular">You don't have any notifications.</p>
        @else
            {{--main content - list of notifications--}}
            <div id="items" class="new-box notification-table">
                <ul class="border-bottom list">
                    @foreach($notifications as $notification)
                        <li>
                            <a class="item" href="{{url('admin/notifications/'.$notification->id)}}">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if($notification->read == 0)
                                            <span class="label label-danger">New</span>
                                        @endif
                                        <div class="dark-grey">
                                            {{Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}
                                        </div>
                                        <div class="notification">
                                            @if(isset(json_decode($notification->extra, true)['message']))
                                                {{json_decode($notification->extra, true)['message']}}
                                            @else
                                                Unknown notification
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{--end main content--}}
        @endif

    </section>
@endsection

@section('js')


    <script type="text/javascript">
        $(document).ready(function () {
            var options = {
                valueNames: ['item']
            };

            var notificationsSearch = new List('items', options);
            $('#notificationsInput').keyup(function(){
                notificationsSearch.search($(this).val());
            })
        });
    </script>
@endsection