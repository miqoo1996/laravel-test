@extends('layouts.app')

@section('content')
    <div class="card-box table-responsive">
        <div class="header">
            <h3>Policies</h3>
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Policy</th>
                <th>Plan Reference</th>
                <th>Member Name</th>
                <th>Investment House</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user->policies as $policy)
            <tr data-href="{{ route('staff.single-policy', $policy->id) }}">
                <td>{{$policy->id}}</td>
                <td>{{$policy->code}}</td>
                <td>{{$policy->plan_reference}}</td>
                <td>{{$policy->first_name}}, {{ $policy->last_name }}</td>
                <td>{{$policy->investment_house}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
