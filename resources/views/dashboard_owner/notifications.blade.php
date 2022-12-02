@extends('dashboard_owner.layout.master')

@section('title', __('dashboard.dashboard') . ' | ' .  __('dashboard.list') . ' | ' . __('owner.notifications'))

@section('content')

    <div class="page-header">
        <div class="page-title">
            <h3>@lang('dashboard.dashboard')</h3>
        </div>

        <nav class="breadcrumb-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                	<a href="{{ route('dashboard.owner.welcome') }}">
	                	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
	                	<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
	                	<polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                	</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><span>@lang('owner.notifications')</span></li>
            </ol>
        </nav>{{-- breadcrumb --}}
    </div>{{-- page-header --}}

    <div class="row" id="cancel-row">
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="table-form">
                    <div class="form-group row">
                        <div class="col-8 col-md-4">
                            <input type="text" class="form-control form-control-sm" name="min" id="min" placeholder="@lang('dashboard.search')">
                        </div>
                        <a href="#" class="btn btn-primary">@lang('dashboard.add')</a>
                    </div>
                </div>{{-- table-form --}}
            </div>{{-- widget-content --}}
        </div>{{-- col col-xl-12 --}}
    </div>{{-- row --}}

    <div class="row" id="cancel-row">

        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive">
                    <table class="display table" style="width:100%">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>رقم الطلب</th>
                                <th>نوع الطلب</th>

                                <th></th>
                                <th class="no-content">@lang('dashboard.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach ($notifications as $index=>$notification)
    	                        <tr>
    	                            <td>{{ $index+1 }}</td>

                                        <td>"{{ $notification->data['order_id'] }}"</td>
                                          <td>"{{ $notification->data['event_sort'] }}"</td>


    	                            <td>"{{ $notification->created_at->toFormattedDateString() }}"</td>
                                   <td>
                                        <a href="{{url('dashboard/owner/order/'.$notification->data['order_id'].'/show')}}" class="btn btn-primary">عرض</a>


                                    </td>
    	                        </tr>
                        	@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>{{-- row --}}

@endsection
