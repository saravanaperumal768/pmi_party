<?php

namespace App\Http\Controllers;

use App\Models\pmi_registration;
use App\Models\PmiRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PmiRegistrationController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $validated = $request->validate([
                'name' => 'required|string|max:150',
                'father_name' => 'required|string|max:200',
                'dob' => 'required|date|before:today',
                'community'     => 'required|integer|exists:tbl_community,comm_code',
                'gender' => 'required|in:Male,Female,Transgender',
                'martialstatus' => 'required|in:Un-Married,Married,others',
                'blood_group'   => 'required|integer|exists:mst_blood,group_code',
                'mobile_number' => 'required|regex:/^[6-9][0-9]{9}$/',
                'email' => 'required|email|max:100',
                'qualification' => 'required|integer|exists:mst_qual,qual_code',
                'occupation' => 'required|string|max:25',

                'state' => 'required|string|max:20',
                'constitution' => 'required|string|max:50',
                'district' => 'required|string|max:50',
                'taluk' => 'required|string|max:50',
                'block' => 'required|string|max:50',
                'part' => 'required|string|max:50',
                'other_details' => 'nullable|string|max:255',
                'address' => 'required|string',
                'photo' => 'required|file|mimes:jpg,jpeg,png|max:1024',
                'voter_id' => 'required|string|max:20',
                'id_proof' => 'required|file|mimes:pdf,jpg,jpeg,png|max:1024',

                'referral' => 'nullable|string|max:100',
            ]);

            // Calculate age
            $dob = Carbon::parse($request->dob);
            $age = $dob->age;

            // Check minimum age
            if ($age < 18) {
                return response()->json([
                    'status' => false,
                    'message' => 'You must be 18 years or older to apply.',
                    'errors' => [
                        'dob' => [
                            'You must be 18 years or older to apply.'
                        ]
                    ]
                ], 422);
            }

            // Generate Application ID
            do {

// dd($request->referral);
                $applicationId =
                    'PMI_' . $request->district . $request->constitution .
                    Carbon::now()->format('Y') .
                    random_int(100, 999);

                    // dd($applicationId); exit;
            } while (
                pmi_registration::where(
                    'application_id',
                    $applicationId
                )->exists()
            );

            // Upload Photo
            $photoPath = null;

            if ($request->hasFile('photo')) {

                $photoDirectory = public_path(
                    'uploads/pmi_registration/photo'
                );

                if (!file_exists($photoDirectory)) {
                    mkdir($photoDirectory, 0755, true);
                }

                $photo = $request->file('photo');

                $photoName =
                    time() . '_' .
                    uniqid() . '.' .
                    $photo->getClientOriginalExtension();

                $photo->move(
                    $photoDirectory,
                    $photoName
                );

                $photoPath =
                    'uploads/pmi_registration/photo/' .
                    $photoName;
            }

            // Upload ID Proof
            $idProofPath = null;

            if ($request->hasFile('id_proof')) {

                $idDirectory = public_path(
                    'uploads/pmi_registration/id_proof'
                );

                if (!file_exists($idDirectory)) {
                    mkdir($idDirectory, 0755, true);
                }

                $idProof = $request->file('id_proof');

                $idProofName =
                    time() . '_' .
                    uniqid() . '.' .
                    $idProof->getClientOriginalExtension();

                $idProof->move(
                    $idDirectory,
                    $idProofName
                );

                $idProofPath =
                    'uploads/pmi_registration/id_proof/' .
                    $idProofName;
            }

            // Save Registration
            $registration = pmi_registration::create([

                'application_id' => $applicationId,

                'name' => $request->name,
                'father_name' => $request->father_name,
                'dob' => $request->dob,
                'age' => $age,
                'community' => $request->community,
                'gender' => $request->gender,
                'martialstatus' => $request->martialstatus,
                'blood_group' => $request->blood_group,
                'mobile_number' => $request->mobile_number,
                'email' => $request->email,
                'qualification' => $request->qualification,
                'occupation' => $request->occupation,


                'state' => $request->state,
                'constitution' => $request->constitution,
                'district' => $request->district,
                'taluk' => $request->taluk,
                'block' => $request->block,
                'part' => $request->part,
                'other_details' => $request->other_details,
                'address' => $request->address,

                'photo' => $photoPath,
                'voter_id' => $request->voter_id,
                'id_proof' => $idProofPath,
                'referral' => $request->referral,

                'regi_flag' => '1',
                'member_registration' => 'PMI',
                'regi_status' => 'Active',
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Your Registration completed - We Will Reach You Soon.',
                'application_id' => $registration->application_id,
                'registration_id' => $registration->id,
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Please correct the validation errors.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Registration failed. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
