@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Employee') }}</div>

                    <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Middle Name</th>
                            <th scope="col">Work hours</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->first_name}}</td>
                                <td>{{$item->last_name}}</td>
                                <td>{{$item->middle_name}}</td>
                                <td>{{$item->work_hours}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$data->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
