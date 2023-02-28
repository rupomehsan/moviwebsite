@extends('layouts.default.master')
@section('data_count')
    {{-- Start:: content heading --}}
    <div class="content-heading">
        <div class="row">
            {{-- title --}}
            <div class="col-md-8 content-title">
                <span class="title">Make Payment</span>
                <div class="title-line"></div>
            </div>
            {{-- title --}}
        </div>
    </div>
    {{-- End:: content heading --}}

    {{-- Start::Content Body --}}
    <form id="userCreateForm" method="POST" enctype="multipart/form-data" action="/admin/offline-payment/store">
        @csrf
        <div class="row create-body margin-top-40">

            <div class="offset-md-1 col-md-10" id="accessControl">
                <div class="form-select">
                    <select name="user_type" id="user_type" class="form-control create-form">
                        <option selected value="exists">User Already Exists</option>
                        <option selected value="new">New User Create</option>
                    </select>
                    <span class="text-danger">{{ $errors->first('user_type') }}</span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10" id="selectUser">
                <div class="form-select">
                    <select name="user_id" id="user_id" class="form-control create-form">
                        <option selected value="0">Select User*</option>
                        @if (!empty($user))
                            @foreach ($user as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <span class="text-danger">{{ $errors->first('user_id') }}</span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10 display-none createUser">
                <div class="form-group">
                    <input type="text" name="name" class="form-control create-form" id="name" placeholder="Name"
                        value="{{ old('name') }}">
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10 display-none createUser">
                <div class="form-group">
                    <input type="text" name="email" class="form-control create-form" id="email" placeholder="Email"
                        value="{{ old('email') }}">
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10 display-none createUser">
                <div class="form-group">
                    <input type="text" name="phone" class="form-control create-form" id="phone" placeholder="Phone"
                        value="{{ old('phone') }}">
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-select">
                    <select name="package_id" id="package_id" class="form-control create-form">
                        <option selected value="0">Select Package*</option>
                        @if (!empty($package))
                            @foreach ($package as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <span class="text-danger">{{ $errors->first('package_id') }}</span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-group">
                    <input type="text" name="amount" class="form-control create-form" id="amount"
                        placeholder="Amount (USD)*" value="{{ old('amount') }}">
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                </div>
            </div>

            <div class="offset-md-1 col-md-4 margin-top-10">
                <div class="form-group">
                    <label for="meta_description">Start Date*</label>
                    <input type="date" name="start_date" class="form-control create-form" id="start_date"
                        placeholder="Start Date" value="{{ old('start_date') }}">
                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 actions margin-top-20">
                <button class="submit margin-bottom-20">Save</button>
                <a href="/admin/offline-payment" class="cancel">Cancel</a>
            </div>
            <div class=" margin-top-40">
            </div>
        </div>
    </form>
    {{-- End::Content Body --}}



@stop
@push('custom-js')
    <script type="text/javascript">
        $(document).on("click", "#user_type", function(e) {
            e.preventDefault();
            // alert($(this).val());

            if (($(this).val()) == 'exists') {
                $('#selectUser').show();
                $('.createUser').hide();
            }
            if (($(this).val()) == 'new') {
                $('#selectUser').hide();
                $('.createUser').show();
            }
        });
    </script>
@endpush
