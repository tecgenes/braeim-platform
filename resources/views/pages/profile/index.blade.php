@extends('layouts.master')
@section('title')
    @lang('translation.settings')
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
            <img src="{{ URL::asset('build/images/profile-bg.jpg') }}" class="profile-wid-img" alt="">
            <div class="overlay-content">
                <div class="text-end p-3">
                    <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                        <input id="profile-foreground-img-file-input" type="file" class="profile-foreground-img-file-input">
                        <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
                            <i class="ri-image-edit-line align-bottom me-1"></i>{{__("profile.change_cover")}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-3">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                            <img src="{{auth()->user()->getUserAvatar()}}"
                                 class="  rounded-circle avatar-xl img-thumbnail user-profile-image"
                                 alt="user-profile-image">
                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <input name="avatar" id="profile-img-file-input" type="file" onchange="this.form.submit()" class="profile-img-file-input">
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                    <span class="avatar-title rounded-circle bg-light text-body">
                                        <i class="ri-camera-fill"></i>
                                    </span>
                                    </label>
                                </form>
                            </div>
                        </div>
                        <h5 class="fs-16 mb-1">{{auth()->user()->name}}</h5>
                        <p class="text-muted mb-0"></p>
                        <hr>
                        <button type="submit" class="btn btn-primary w-xs col-12">
                            {{__("profile.change_avatar")}}
                        </button>
                    </div>
                </div>
            </div>

        </div>
        <!--end col-->
        <div class="card col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            @if(auth()->user()->email_verified_at == null)
                            <div class=" col-12 btn btn-warning">{{__("profile.email_not_verified")}}</div>
                            <hr>
                            @endif
                            <h3>{{__("profile.personal_info")}}</h3>
                                <form action="{{route('update.profile', auth()->user()->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="firstnameInput" class="form-label">{{__("profile.name")}}</label>
                                                <input name="name" type="text" class="form-control" id="firstnameInput"
                                                       placeholder="{{__("profile.enter_name")}}" value="{{auth()->user()->name}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">{{__("profile.phone")}}</label>
                                                <input name="mobile" type="text" class="form-control" id="phonenumberInput"
                                                       placeholder="{{__("profile.enter_phone")}}" value="{{auth()->user()->mobile}}">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">{{__("profile.email")}}</label>
                                                <input name="email" type="email" class="form-control" id="emailInput" disabled
                                                       placeholder="Enter your email" value="{{ auth()->user()->email }}">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="JoiningdatInput" class="form-label">{{__("profile.join_date")}}</label>
                                                <input type="text" class="form-control" disabled
                                                       value="{{auth()->user()->created_at}}" />
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label class="fw-semibold">{{__('profile.role')}}</label>
                                            <select class="js-example-basic-multiple" name="roles[]"
                                                    multiple="multiple" @if(auth()->user()->getRoleNames()->contains('Super Admin')) disabled @endif>
                                                @foreach($roles as $role)
                                                    <option @if(  auth()->user()->getRoleNames()->contains($role->name) ) selected @endif
                                                    value="{{$role->name}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="submit" class="btn btn-primary w-xs">
                                                    {{__("profile.update")}}
                                                </button>

                                                <button type="button" class="btn btn-soft-success">{{__("profile.cancel")}}</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            <hr>
                            <h3>{{__("profile.change_password")}}</h3>
                                <form action="{{route('change.password')}}" method="POST">
                                    @csrf
                                    <div class="row g-2">
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="oldpasswordInput" class="form-label">{{__("profile.old_password")}}</label>
                                                <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldpasswordInput"
                                                       placeholder="{{__("profile.enter_current_password")}}">
                                                @error('old_password')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="newpasswordInput" class="form-label">{{__("profile.new_password")}}</label>
                                                <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newpasswordInput"
                                                       placeholder="{{__("profile.enter_new_password")}}">
                                                @error('new_password')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="confirmpasswordInput" class="form-label">{{__("profile.confirm_password")}}</label>
                                                <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmpasswordInput"
                                                       placeholder="{{__("profile.confirm_password")}}">
                                                @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success">{{__("profile.change_password")}}</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>

                                <hr>
                            <h3>{{__("profile.delete_account")}}</h3>
                                <form action="{{route('destroy.account')}}" method="POST">
                                    @csrf
                                    <div>
                                        <p class="text-muted">{{__("profile.delete_account_title")}}</p>
                                        <div>
                                            <input name="current_password" type="password" class="form-control" id="passwordInput"
                                                   placeholder="{{__("profile.enter_current_password")}}" style="max-width: 265px;">
                                        </div>
                                        <div class="hstack gap-2 mt-3">
                                            <button type="submit" class="btn btn-soft-danger">{{__("profile.close_account")}}</button>
                                            <button href="" class="btn btn-light">{{__("profile.cancel")}}</button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
@section('script')
    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>    <script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
