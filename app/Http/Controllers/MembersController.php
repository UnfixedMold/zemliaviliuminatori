<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index() {

        $members = User::all();

        return view('members', ['members' => $members]);
    }

    public function edit(User $member) {

        return view('member', [
            'id' => $member->id,
            'name' => $member->name,
            'email' => $member->email,
            'isAdmin' => $member->is_admin
        ]);
    }

    public function update(User $member) {

        $member->is_admin = (bool) request('is_admin_check', false);
        $member->save();

        return redirect()->route(Auth::user()->is_admin ? 'members' : 'profile');
    }
}
