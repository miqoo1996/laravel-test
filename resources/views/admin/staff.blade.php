@extends('layouts.app')

@section('content')
    <div class="card-box table-responsive">
        <div class="header">
            <h3>Staff <button class="btn btn-primary waves-effect waves-light pull-right" data-toggle="modal" data-target="#sendInvitation"><i class="fa fa-plus"></i> Create Account</button></h3>
        </div>

        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Updated at</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($staffUsers as $user)
                <tr style="cursor: pointer;" data-href="{{ route('admin.staffPolicies', $user->id) }}">
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{{$user->updated_at}}}</td>
                    <td>
                        <span @class(['label', $user->email_verified_at ? 'label-success': 'label-info'])>
                            {{ $user->email_verified_at ? 'Active' : 'Invitation Sent' }}
                        </span>
                    </td>
                    <td class="btn-actions">
                        <form method="post" action="{{ route('admin.removeStaff') }}">
                            @csrf
                            @method('delete')

                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <button type="submit" href="#" title="Remove" class="text-danger remove-btt">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection


@section('modals')
    <!-- Modal -->
    <div class="modal fade" id="sendInvitation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send Invitation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-ajax-validated" method="post" action="{{route('admin.createAccount')}}">
                        @csrf

                        <fieldset class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control"/>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Email</label>
                            <input type="email"  name="email" class="form-control"/>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control"/>
                        </fieldset>

                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-paper-plane-o"></i> Create and Send Invitation</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
