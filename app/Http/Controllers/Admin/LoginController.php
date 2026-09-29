<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        $captcha = strtoupper(Str::random(6));

        session([
            'admin_login_captcha' => $captcha
        ]);

        return view('admin.index');
    }


    public function member_login()
    {
        $captcha = strtoupper(Str::random(6));

        session([
            'member_login_captcha' => $captcha
        ]);

        return view('admin.member_login');
    }



    public function login(Request $request)
    {
        // dd('111'); exit;
        $request->validate([
            'memberid' => 'required',
            'loginPassword' => 'required',
            'captcha' => 'required',
        ]);
        $enteredCaptcha = strtoupper(trim($request->captcha));

        $sessionCaptcha = strtoupper(
            session('admin_login_captcha')
        );

        if (
            !$sessionCaptcha ||
            $enteredCaptcha !== $sessionCaptcha
        ) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid CAPTCHA. Please try again.'
            ], 422);
        }

        session()->forget('admin_login_captcha');
        $member = Member::where('memberid', $request->memberid)
            ->where('password', $request->loginPassword)
            ->first();

        // dd($member); exit;


        if (!$member) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Member ID or Password.'
            ], 401);
        }

        if ((int) $member->flag !== 1) {
            return response()->json([
                'status' => false,
                'message' => 'Your account is inactive.'
            ], 403);
        }



        // dd('111');
        // exit;

        Auth::login($member);

        $request->session()->regenerate();

        // dd([
        //     'authenticated' => Auth::check(),
        //     'user' => Auth::user(),
        //     'memberid' => Auth::user()?->memberid,
        // ]);

        $request->session()->regenerate();

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

        // if (strtolower(trim($member->posting)) !== 'president') {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'You are not authorized to access the President dashboard.'
        //     ], 403);
        // }

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

        // dd($member->posting); exit;

        return response()->json([
            'status' => true,
            'message' => 'Login successful.',
            'redirect' => route('admin.dashboard')
        ]);
    }


    public function login_member(Request $request)
    {
        // dd('111'); exit;
        $request->validate([
            'memberid' => 'required',
            'loginPassword' => 'required',
            'captcha' => 'required',
        ]);
        $enteredCaptcha = strtoupper(trim($request->captcha));

        $sessionCaptcha = strtoupper(
            session('member_login_captcha')
        );

        if (
            !$sessionCaptcha ||
            $enteredCaptcha !== $sessionCaptcha
        ) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid CAPTCHA. Please try again.'
            ], 422);
        }

        session()->forget('member_login_captcha');
        $member = Member::where('memberid', $request->memberid)
            ->where('password', $request->loginPassword)
            ->first();

        // dd($member); exit;


        if (!$member) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Member ID or Password.'
            ], 401);
        }

        if ((int) $member->flag !== 1) {
            return response()->json([
                'status' => false,
                'message' => 'Your account is inactive.'
            ], 403);
        }



        // dd('111');
        // exit;

        Auth::login($member);

        $request->session()->regenerate();

        // dd([
        //     'authenticated' => Auth::check(),
        //     'user' => Auth::user(),
        //     'memberid' => Auth::user()?->memberid,
        // ]);

        $request->session()->regenerate();

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

        // if (strtolower(trim($member->posting)) !== 'president') {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'You are not authorized to access the President dashboard.'
        //     ], 403);
        // }

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
        // dd('111'); exit;

        $member_details = DB::table('pmi_registration')
            ->where('memberid', $member->memberid)->where('regi_flag', '1')->first();


        return response()->json([
            'status' => true,
            'message' => 'Login successful.',
            'redirect' => route('admin.dashboard_member', compact('member_details'))
        ]);
    }

    public function dashboard(Request $request)
    {

        // dd(auth()->user());
        // exit;
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        $registration = DB::table('pmi_registration')
            ->leftJoin(
                'mst_district',
                'mst_district.district_code',
                '=',
                'pmi_registration.district'
            )
            ->leftJoin(
                'mst_taluk',
                'mst_taluk.id',
                '=',
                'pmi_registration.taluk'
            )
            ->select(
                'pmi_registration.*',
                'mst_district.districtname_eng',
                'mst_taluk.taluk_name_eng'
            )
            ->where('pmi_registration.memberid', '0')
            ->orderBy('mst_district.districtname_eng', 'asc')
            ->orderBy('mst_taluk.taluk_name_eng', 'asc')
            ->get();

        $registrationCount = DB::table('pmi_registration')->count();

        $approvalCount = DB::table('pmi_registration')
            ->where('memberid', '!=', '0')
            ->count();

        $pendingCount = DB::table('pmi_registration')
            ->where('memberid',  '0')
            ->count();

        // dd($pendingCount); exit;

        // $district = DB::table('mst_district')
        //     ->where('district_code', $registration->district)
        //     ->value('districtname_eng');

        // $taluk = DB::table('mst_taluk')
        //     ->where('id', $registration->taluk)
        //     ->value('taluk_name_eng');

        // dd($taluk); exit;

        $profile = DB::table('pmi_registration')
            ->leftJoin(
                'mst_designation',
                'mst_designation.id',
                '=',
                'pmi_registration.designation'
            )
            ->where('pmi_registration.memberid', auth()->user()->memberid)
            ->select(
                'pmi_registration.name',
                'pmi_registration.photo',
                'pmi_registration.designation',
                'mst_designation.designation_name_en'
            )
            ->first();

        return view('admin.dashboard', compact('registration', 'registrationCount', 'approvalCount', 'pendingCount', 'profile'));
    }


    public function dashboard_member(Request $request)
    {
        // dd(auth()->user()->memberid);
        //         exit;

        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $memberid = session('admin_member_id');

        // Find logged-in member's registration
        $member_details = DB::table('pmi_registration')
            ->where('memberid', $memberid)
            ->where('regi_flag', '1')
            ->first();

        if (!$member_details) {
            return redirect()
                ->route('admin.index')
                ->with('a', 'Member registration details not found.');
        }
        $registration = DB::table('pmi_registration')
            ->leftJoin(
                'mst_district',
                'mst_district.district_code',
                '=',
                'pmi_registration.district'
            )
            ->leftJoin(
                'mst_taluk',
                'mst_taluk.id',
                '=',
                'pmi_registration.taluk'
            )
            ->select(
                'pmi_registration.*',
                'mst_district.districtname_eng',
                'mst_taluk.taluk_name_eng'
            )
            ->where('pmi_registration.memberid', '0')
            ->orderBy('mst_district.districtname_eng', 'asc')
            ->orderBy('mst_taluk.taluk_name_eng', 'asc')
            ->first();

            // dd($registration); exit;

        //   $community = DB::table('tbl_community')
        //     ->where('comm_code', $registration->community)
        //     ->value('comm_desc');

        //     dd($community); exit;

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


        $profile = DB::table('pmi_registration')
            ->leftJoin(
                'mst_designation',
                'mst_designation.id',
                '=',
                'pmi_registration.designation'
            )
            ->where('pmi_registration.memberid', auth()->user()->memberid)
            ->select(
                'pmi_registration.name',
                'pmi_registration.photo',
                'pmi_registration.designation',
                'mst_designation.designation_name_en'
            )
            ->first();

        $registrationCount = DB::table('pmi_registration')->count();

        $approvalCount = DB::table('pmi_registration')
            ->where('memberid', '!=', '0')
            ->count();

        $pendingCount = DB::table('pmi_registration')
            ->where('memberid',  '0')
            ->count();

        // dd($pendingCount); exit;

        // $district = DB::table('mst_district')
        //     ->where('district_code', $registration->district)
        //     ->value('districtname_eng');

        // $taluk = DB::table('mst_taluk')
        //     ->where('id', $registration->taluk)
        //     ->value('taluk_name_eng');

        // dd($taluk); exit;

        // dd($member_details); exit;

        return view('admin.dashboard_member', compact('registration', 'registrationCount', 'approvalCount', 'pendingCount', 'profile', 'member_details', 'qual', 'constitution', 'district', 'taluk', 'block'));
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
            'district',
            'taluk',
            'block'
        ));
    }

    public function logout()
    {
        $user = Auth::user();

        if ($user && $user->posting == 'president') {
            Auth::logout();

            return redirect()
                ->route('admin.index')
                ->with('a', 'Logged out successfully');
        }

        Auth::logout();

        return redirect()
            ->route('admin.member_login')
            ->with('a', 'Logged out successfully');
    }


    public function reports(){
        return view('admin.reports');
    }
}
