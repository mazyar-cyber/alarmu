@extends('admin.layouts.master')
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#option3").click(function() {
                if (this.checked) {
                    $(".checkBox").each(function() {
                        this.checked = true
                    })
                } else {
                    $(".checkBox").each(function() {
                        this.checked = false
                    })
                }
            })
        })
    </script>
@endsection

@section('context')
    <div class="row" id="table-hover-row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">کاربران</h4>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        لیست کاربران ایجاد شده
                    </p>
                </div>
                <div class="dt-action-buttons text-end">
                    <div class="dt-buttons d-inline-flex">
                        <a href="{{ route('users.create') }}" class="dt-button create-new btn btn-primary">
                            <span>افزودن
                                کاربر</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-plus me-50 font-small-4">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg></a>
                    </div>
                </div>
                <form action="{{ route('users.selectedDel') }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="checkBoxArray" value="حدف موارد انتخاب شده">
                    <input type="submit" value="حدف موارد انتخاب شده" name="submit" class="btn btn-danger">
                    @if (\Illuminate\Support\Facades\Session::has('record-delete'))
                        <div class="alert alert-info text-center col-sm-12">
                            {{ session('record-delete') }}
                        </div>
                    @endif
                    @error('checkBoxArray')
                        <div class="alert alert-warning text-center">{{ $message }}</div>
                    @enderror
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="checkBoxArray" id="option3"></th>

                                    <th>ردیف</th>
                                    <th>نام</th>
                                    <th>نام خانوادگی</th>
                                    <th>شماره تلفن همراه</th>
                                    <th>اعتبار سنجی شماره تلفن همراه</th>
                                    <th>ایمیل</th>

                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $d)
                                    <tr>
                                        <td><input class="checkBox" type="checkbox" name="checkBoxArray[]"
                                                value="{{ $d->id }}"></td>
                                        <td>
                                            {{ $key + 1 }}
                                        </td>
                                        <td>{{ $d->name }}</td>
                                        <td>
                                            {{ $d->lastName }}
                                        </td>
                                        <td> {{ $d->phoneNumber }} </td>
                                        <td>
                                            @if ($d->phoneNumber_verified)
                                                <span class="badge rounded-pill badge-light-success me-1">تایید شده</span>
                                            @else
                                                <span class="badge rounded-pill badge-light-danger me-1">تایید نشده</span>
                                            @endif

                                        </td>
                                        <td>
                                            {{ $d->email }}
                                        </td>
                                        {{-- <td>
                                            <a href="{{ route('users.edit', $d->id) }}">ویرایش</a>
                                        </td> --}}
                                        <td>

                                            <div class="dropdown">
                                                <button type="button"
                                                    class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-more-vertical">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="12" cy="5" r="1"></circle>
                                                        <circle cx="12" cy="19" r="1"></circle>
                                                    </svg>
                                                </button>

                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    <a class="dropdown-item" href="{{ route('users.edit', $d->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                            height="14" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-edit-2 me-50">
                                                            <path
                                                                d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                            </path>
                                                        </svg>
                                                        <span>Edit</span>
                                                    </a>



                                                    <a class="dropdown-item" href="#">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-grid">
                                                            <rect x="3" y="3" width="7"
                                                                height="7"></rect>
                                                            <rect x="14" y="3" width="7"
                                                                height="7"></rect>
                                                            <rect x="14" y="14" width="7"
                                                                height="7"></rect>
                                                            <rect x="3" y="14" width="7"
                                                                height="7"></rect>
                                                        </svg>
                                                        <span>Detail</span>
                                                    </a>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
