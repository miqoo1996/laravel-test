<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function index() : View|RedirectResponse
    {
        if ($this->userService->hasRole(auth()->id(), Role::ADMIN)) {
            return redirect()->route('admin.listStaff');
        }

        if ($this->userService->hasRole(auth()->id(), Role::STAFF)) {
            return redirect()->route('staff.polices');
        }

        return view('welcome');
    }
}
