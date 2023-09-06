<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateStaffRequest;
use App\Http\Requests\Admin\DeleteStaffAccountRequest;
use App\Http\Requests\Admin\RemovePolicyRequest;
use App\Http\Requests\Admin\SyncPoliciesRequest;
use App\Models\Role;
use App\Services\User\UserPolicyService;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct(protected UserService $userService, protected UserPolicyService $policyService)
    {
    }

    public function listStaff(): View
    {
        return view('admin.staff', ['staffUsers' => $this->userService->staffUsers()]);
    }

    public function staffPolicies(Request $request, $id): View
    {
        abort_if(!$user = $this->policyService->userWithPolicies($id), 404);

        return view('admin.staff-policies', [
            'user' => $user,
            'policies' => $this->policyService->policiesWithoutUsers()
        ]);
    }

    public function addPolicies(SyncPoliciesRequest $request) : RedirectResponse
    {
        $this->policyService->syncPolicies($request->user_id, $request->policy_id);
        return redirect()->back();
    }

    public function removePolicy(RemovePolicyRequest $request) : RedirectResponse
    {
        $this->policyService->removePolicy($request->user_id, $request->policy_id);
        return redirect()->back();
    }

    public function removeStaff(DeleteStaffAccountRequest $request) : RedirectResponse
    {
        $this->userService->destroy(id: $request->user_id, unlinkingRelations: ['policies']);

        return redirect()->route('admin.listStaff');
    }

    public function createAccount(CreateStaffRequest $request) : array
    {
        $this->userService->createUser(role: Role::STAFF, attributes: $request->validated(), sendInvitation: true);

        return ['success' => true];
    }
}
