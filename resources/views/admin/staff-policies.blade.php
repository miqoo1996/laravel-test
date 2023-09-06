@extends('layouts.app')

@section('content')
    <div class="card-box table-responsive">
        <div class="header">
            <h3>Add Policies</h3>
        </div>
        <form class="col-12 padded padded-bottom padded-la">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <label>Name</label>
                    <input type="text" class="form-control" value="{{$user->name}}" disabled/>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <label>Email</label>
                    <input type="email" class="form-control" value="{{$user->email}}" disabled/>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <label>Status</label><br/>
                    <span @class(['label', $user->email_verified_at ? 'label-success': 'label-info'])>
                            {{ $user->email_verified_at ? 'Active' : 'Invitation Sent' }}
                        </span>
                </div>
            </div>
        </form>

        <div class="col-12 header">
            <h3>Policies
                <button class="btn btn-primary waves-effect waves-light pull-right" data-toggle="modal"
                        data-target="#addProducts"><i class="fa fa-plus"></i> Add Policy
                </button>
            </h3>
        </div>

        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Policy</th>
                        <th>Plan Reference</th>
                        <th>Member Name</th>
                        <th>Investment House</th>
                        <th>Last Operation</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->policies as $policy)
                        <tr>
                            <td>{{$policy->id}}</td>
                            <td>{{$policy->code}}</td>
                            <td>T{{$policy->plan_reference}}</td>
                            <td>{{$policy->first_name, $policy->last_name}}</td>
                            <td>{{$policy->investment_house}}</td>
                            <td>{{$policy->last_operation}}</td>
                            <td>
                                <form action="{{route('admin.removePolicy')}}" method="post">
                                    @method('DELETE')
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <input type="hidden" name="policy_id" value="{{$policy->id}}">
                                    @csrf
                                    <button type="submit" href="#" title="Remove" class="text-danger remove-btt">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row padded">
                <div class="col-6">
                    <button type="submit" hidden name="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i>Save</button>
                </div>
                <div class="col-6 text-right padded padded-top">
                    <form action="{{route('admin.removeStaff')}}" method="post">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <button type="submit" title="Remove User" class="text-danger remove-btt"><i class="fa fa-trash"></i> Remove
                            Staff
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('modals')
    <!-- Modal -->
    <div class="modal fade" id="addProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Available Policies</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-lg-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Policy</th>
                                    <th>Plan Reference</th>
                                    <th>Member Name</th>
                                    <th>Investment House</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($policies as $policy)
                                    <tr>
                                        <td>{{$policy->id}}</td>
                                        <td>{{$policy->code}}</td>
                                        <td>{{$policy->plan_reference}}</td>
                                        <td>{{$policy->first_name, $policy->last_name}}</td>
                                        <td>{{$policy->investment_house}}</td>
                                        <td>
                                            <form action="{{route('admin.addPolicies')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                                <input type="hidden" name="policy_id" value="{{$policy->id}}">
                                                <button type="submit" title="Add Client" class="text-site1 remove-btt"><i
                                                        class="fa fa-plus"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 padded padded-top">
                            <button type="submit" name="submit" class="btn btn-primary pull-right"><i
                                    class="fa fa-check"></i> Done
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
