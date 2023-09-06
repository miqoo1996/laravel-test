<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Services\User\UserPolicyService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StaffController extends Controller
{
    public function __construct(protected UserPolicyService $policyService)
    {
    }

    public function polices() : View
    {
        return view('staff.polices',['user'=>$this->policyService->userWithPolicies(Auth::id())]);
    }

    public function singlePolicy($id) : View
    {
        abort_if(!$policy = $this->policyService->userPolicy(Auth::id(), $id), 404);

        return view('staff.single-policy',['policy'=> $policy]);
    }
}
