@extends('dashboard_owner.layout.master')

@section('title', __('dashboard.dashboard') . ' | ' .  __('dashboard.list') . ' | ' . __('owner.notifications'))

@section('content')

    <div class="page-header">
        <div class="page-title">
            <h3>Dashboard</h3>
        </div>

        <nav class="breadcrumb-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    {{-- <a href="{{ route('dashboard.admin.welcome') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    </a> --}}
                </li>
                {{-- <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.orders.index') }}">@lang('orders.orders')</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page"><span>عرض</span></li>
            </ol>
        </nav>

    </div>

 <!--  BEGIN CONTENT AREA  -->

<div class="account-settings-container layout-top-spacing">

    <div class="account-content">
        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
            <div class="row">
              <div class="add-edit-event-box">
                  <div class="add-edit-event-content">
                      <!-- <h5 class="add-event-title modal-title">@lang('statics.show_order')</h5> -->
                      <!-- <h5 class="edit-event-title modal-title">Edit Events</h5> -->

                      <form action="{{ route('dashboard.owner.create.new.order') }}" method="post">
                          @csrf
                          @method('post')

                          <div class="row">

                              <div class="col-md-12">
                                  <label for="start-date">@lang('owner.groom_name')</label>
                                  <div class="d-flex event-title">
                                      <input name="groom_name" type="text" placeholder="Enter Title" class="form-control" name="task" value="{{$order->groom_name}}">
                                  </div>
                              </div>

                              <div class="col-md-6 col-sm-6 col-12">
                                  <div class="form-group start-date">
                                      <label for="start-data">@lang('statics.event_data')</label>
                                      <div class="d-flex">
                                          <input name="event_data" placeholder="Start Date" class="form-control" type="date" value="{{$order->event_data}}">
                                      </div>
                                  </div>
                              </div>

                              <div class="col-md-6 col-sm-6 col-12">
                                  <div class="form-group start-date">
                                      <label for="start-date">@lang('statics.event_time')</label>
                                      <div class="d-flex">
                                          <input name="event_time" placeholder="Start Date" class="form-control" type="time" value="{{$order->event_time}}">
                                      </div>
                                  </div>
                              </div>

                              <div class="col-md-6 col-sm-6 col-12">
                                  <div class="form-group start-date">
                                      <label for="start-date">@lang('statics.primary_key_type')</label>
                                      <div class="d-flex">
                                      </div>
                                      <input name="primary_key_type" placeholder="Start Date" class="form-control" type="text" value="{{$order->primary_key_type}}">
                                  </div>
                              </div>

                              <div class="col-md-6 col-sm-6 col-12">
                                  <div class="form-group start-date">
                                      <label for="start-date">@lang('statics.primary_key_number')</label>
                                      <div class="d-flex">
                                          <input name="primary_key_number" placeholder="Start Date" class="form-control" type="text" value="{{$order->primary_key_number}}">
                                      </div>
                                  </div>
                              </div>

                              <div class="col-md-6 col-sm-6 col-12">
                                  <div class="form-group end-date">
                                      <label>@lang('owner.packages')</label>
                                      <select name="packages_id" class="selectpicker form-control">
                                          <option value="">@lang('owner.no_categorey')</option>
                                          @foreach ($packages as $package)

                                          <option value="{{ $package->id }}" {{ $package->id == old('', $order->banner->categoreys_id) ? 'selected' : ' ' }}>
                                            {{ $package->name }}
                                          </option>
                                                  {{-- {{ $package->name }} : @lang('dashboard.price') : {{ $package->price }}
                                              </option> --}}
                                          @endforeach
                                      </select>
                                  </div>
                              </div>

                              <div class="col-12 mt-3">
                                  <div class="form-group end-date">
                                      <label>@lang('admin.bookings')</label>
                                      <select name="event_sort" class="selectpicker form-control">
                                          <option value="">@lang('owner.no_categorey')</option>
                                          @foreach ($bookings as $booking)

                                            <option value="{{ $booking->id }}" {{ $booking->id == old('', $order->banner->categoreys_id) ? 'selected' : ' ' }}>
                                              {{ $booking->name }}
                                            </option>



                                          @endforeach
                                      </select>
                                  </div>
                              </div>

                              {{-- @foreach ($service_categorys as $category)

                                  <div class="col-12 mt-4">
                                      <div class="form-group end-date">
                                          <label>{{ $category->name }}</label>
                                          <select name="service_id[]" class="selectpicker form-control">
                                              <option value="">@lang('owner.no_categorey')</option>
                                              @foreach ($category->service as $data)

                                                  <!-- <option value="{{ $data->id }}"> -->
                                                    <option value="{{ $data->id }}" {{ $data->id == old('', $order->data_id) ? 'selected' : ' ' }}>@lang('orders.'. $data->id)</option>

                                                      {{ $data->name }} : @lang('dashboard.price') : {{ $data->price }}
                                                  </option>

                                              @endforeach
                                          </select>
                                      </div>

                                      @if ($category->allow_quantity == true)
                                          <div class="form-group mt-4">
                                              <label>Quntty</label>
                                              <input type="number" name="quantity_service_id[{{ $category->id }}]" class="form-control">
                                          </div>
                                      @endif

                                  </div>

                              @endforeach --}}

                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                  <label for="start-date" class="">@lang('dashboard.description')</label>
                                  <div class="d-flex event-description">
                                      <textarea id="taskdescription" name="note" placeholder="Enter Description" rows="3" class="form-control" name="taskdescription"></textarea>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-md-12">
                                  <div class="event-badge">
                                      <p class="">@lang('statics.status_order')</p>

                                      <div class="d-sm-flex d-block">

                                          <div class="n-chk">
                                              <label class="new-control new-radio radio-warning">
                                                  <input type="radio" class="new-control-input" value="2" name="order_statuses_id" value="bg-warning" required>
                                                  <span class="new-control-indicator"></span>@lang('admin.waiting')
                                              </label>
                                          </div>

                                          <div class="n-chk">
                                              <label class="new-control new-radio radio-success">
                                                  <input type="radio" class="new-control-input" value="1" name="order_statuses_id" value="bg-success" required>
                                                  <span class="new-control-indicator"></span>@lang('admin.completed')
                                              </label>
                                          </div>

                                          <div class="n-chk">
                                              <label class="new-control new-radio radio-danger">
                                                  <input type="radio" class="new-control-input" value="3" name="order_statuses_id" value="bg-danger" required>
                                                  <span class="new-control-indicator"></span>@lang('admin.cancel')
                                              </label>
                                          </div>
                                      </div>

                                  </div>
                              </div>
                          </div>
                              <button id="add-e" class="btn">adddd</button>
                      </form>
                  </div>
              </div>
                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                    <form method="post" action="{{ route('dashboard.admin.orders.update', $order->id) }}" enctype="multipart/form-data" class="section general-info">
                          @csrf
                          @method('put')

                        <div class="info">
                            <div class="row">
                                <div class="col-lg-12 mx-auto">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 mt-md-0 mt-4">

                                            <div class="row">

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>@lang('orders.order_statuses')</label>
                                                        <select name="order_statuses_id" class="selectpicker form-control">
                                                            <option selected disabled>@lang('dashboard.choose') @lang('orders.order_statuses')</option>
                                                            @foreach ($orderStatus as $status)

                                                                <option value="{{ $status->id }}" {{ $status->id == old('', $order->order_statuses_id) ? 'selected' : ' ' }}>@lang('orders.'. $status->id)</option>

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>{{-- col-12 --}}

                                                <div class="col-12">
                                                    <button class="btn btn-primary col-12">@lang('dashboard.add')</button>
                                                </div>

                                            </div>

                                        </div>
                                    </div>{{-- row --}}
                                </div>{{-- col mx-auto --}}
                            </div>{{-- row --}}
                        </div>{{-- info --}}
                    </form>
                </div>{{-- layout-spacing --}}
            </div>{{-- row --}}
        </div>{{-- scrollspy-example --}}
    </div>{{-- account-content --}}
</div>{{-- container --}}

<!--  END CONTENT AREA  -->

@endsection
