<?php

namespace App\Http\Middleware;

use App\Models\AclRule;
use App\Models\Roles_and_Permissions\Roles;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RequestFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if user is unauthenticated redirecting him to login page
        if (!$request->user()) {
            return redirect()->route('login');
        }

        $requested_url = $request->path();
        // dd($requested_url);

        // fetching the role of the user
        $role = AclRule::where('user_id',$request->user()->id)->first()->role;
        // dd($role);

        if($role == 'officer') {
            return $next($request);
            // return back();
        }
        else{
            return back();
        }


        /*
        $user = $request->user(); //checking if user is authenticated

        $roles_and_permissions = $user->roles_and_permissions; //extracting user_roles_and_permissions table data

        foreach ($roles_and_permissions as $role_id) {
            $id = $role_id->role_id; //extracting role_id from that table
        }

        $role = Roles::find($id);
        $role = $role->code; //storing code

        // dd($role_id);
        if (($request->user()) && ($role == 'sadmin' || $role == 'admin')) {
            return $next($request);
        } else if (($request->user()) && ($role == 'manager')) {
            return redirect()->route('login');
        } else {
            return redirect()->route('register');
        }
        */
    }
}
