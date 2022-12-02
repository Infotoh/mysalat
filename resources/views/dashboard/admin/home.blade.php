@extends('dashboard.admin.layouts.app')

@section('content')

    <div>
        <h2>@lang('site.home')</h2>
    </div>
    @forelse($notifications as $notification)
           <div class="alert alert-success" role="alert">
               [{{ $notification->created_at }}] ({{ $notification->data['order_id'] }}) has just registered.
               <a href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
                   Mark as read
               </a>
           </div>

           @if($loop->last)
               <a href="#" id="mark-all">
                   Mark all as read
               </a>
           @endif
       @empty
           There are no new notifications
       @endforelse
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item">@lang('site.home')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">



        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection
