<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


use App\Exports\MembersExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{

    public function refreshCaptcha($type)
    {
        $captcha = strtoupper(Str::random(6));



        if ($type === 'admin') {

            session([
                'admin_login_captcha' => $captcha
            ]);
        } elseif ($type === 'member') {

            session([
                'member_login_captcha' => $captcha
            ]);
        } else {

            return response()->json([
                'status' => false,
                'message' => 'Invalid CAPTCHA type.'
            ], 400);
        }

        return response()->json([
            'status' => true,
            'captcha' => $captcha
        ]);
    }

    public function approveMember(Request $request)
    {
        $request->validate([
            'application_id' => 'required'
        ]);

        $applicationId = $request->application_id;

        DB::beginTransaction();

        try {

            // Check whether this application is already approved
            $existingMember = DB::table('members_tbl')
                ->where('application_id', $applicationId)
                ->first();

            if ($existingMember) {
                return response()->json([
                    'status' => false,
                    'message' => 'This application is already approved.',
                    'memberid' => $existingMember->memberid
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | Generate Member ID
        | Example: PMI_2026_001
        |--------------------------------------------------------------------------
        */

            $year = date('Y');
            $prefix = 'PMI' . $year;

            $lastMember = DB::table('members_tbl')
                ->where('memberid', 'LIKE', $prefix . '%')
                ->orderBy('memberid', 'desc')
                ->lockForUpdate()
                ->first();

            if ($lastMember) {

                $lastNumber = (int) substr(
                    $lastMember->memberid,
                    strlen($prefix)
                );

                $nextNumber = $lastNumber + 1;
            } else {

                $nextNumber = 1;
            }

            $memberid = $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            /*
        |--------------------------------------------------------------------------
        | Generate password
        |--------------------------------------------------------------------------
        */

            $password = 'pmimember@111';

            /*
        |--------------------------------------------------------------------------
        | Generate referral code
        |--------------------------------------------------------------------------
        */

            $referralCode = 'REF' . strtoupper(Str::random(6));

            /*
        |--------------------------------------------------------------------------
        | Insert Member
        |--------------------------------------------------------------------------
        */

            DB::table('members_tbl')->insert([
                'memberid'      => $memberid,
                'password'      => $password,
                'referral_code' => $referralCode,
                'posting'       => null,
                'flag'          => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
                'application_id' => $applicationId,
                'roles'         => '0',
            ]);


            DB::table('pmi_registration')
                ->where('application_id', $applicationId)
                ->update([
                    'memberid'    => $memberid,
                    'regi_status' => 'Active',
                    'regi_flag'   => '1',
                    'updated_at'  => now(),
                ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Member approved successfully.',
                'memberid' => $memberid
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function assign_role()
    {
        $members = DB::table('pmi_registration')
            ->select(
                'application_id',
                'name',
                'memberid',
                'photo',
                'posting'
            )
            ->where('regi_flag', '1')

            ->orderBy('name', 'asc')
            ->get();

        $state = DB::table('mst_state')->get();
        $region = DB::table('mst_region')->get();
        $taluk = DB::table('mst_taluk')->get();
        $block = DB::table('mst_block')->get();
        $designation = DB::table('mst_designation')->get();

        return view('admin.assign_role', compact(
            'members',
            'region',
            'state',
            'taluk',
            'block',
            'designation'
        ));
    }

    public function getDistrictsByRegion($region_id)
    {

        // dd($region_id);exit;
        $districts = DB::table('mst_district')
            ->where('region_code', $region_id)
            ->orderBy('districtname_eng')
            ->get([
                'district_code',
                'districtname_eng'
            ]);


        return response()->json($districts);
    }

    public function getTaluksByDistrict($district_code)
    {
        $taluks = DB::table('mst_taluk')
            ->where('district_code', $district_code)
            ->orderBy('taluk_name_eng', 'asc')
            ->select(
                'taluk_code',
                'taluk_name_eng'
            )
            ->get();

        return response()->json($taluks);
    }


    public function getBlocksByDistrict($district_code)
    {
        $blocks = DB::table('mst_block')
            ->where('district_code', $district_code)
            ->orderBy('block_name_eng', 'asc')
            ->select(
                'block_code',
                'block_name_eng'
            )
            ->get();

        return response()->json($blocks);
    }

    public function getDesignationsByLevel($level)
    {
        $designations = DB::table('mst_designation')
            ->where('hierarchy_level', $level)
            ->orderBy('designation_name_en', 'asc')
            ->select(
                'id',
                'designation_name_en',
                'designation_name_ta'
            )
            ->get();

        return response()->json($designations);
    }


    public function updateAssignRole(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'member_id' => [
                'required',
                'exists:pmi_registration,memberid'
            ],

            'designation_level' => [
                'required',
                'in:STATE,REGION,DISTRICT,TALUK,BLOCK,WARD,BOOTH'
            ],

            'state_id' => [
                'nullable',
                'integer',
                'exists:mst_state,id'
            ],

            'region_id' => [
                'nullable',
                'integer',
                'exists:mst_region,id'
            ],

            'district_id' => [
                'nullable'
            ],

            'taluk_id' => [
                'nullable'
            ],

            'block_id' => [
                'nullable'
            ],

            'designation_id' => [
                'required',
                'integer',
                'exists:mst_designation,id'
            ],

        ], [

            'member_id.required' =>
            'Please select a member.',

            'member_id.exists' =>
            'Selected member does not exist.',

            'designation_level.required' =>
            'Please select designation level.',

            'designation_level.in' =>
            'Invalid designation level.',

            'state_id.exists' =>
            'Selected state does not exist.',

            'region_id.exists' =>
            'Selected region does not exist.',

            'designation_id.required' =>
            'Please select designation.',

            'designation_id.exists' =>
            'Selected designation does not exist.',

        ]);


        /*
    |--------------------------------------------------------------------------
    | VALIDATE LOCATION ACCORDING TO DESIGNATION LEVEL
    |--------------------------------------------------------------------------
    */

        $validator->after(function ($validator) use ($request) {

            $level = $request->designation_level;


            // STATE
            if ($level === 'STATE') {

                if (!$request->state_id) {

                    $validator->errors()->add(
                        'state_id',
                        'Please select a state.'
                    );
                }
            }


            // REGION
            if ($level === 'REGION') {

                if (!$request->state_id) {

                    $validator->errors()->add(
                        'state_id',
                        'Please select a state.'
                    );
                }

                if (!$request->region_id) {

                    $validator->errors()->add(
                        'region_id',
                        'Please select a region.'
                    );
                }
            }


            // DISTRICT
            if ($level === 'DISTRICT') {

                if (!$request->state_id) {

                    $validator->errors()->add(
                        'state_id',
                        'Please select a state.'
                    );
                }

                if (!$request->region_id) {

                    $validator->errors()->add(
                        'region_id',
                        'Please select a region.'
                    );
                }

                if (!$request->district_id) {

                    $validator->errors()->add(
                        'district_id',
                        'Please select a district.'
                    );
                }
            }


            // TALUK
            if ($level === 'TALUK') {

                if (!$request->state_id) {

                    $validator->errors()->add(
                        'state_id',
                        'Please select a state.'
                    );
                }

                if (!$request->region_id) {

                    $validator->errors()->add(
                        'region_id',
                        'Please select a region.'
                    );
                }

                if (!$request->district_id) {

                    $validator->errors()->add(
                        'district_id',
                        'Please select a district.'
                    );
                }

                if (!$request->taluk_id) {

                    $validator->errors()->add(
                        'taluk_id',
                        'Please select a taluk.'
                    );
                }
            }


            // BLOCK / WARD / BOOTH
            if (in_array($level, [
                'BLOCK',
                'WARD',
                'BOOTH'
            ])) {

                if (!$request->state_id) {

                    $validator->errors()->add(
                        'state_id',
                        'Please select a state.'
                    );
                }

                if (!$request->region_id) {

                    $validator->errors()->add(
                        'region_id',
                        'Please select a region.'
                    );
                }

                if (!$request->district_id) {

                    $validator->errors()->add(
                        'district_id',
                        'Please select a district.'
                    );
                }

                if (!$request->taluk_id) {

                    $validator->errors()->add(
                        'taluk_id',
                        'Please select a taluk.'
                    );
                }

                if (!$request->block_id) {

                    $validator->errors()->add(
                        'block_id',
                        'Please select a block.'
                    );
                }
            }
        });


        /*
    |--------------------------------------------------------------------------
    | RETURN VALIDATION ERRORS
    |--------------------------------------------------------------------------
    */

        if ($validator->fails()) {

            return response()->json([

                'status' => false,

                'message' =>
                'Please correct the validation errors.',

                'errors' =>
                $validator->errors()

            ], 422);
        }


        /*
    |--------------------------------------------------------------------------
    | DESIGNATION LEVEL
    |--------------------------------------------------------------------------
    */

        $level = $request->designation_level;


        /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    */

        $data = [

            'designation_level' => $level,

            'state_id' => $request->state_id,

            'region_id' => $request->region_id,

            'district_id' => $request->district_id,

            'taluk_id' => $request->taluk_id,

            'block_id' => $request->block_id,

            'designation' => $request->designation_id,

            'posting' => '1',

        ];


        /*
    |--------------------------------------------------------------------------
    | CLEAR LOCATION VALUES WHICH ARE NOT USED
    |--------------------------------------------------------------------------
    */

        if ($level === 'STATE') {

            $data['region_id'] = null;
            $data['district_id'] = null;
            $data['taluk_id'] = null;
            $data['block_id'] = null;
        } elseif ($level === 'REGION') {

            $data['district_id'] = null;
            $data['taluk_id'] = null;
            $data['block_id'] = null;
        } elseif ($level === 'DISTRICT') {

            $data['taluk_id'] = null;
            $data['block_id'] = null;
        } elseif ($level === 'TALUK') {

            $data['block_id'] = null;
        }


        /*
    |--------------------------------------------------------------------------
    | UPDATE MEMBER
    |--------------------------------------------------------------------------
    */

        DB::table('pmi_registration')
            ->where('memberid', $request->member_id)
            ->update($data);


        /*
    |--------------------------------------------------------------------------
    | GET POSTING NAMES
    |--------------------------------------------------------------------------
    */

        $stateName = null;
        $regionName = null;
        $districtName = null;
        $talukName = null;
        $blockName = null;
        $designationName = null;


        /*
    |--------------------------------------------------------------------------
    | STATE
    |--------------------------------------------------------------------------
    */

        if ($request->state_id) {

            $stateName = DB::table('mst_state')
                ->where('id', $request->state_id)
                ->value('state_name');
        }


        /*
    |--------------------------------------------------------------------------
    | REGION
    |--------------------------------------------------------------------------
    */

        if ($request->region_id) {

            $regionName = DB::table('mst_region')
                ->where('id', $request->region_id)
                ->value('region_name');
        }


        /*
    |--------------------------------------------------------------------------
    | DISTRICT
    |--------------------------------------------------------------------------
    */

        if ($request->district_id) {

            $districtName = DB::table('mst_district')
                ->where('id', $request->district_id)
                ->value('districtname_eng');
        }


        /*
    |--------------------------------------------------------------------------
    | TALUK
    |--------------------------------------------------------------------------
    */

        if ($request->taluk_id) {

            $talukName = DB::table('mst_taluk')
                ->where('id', $request->taluk_id)
                ->value('taluk_name_eng');
        }


        /*
    |--------------------------------------------------------------------------
    | BLOCK
    |--------------------------------------------------------------------------
    */

        if ($request->block_id) {

            $blockName = DB::table('mst_block')
                ->where('id', $request->block_id)
                ->value('block_name_eng');
        }


        /*
    |--------------------------------------------------------------------------
    | DESIGNATION
    |--------------------------------------------------------------------------
    */

        if ($request->designation_id) {

            $designationName = DB::table('mst_designation')
                ->where('id', $request->designation_id)
                ->value('designation_name_en');
        }


        /*
    |--------------------------------------------------------------------------
    | SUCCESS RESPONSE
    |--------------------------------------------------------------------------
    */

        return response()->json([

            'status' => true,

            'message' =>
            'Member role assigned successfully.',

            'posting' => [

                'level' =>
                $level,

                'state' =>
                $stateName,

                'region' =>
                $regionName,

                'district' =>
                $districtName,

                'taluk' =>
                $talukName,

                'block' =>
                $blockName,

                'designation' =>
                $designationName,
            ]

        ]);
    }

    public function party_incharge()
    {

        $posting = DB::table('pmi_registration')
            ->leftJoin(
                'mst_designation',
                'mst_designation.id',
                '=',
                'pmi_registration.designation'
            )
            ->where('pmi_registration.posting', '1')
            ->orderBy('pmi_registration.name', 'asc')
            ->select(
                'pmi_registration.*',
                'mst_designation.designation_name_en'
            )
            ->get();

        return view('admin.party_members', compact('posting'));
    }

    public function approvedmembers()
    {




        $approvedmembers = DB::table('pmi_registration')
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
            ->where('regi_flag', '1')
            ->orderBy('mst_district.districtname_eng', 'asc')
            ->orderBy('mst_taluk.taluk_name_eng', 'asc')
            ->get();


        return view('admin.approvedmembers', compact('approvedmembers'));
    }


    // exports-----------

    public function exportMembers()
    {
        return Excel::download(
            new MembersExport,
            'PMI_Members_' . date('Y-m-d') . '.xlsx'
        );
    }
}
