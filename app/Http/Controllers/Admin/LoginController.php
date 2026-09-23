<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function login(Request $request)
    {
        // dd('111'); exit;
        $request->validate([
            'memberid' => 'required',
            'loginPassword' => 'required',
        ]);


        $member = DB::table('members_tbl')
            ->where('memberid', $request->memberid)
            ->where('password', $request->loginPassword)
            ->first();

        // dd($member); exit;


        if (!$member) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Member ID or Password.'
            ], 401);
        }

        /*
        |--------------------------------------------------------------------------
        | Check password
        |--------------------------------------------------------------------------
        */

        // if (!Hash::check($request->loginPassword, $member->password)) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Invalid Member ID or Password.'
        //     ], 401);
        // }

        /*
        |--------------------------------------------------------------------------
        | Check flag
        |--------------------------------------------------------------------------
        */

        if ((int) $member->flag !== 1) {
            return response()->json([
                'status' => false,
                'message' => 'Your account is inactive.'
            ], 403);
        }

        /*
        |--------------------------------------------------------------------------
        | Check posting
        |--------------------------------------------------------------------------
        */

        if (strtolower(trim($member->posting)) !== 'president') {
            return response()->json([
                'status' => false,
                'message' => 'You are not authorized to access the President dashboard.'
            ], 403);
        }

        /*
        |--------------------------------------------------------------------------
        | Store login session
        |--------------------------------------------------------------------------
        */

        session([
            'admin_logged_in' => true,
            'admin_member_id' => $member->memberid,
            'admin_member' => $member,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Login successful.',
            'redirect' => route('admin.dashboard')
        ]);
    }

    public function dashboard(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        $registration = DB::table('pmi_registration')
            ->orderBy('id', 'desc')
            ->get();


        $registrationCount = DB::table('pmi_registration')->count();

        return view('admin.dashboard', compact('registration','registrationCount'));
    }

    public function registrationdetails($memberid)
    {
        $registration = DB::table('pmi_registration')
            ->where('application_id', $memberid)
            ->first();

        if (!$registration) {
            abort(404, 'Registration not found');
        }
        $community = DB::table('tbl_community')
            ->where('comm_code', $registration->community)
            ->value('comm_desc');

        $qual = DB::table('mst_qual')
            ->where('qual_code', $registration->qualification)
            ->value('qual_desc_eng');

        $constitution = DB::table('mst_const')
            ->where('ac_no', $registration->constitution)
            ->value('acname_eng');

        $district = DB::table('mst_district')
            ->where('district_code', $registration->district)
            ->value('districtname_eng');

        $taluk = DB::table('mst_taluk')
            ->where('id', $registration->taluk)
            ->value('taluk_name_eng');

            $block = DB::table('mst_block')
            ->where('id', $registration->block)
            ->value('block_name_eng');

            // dd($block); exit;



        return view('admin.registration_details', compact(
            'registration',
            'community',
            'qual',
            'constitution',
            'district', 'taluk', 'block'
        ));
    }

      public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.index')->with('a', 'Logged out successfully');
    }
}
