@extends('dashboard_admin.layout.master')

@section('title', __('dashboard.admins'))

@section('content')

    <div class="page-header">
        <div class="page-title">
            <h3>Dashboard</h3>
        </div>

        <nav class="breadcrumb-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.admin.home') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.admin.admins.index') }}">admin</a></li>
                <li class="breadcrumb-item active" aria-current="page"><span>create</span></li>
            </ol>
        </nav>

    </div>

 <!--  BEGIN CONTENT AREA  -->

<div class="account-settings-container layout-top-spacing">

    <div class="account-content">
        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                    <form method="post" action="{{ route('dashboard.admin.admins.update', $admin->id) }}" enctype="multipart/form-data" class="section general-info">
                          @csrf
                          @method('put')

                        <div class="info">
                            <h6 class="">create new admin</h6>
                            <div class="row">
                                <div class="col-lg-11 mx-auto">
                                    <div class="row">
                                        <div class="col-xl-2 col-lg-12 col-md-4">
                                            <div class="upload mt-4 pr-md-4">
                                                <input type="file" name="image" id="input-file-max-fs" class="dropify"
                                                data-default-file="{{ $admin->image_path }}"
                                                data-max-file-size="2M"/>
                                                <p class="mt-2">
                                                    <i class="flaticon-cloud-upload mr-1"></i>
                                                    Upload Picture
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                            <div class="form">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="fullName">Full Name</label>
                                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror mb-4" placeholder="Full Name" value="{{ $admin->name }}">
                                                            @error('name')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="fullName">Full email</label>
                                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror mb-4" placeholder="enter email" value="{{ $admin->email }}">
                                                            @error('email')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="fullName">phone</label>
                                                            <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror mb-4" placeholder="enter phone" value="{{ $admin->phone }}">
                                                            @error('phone')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="fullName">password</label>
                                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror mb-4" placeholder="enter Name" value="{{ old('password') }}">
                                                            @error('password')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="fullName">password confirmation</label>
                                                            <input type="password" name="password_confirmation" class="form-control mb-4" placeholder="enter Name">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary col-lg-11">add</button>
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
