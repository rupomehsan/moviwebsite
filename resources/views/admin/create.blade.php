@extends('layouts.default.master')
@section('data_count')
    {{-- Start:: content heading --}}
    <div class="content-heading">
        <div class="row">
            {{-- title --}}
            <div class="col-md-8 content-title">
                <span class="title">Add Admin</span>
                <div class="title-line"></div>

                <!-- Button trigger modal -->
            </div>
            {{-- title --}}
        </div>
    </div>
    {{-- End:: content heading --}}

    {{-- Start::Content Body --}}
    <form id="adminCreateForm" method="POST" enctype="multipart/form-data" action="/admin/admin/store">
        @csrf
        <div class="row create-body margin-top-20">

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-group">
                    <select name="user_role_id" id="userRole" class="form-control create-form"">
                                <option value=" 0">Select Role</option>
                        @foreach ($userRole as $id => $name)
                            <option value="{{ $id }}" <?php if (old('user_role_id') == $id) {
    echo 'selected';
} ?>>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('user_role_id') }}</span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-group">
                    <input type="text" name="name" class="form-control create-form" id="name" placeholder="Name"
                        value="{{ old('name') }}">
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-group">
                    <input type="text" name="email" class="form-control create-form" id="email" placeholder="Email"
                        value="{{ old('email') }}">
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-group">
                    <input type="text" name="phone" class="form-control create-form" id="phone" placeholder="Phone"
                        value="{{ old('phone') }}">
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-group">
                    <input type="password" name="password" class="form-control create-form" id="password"
                        placeholder="Password" value="{{ old('password') }}">
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10" id="accessControl">
                <h4>Access Control</h4>
                <div class="row margin-top-20">

                    <div class="form-check user-check col-md-2">
                        <input class="form-check-input" type="checkbox" name="access[]" value="manage" id="manage" checked>
                        <label class="form-check-label" for="manage">
                            Manage
                        </label>
                    </div>
                    <div class="form-check user-check col-md-2">
                        <input class="form-check-input" type="checkbox" name="access[]" value="video" id="video" checked>
                        <label class="form-check-label" for="video">
                            Video
                        </label>
                    </div>
                    <div class="form-check user-check col-md-2">
                        <input class="form-check-input" type="checkbox" name="access[]" value="administration"
                            id="administration" checked>
                        <label class="form-check-label" for="administration">
                            Administration
                        </label>
                    </div>
                    <div class="form-check user-check col-md-2">
                        <input class="form-check-input" type="checkbox" name="access[]" value="user" id="user" checked>
                        <label class="form-check-label" for="user">
                            User
                        </label>
                    </div>
                    <div class="form-check user-check col-md-2">
                        <input class="form-check-input" type="checkbox" name="access[]" value="settings" id="settings"
                            checked>
                        <label class="form-check-label" for="settings">
                            Settings
                        </label>
                    </div>
                    <div class="form-check user-check col-md-2">
                        <input class="form-check-input" type="checkbox" name="access[]" value="subscription" id="subscription"
                            checked>
                        <label class="form-check-label" for="subscription">
                            Subscription
                        </label>
                    </div>

                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-20">
                <div class="col-md-6">
                    <div class="file-upload">
                        <div class="image-upload-wrap">
                            <input name="image" id="image" class="file-upload-input" type='file' onchange="readURL(this);"
                                accept="image/*" />
                            <div class="drag-text text-center">
                                <span class="iconify" data-icon="teenyicons:user-square-outline"></span>
                                <span>Upload Image Or Drag Here</span>
                            </div>
                        </div>
                        <div class="file-upload-content">
                            <div class="image-title-wrap">
                                <img class="file-upload-image" src="#" alt="your image" />
                                <button type="button" onclick="removeUpload()" class="remove-image">
                                    <span class="iconify" data-icon="akar-icons:cross"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 actions margin-top-20">
                <button class="submit margin-bottom-20">Save</button>
                <a href="/admin/admin" class="cancel">Cancel</a>
            </div>
            <div class=" margin-top-40">
            </div>
        </div>
    </form>
    {{-- End::Content Body --}}



@stop
@push('custom-js')
    <script type="text/javascript">
        // access control
        $(document).on("change", "#userRole", function(e) {
            e.preventDefault();
            var value = $(this).val();
                $("#accessControl").html('');
            if(value === '1'){
            // alert('asd');
                $("#accessControl").html('');
            }else{
                $("#accessControl").html(`
                    <h4>Access Control</h4>
                    <div class="row margin-top-20">

                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="manage" id="manage" checked>
                            <label class="form-check-label" for="manage">
                                Manage
                            </label>
                        </div>
                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="video" id="video" checked>
                            <label class="form-check-label" for="video">
                                Video
                            </label>
                        </div>
                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="administration"
                                id="administration" checked>
                            <label class="form-check-label" for="administration">
                                Administration
                            </label>
                        </div>
                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="user" id="user" checked>
                            <label class="form-check-label" for="user">
                                User
                            </label>
                        </div>
                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="settings" id="settings"
                                checked>
                            <label class="form-check-label" for="settings">
                                Settings
                            </label>
                        </div>
                        <div class="form-check user-check col-md-2">
                            <input class="form-check-input" type="checkbox" name="access[]" value="subscription" id="subscription"
                                checked>
                            <label class="form-check-label" for="subscription">
                                Subscription
                            </label>
                        </div>

                    </div>
                `);
            }
        });
    </script>
@endpush
