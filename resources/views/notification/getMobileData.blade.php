
            {{-- <form method="POST" enctype="multipart/form-data"
            action="{{ URL::to('admin/notification/manage-notification-update') }}">
            @csrf
            <input name="notification_type" type="hidden" value="mobile"> --}}

            <div class="content-title">
                <h4 class="bold">For Mobile</h4>
                <div class="title-line"></div>
            </div>
            <div class="row notification-manage-content-mobile">
                <div class="col-md-10">
                    <div class="form-group margin-top-10">
                        <label for="mobileApiKey">Onesignal Api Key</label>
                        <input name="mobile_api_key" type="text" class="form-control create-form" id="mobileApiKey"
                            placeholder="Api key" value="{!! $target->api_key ?? ''!!}">
                        <span class="text-danger">{{ $errors->first('mobile_api_key') }}</span>
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="form-group margin-top-10">
                        <label for="mobileApiId">Onesignal Api ID</label>
                        <input name="mobile_api_id" type="text" class="form-control create-form" id="mobileApiId"
                            placeholder="Api ID" value="{!! $target->api_id ?? ''!!}">
                        <span class="text-danger">{{ $errors->first('mobile_api_id') }}</span>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-12 actions margin-top-10">
                <button type="submit" class="submit">Save</button>
            </div>
        </form> --}}