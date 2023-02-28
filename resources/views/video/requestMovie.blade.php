@extends('layouts.default.master')
@section('data_count')
    {{-- Start:: content heading --}}
    <div class="content-heading">
        <div class="row">
            {{-- title --}}
            <div class="col-md-8 content-title">
                <span class="title">Manage Movie Request</span>
                <div class="title-line"></div>
            </div>
            {{-- title --}}

        </div>
    </div>
    {{-- End:: content heading --}}

    {{-- Start::Content Body --}}
    <div class="row margin-top-40 content-details">
        <div style="overflow-x:auto;">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="text-center">SERIAL</th>
                        <th scope="col" class="text-center">NAME</th>
                        <th scope="col" class="text-center">EMAIL</th>
                        <th scope="col" class="text-center">REQUEST MOVIE</th>
                        <th scope="col" class="text-center">REQUEST DATE</th>
                        <th scope="col" class="text-center">MESSAGE</th>
                        <th scope="col" class="text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl = 1; ?>
                    @if (!$target->isEmpty())
                        @foreach ($target as $data)
                            <tr>
                                <th class="text-center" scope="row">{{ $sl++ }}</th>
                                <td class="text-center">{{ $data->name }}</td>
                                <td class="text-center">{{ $data->email }}</td>
                                <td class="text-center">{{ $data->movie_name }}</td>
                                <td class="text-center">{{ $data->added_on }}</td>
                                <td class="text-center">{{ $data->message }}</td>
                                <td class="table-actions text-center">

                                    <a href="{{ URL::to('admin/video/create') }}">ADD MOVIE</a>

                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

        </div>
    </div>
    {{-- End::Content Body --}}


@stop
@push('custom-js')
    <script type="text/javascript"></script>
@endpush
