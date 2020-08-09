<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Invitation;
use Illuminate\Http\Request;

class InvitationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index() {
        $invitations = Invitation::where('registered_at', null)->orderBy('created_at', 'desc')->get();
        return view('invitations', ['invitations' => $invitations]);
    }

    public function store(InvitationRequest $request) {

        $invitation = new Invitation($request->all());
        $invitation->generateToken();
        $invitation->save();

        return redirect()->route('invitations');
    }
}
