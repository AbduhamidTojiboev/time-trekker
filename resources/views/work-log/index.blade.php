@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Work-log') }}</div>
                    <div class="card-body">

                        <form method="GET" action="{{ route('workLog.index') }}">
                            <div class="row mb-3">
                                <label for="file"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Date from') }}</label>

                                <div class="col-md-6">
                                    <input id="date_from" type="date"
                                           class="form-control @error('date_from') is-invalid @enderror"
                                           name="date_from" value="{{ old('date_from') ?? $dateFrom}}" required
                                           autocomplete="date" autofocus>

                                    @error('date_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="file"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Date to') }}</label>

                                <div class="col-md-6">
                                    <input id="date_to" type="date"
                                           class="form-control @error('date_to') is-invalid @enderror" name="date_to"
                                           value="{{ old('date_to')  ?? $dateTo}}" required autocomplete="date"
                                           autofocus>

                                    @error('date_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Work hours</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <th scope="row">{{$item->id}}</th>
                                    <td>{{sprintf('%s %s %0s', $item->last_name, $item->first_name, $item->middle_name) }}</td>
                                    <td>{{$item->work_hours ?? 0}}</td>
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
