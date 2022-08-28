@extends('admin.layouts.master')
@section('context')
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    {!! implode('', $errors->all("<div class='col-sm-12 text-center alert alert-danger'>:message </div>")) !!}
                @endif
                @if (\Illuminate\Support\Facades\Session::has('user-save'))
                    <div class="alert alert-success text-center">
                        {{ session('user-save') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">ویرایش کاربر</h4>
                    </div>
                    <div class="col-sm-12 alert alert-info text-center">
                        در صورت تغییر شماره تلفن اعتبار سنجی باید دوباره انجام شود
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update',$data->id) }}" method="POST" class="form">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-column">نام</label>
                                        <input type="text" id="first-name-column" class="form-control"
                                            placeholder="First Name" name="name" value="{{ $data->name }}"  required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="last-name-column">نام خانوادگی</label>
                                        <input type="text" id="last-name-column" class="form-control"
                                            placeholder="Last Name" name="lastname" value="{{ $data->lastName }}"  required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="city-column">ایمیل</label>
                                        <input type="email" id="city-column" class="form-control"
                                            placeholder="email@a.com" name="email" value="{{ $data->email }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="country-floating">شماره تلفن همراه</label>
                                        <input type="number" id="country-floating" class="form-control"  value="{{ $data->phoneNumber }}" name="phoneNumber"
                                            placeholder="phone Number" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="country-floating">رمز عبور</label>
                                        <input type="password" class="form-control" name="password" placeholder="password"
                                            required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button
                                        class="btn btn-primary me-1 waves-effect waves-float waves-light col-sm-12">ذخیره</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
