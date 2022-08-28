@extends('admin.layouts.master')
@section('context')
    <section id="dashboard-ecommerce">
        <div class="col-sm-12 ">
            @if (\Illuminate\Support\Facades\Session::has('verify-successful'))
                <div class="alert alert-success text-center">
                    {{ session('verify-successful') }}
                </div>
            @endif
        </div>
    </section>
@endsection
