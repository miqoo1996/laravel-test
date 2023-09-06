@extends('layouts.app')

@section('content')
    <div class="card-box table-responsive">
        <div class="header">
            <h3>Policy #{{ $policy->id }}</h3>
        </div>

        <div>
            <p>ID: {{$policy->id}}</p>
            <p>Code: {{$policy->code}}</p>
            <p>Plan Reference: {{$policy->plan_reference}}</p>
            <p>Name: {{$policy->first_name}}, {{ $policy->last_name }}</p>
            <p>Investment House: {{$policy->investment_house}}</p>
        </div>
    </div>
@endsection
