<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportController extends Controller
{


 public function exportinchargesMembers() {
         $posting = DB::table('pmi_registration')

            // -------------------------------------------------
            // Designation
            // -------------------------------------------------
            ->leftJoin(
                'mst_designation',
                'mst_designation.id',
                '=',
                'pmi_registration.designation'
            )

            // -------------------------------------------------
            // Qualification
            // -------------------------------------------------
            ->leftJoin(
                'mst_qual',
                'mst_qual.qual_code',
                '=',
                'pmi_registration.qualification'
            )

            // -------------------------------------------------
            // Blood Group
            // -------------------------------------------------
            ->leftJoin(
                'mst_blood',
                'mst_blood.group_code',
                '=',
                'pmi_registration.blood_group'
            )

            // -------------------------------------------------
            // Constitution
            // -------------------------------------------------
            ->leftJoin(
                'mst_const',
                'mst_const.ac_no',
                '=',
                'pmi_registration.constitution'
            )

            // -------------------------------------------------
            // District
            // -------------------------------------------------
            ->leftJoin(
                'mst_district',
                'mst_district.district_code',
                '=',
                'pmi_registration.district'
            )

            // -------------------------------------------------
            // Taluk
            // -------------------------------------------------
            ->leftJoin(
                'mst_taluk',
                'mst_taluk.id',
                '=',
                'pmi_registration.taluk'
            )

            // -------------------------------------------------
            // Block
            // -------------------------------------------------
            ->leftJoin(
                'mst_block',
                'mst_block.id',
                '=',
                'pmi_registration.block'
            )

            // -------------------------------------------------
            // Region
            // -------------------------------------------------
            ->leftJoin(
                'mst_region',
                'mst_region.id',
                '=',
                'pmi_registration.region_id'
            )

              ->where(
                'pmi_registration.regi_flag',
                '1'
            )

              ->where(
                'pmi_registration.posting',
                '1'
            )


            // -------------------------------------------------
            // Sort By Name
            // -------------------------------------------------
            ->orderBy(
                'pmi_registration.name',
                'asc'
            )

            // -------------------------------------------------
            // Select Export Fields
            // -------------------------------------------------
            ->select(

                // Member
                'pmi_registration.memberid',

                // Personal Details
                'pmi_registration.name',
                'pmi_registration.father_name',
                'pmi_registration.dob',
                'pmi_registration.age',

                // Personal Information
                'pmi_registration.gender',
                'pmi_registration.martialstatus',

                // Blood Group Name
                'mst_blood.group_desc',

                'pmi_registration.mobile_number',
                'pmi_registration.email',

                // Master Values
                'mst_qual.qual_desc_eng',
                'pmi_registration.occupation',
                'pmi_registration.state',

                'mst_const.acname_eng',

                'mst_district.districtname_eng',

                'mst_taluk.taluk_name_eng',

                'mst_block.block_name_eng',

                // Address
                'pmi_registration.part',
                'pmi_registration.address',
                'pmi_registration.voter_id',

                // Dates
                'pmi_registration.created_at',
                'pmi_registration.updated_at',

                // Region Name
                'mst_region.region_name',

                // Designation Name
                'mst_designation.designation_name_en'
            )

            ->get();


        // =====================================================
        // EXCEL HEADINGS
        // =====================================================

        $headings = [



            'Member ID',

            'Name',

            'Father Name',

            'Date of Birth',

            'Age',

            'Gender',

            'Marital Status',

            'Blood Group',

            'Mobile Number',

            'Email',

            'Qualification',

            'Occupation',

            'State',

            'Constitution',

            'District',

            'Taluk',

            'Block',

            'Part',

            'Address',

            'Voter ID',

            'Created At',

            'Updated At',

            'Region',

            'Designation'
        ];


        // =====================================================
        // DOWNLOAD EXCEL
        // =====================================================

        return Excel::download(

            new class($posting, $headings)
            implements FromArray, WithHeadings {

                protected $posting;

                protected $headings;


                public function __construct(
                    $posting,
                    $headings
                ) {
                    $this->posting = $posting;

                    $this->headings = $headings;
                }


                // =================================================
                // EXCEL DATA
                // =================================================

                public function array(): array
                {
                    return $this->posting

                        ->map(function ($member) {

                            return [



                                // Member ID
                                $member->memberid,

                                // Personal Details
                                $member->name,

                                $member->father_name,

                                $member->dob,

                                $member->age,

                                // Personal Information
                                $member->gender,

                                $member->martialstatus,

                                // Blood Group
                                $member->group_desc,

                                $member->mobile_number,

                                $member->email,

                                // Qualification
                                $member->qual_desc_eng,

                                // Occupation
                                $member->occupation,

                                // State
                                $member->state,

                                // Constitution
                                $member->acname_eng,

                                // District
                                $member->districtname_eng,

                                // Taluk
                                $member->taluk_name_eng,

                                // Block
                                $member->block_name_eng,

                                // Part
                                $member->part,

                                // Address
                                $member->address,

                                // Voter ID
                                $member->voter_id,

                                // Created
                                $member->created_at,

                                // Updated
                                $member->updated_at,

                                // Region
                                $member->region_name,

                                // Designation
                                $member->designation_name_en
                            ];
                        })

                        ->toArray();
                }


                // =================================================
                // HEADINGS
                // =================================================

                public function headings(): array
                {
                    return $this->headings;
                }
            },

            // =====================================================
            // FILE NAME
            // =====================================================

            'PMI_Registered_Members_' .
                date('Y-m-d') .
                '.xlsx'
        );
    }


    public function total_register() {
         $posting = DB::table('pmi_registration')

            // -------------------------------------------------
            // Designation
            // -------------------------------------------------
            ->leftJoin(
                'mst_designation',
                'mst_designation.id',
                '=',
                'pmi_registration.designation'
            )

            // -------------------------------------------------
            // Qualification
            // -------------------------------------------------
            ->leftJoin(
                'mst_qual',
                'mst_qual.qual_code',
                '=',
                'pmi_registration.qualification'
            )

            // -------------------------------------------------
            // Blood Group
            // -------------------------------------------------
            ->leftJoin(
                'mst_blood',
                'mst_blood.group_code',
                '=',
                'pmi_registration.blood_group'
            )

            // -------------------------------------------------
            // Constitution
            // -------------------------------------------------
            ->leftJoin(
                'mst_const',
                'mst_const.ac_no',
                '=',
                'pmi_registration.constitution'
            )

            // -------------------------------------------------
            // District
            // -------------------------------------------------
            ->leftJoin(
                'mst_district',
                'mst_district.district_code',
                '=',
                'pmi_registration.district'
            )

            // -------------------------------------------------
            // Taluk
            // -------------------------------------------------
            ->leftJoin(
                'mst_taluk',
                'mst_taluk.id',
                '=',
                'pmi_registration.taluk'
            )

            // -------------------------------------------------
            // Block
            // -------------------------------------------------
            ->leftJoin(
                'mst_block',
                'mst_block.id',
                '=',
                'pmi_registration.block'
            )

            // -------------------------------------------------
            // Region
            // -------------------------------------------------
            ->leftJoin(
                'mst_region',
                'mst_region.id',
                '=',
                'pmi_registration.region_id'
            )


            // -------------------------------------------------
            // Sort By Name
            // -------------------------------------------------
            ->orderBy(
                'pmi_registration.name',
                'asc'
            )

            // -------------------------------------------------
            // Select Export Fields
            // -------------------------------------------------
            ->select(
                'pmi_registration.application_id',
                // Member
                'pmi_registration.memberid',

                // Personal Details
                'pmi_registration.name',
                'pmi_registration.father_name',
                'pmi_registration.dob',
                'pmi_registration.age',

                // Personal Information
                'pmi_registration.gender',
                'pmi_registration.martialstatus',

                // Blood Group Name
                'mst_blood.group_desc',

                'pmi_registration.mobile_number',
                'pmi_registration.email',

                // Master Values
                'mst_qual.qual_desc_eng',
                'pmi_registration.occupation',
                'pmi_registration.state',

                'mst_const.acname_eng',

                'mst_district.districtname_eng',

                'mst_taluk.taluk_name_eng',

                'mst_block.block_name_eng',

                // Address
                'pmi_registration.part',
                'pmi_registration.address',
                'pmi_registration.voter_id',

                // Dates
                'pmi_registration.created_at',
                'pmi_registration.updated_at',

                // Region Name
                'mst_region.region_name',

                // Designation Name
                'mst_designation.designation_name_en'
            )

            ->get();


        // =====================================================
        // EXCEL HEADINGS
        // =====================================================

        $headings = [

            'Application ID',

            'Member ID',

            'Name',

            'Father Name',

            'Date of Birth',

            'Age',

            'Gender',

            'Marital Status',

            'Blood Group',

            'Mobile Number',

            'Email',

            'Qualification',

            'Occupation',

            'State',

            'Constitution',

            'District',

            'Taluk',

            'Block',

            'Part',

            'Address',

            'Voter ID',

            'Created At',

            'Updated At',

            'Region',

            'Designation'
        ];


        // =====================================================
        // DOWNLOAD EXCEL
        // =====================================================

        return Excel::download(

            new class($posting, $headings)
            implements FromArray, WithHeadings {

                protected $posting;

                protected $headings;


                public function __construct(
                    $posting,
                    $headings
                ) {
                    $this->posting = $posting;

                    $this->headings = $headings;
                }


                // =================================================
                // EXCEL DATA
                // =================================================

                public function array(): array
                {
                    return $this->posting

                        ->map(function ($member) {

                            return [

                                $member->application_id,

                                // Member ID
                                $member->memberid,

                                // Personal Details
                                $member->name,

                                $member->father_name,

                                $member->dob,

                                $member->age,

                                // Personal Information
                                $member->gender,

                                $member->martialstatus,

                                // Blood Group
                                $member->group_desc,

                                $member->mobile_number,

                                $member->email,

                                // Qualification
                                $member->qual_desc_eng,

                                // Occupation
                                $member->occupation,

                                // State
                                $member->state,

                                // Constitution
                                $member->acname_eng,

                                // District
                                $member->districtname_eng,

                                // Taluk
                                $member->taluk_name_eng,

                                // Block
                                $member->block_name_eng,

                                // Part
                                $member->part,

                                // Address
                                $member->address,

                                // Voter ID
                                $member->voter_id,

                                // Created
                                $member->created_at,

                                // Updated
                                $member->updated_at,

                                // Region
                                $member->region_name,

                                // Designation
                                $member->designation_name_en
                            ];
                        })

                        ->toArray();
                }


                // =================================================
                // HEADINGS
                // =================================================

                public function headings(): array
                {
                    return $this->headings;
                }
            },

            // =====================================================
            // FILE NAME
            // =====================================================

            'PMI_Registered_Members_' .
                date('Y-m-d') .
                '.xlsx'
        );
    }



    public function exportPostingMembers()
    {
        $posting = DB::table('pmi_registration')

            // -------------------------------------------------
            // Designation
            // -------------------------------------------------
            ->leftJoin(
                'mst_designation',
                'mst_designation.id',
                '=',
                'pmi_registration.designation'
            )

            // -------------------------------------------------
            // Qualification
            // -------------------------------------------------
            ->leftJoin(
                'mst_qual',
                'mst_qual.qual_code',
                '=',
                'pmi_registration.qualification'
            )

            // -------------------------------------------------
            // Blood Group
            // -------------------------------------------------
            ->leftJoin(
                'mst_blood',
                'mst_blood.group_code',
                '=',
                'pmi_registration.blood_group'
            )

            // -------------------------------------------------
            // Constitution
            // -------------------------------------------------
            ->leftJoin(
                'mst_const',
                'mst_const.ac_no',
                '=',
                'pmi_registration.constitution'
            )

            // -------------------------------------------------
            // District
            // -------------------------------------------------
            ->leftJoin(
                'mst_district',
                'mst_district.district_code',
                '=',
                'pmi_registration.district'
            )

            // -------------------------------------------------
            // Taluk
            // -------------------------------------------------
            ->leftJoin(
                'mst_taluk',
                'mst_taluk.id',
                '=',
                'pmi_registration.taluk'
            )

            // -------------------------------------------------
            // Block
            // -------------------------------------------------
            ->leftJoin(
                'mst_block',
                'mst_block.id',
                '=',
                'pmi_registration.block'
            )

            // -------------------------------------------------
            // Region
            // -------------------------------------------------
            ->leftJoin(
                'mst_region',
                'mst_region.id',
                '=',
                'pmi_registration.region_id'
            )

            // -------------------------------------------------
            // Only Posting Members
            // -------------------------------------------------
            ->where(
                'pmi_registration.regi_flag',
                '1'
            )

            // -------------------------------------------------
            // Sort By Name
            // -------------------------------------------------
            ->orderBy(
                'pmi_registration.name',
                'asc'
            )

            // -------------------------------------------------
            // Select Export Fields
            // -------------------------------------------------
            ->select(

                // Member
                'pmi_registration.memberid',

                // Personal Details
                'pmi_registration.name',
                'pmi_registration.father_name',
                'pmi_registration.dob',
                'pmi_registration.age',

                // Personal Information
                'pmi_registration.gender',
                'pmi_registration.martialstatus',

                // Blood Group Name
                'mst_blood.group_desc',

                'pmi_registration.mobile_number',
                'pmi_registration.email',

                // Master Values
                'mst_qual.qual_desc_eng',
                'pmi_registration.occupation',
                'pmi_registration.state',

                'mst_const.acname_eng',

                'mst_district.districtname_eng',

                'mst_taluk.taluk_name_eng',

                'mst_block.block_name_eng',

                // Address
                'pmi_registration.part',
                'pmi_registration.address',
                'pmi_registration.voter_id',

                // Dates
                'pmi_registration.created_at',
                'pmi_registration.updated_at',

                // Region Name
                'mst_region.region_name',

                // Designation Name
                'mst_designation.designation_name_en'
            )

            ->get();


        // =====================================================
        // EXCEL HEADINGS
        // =====================================================

        $headings = [

            'Member ID',

            'Name',

            'Father Name',

            'Date of Birth',

            'Age',

            'Gender',

            'Marital Status',

            'Blood Group',

            'Mobile Number',

            'Email',

            'Qualification',

            'Occupation',

            'State',

            'Constitution',

            'District',

            'Taluk',

            'Block',

            'Part',

            'Address',

            'Voter ID',

            'Created At',

            'Updated At',

            'Region',

            'Designation'
        ];


        // =====================================================
        // DOWNLOAD EXCEL
        // =====================================================

        return Excel::download(

            new class($posting, $headings)
            implements FromArray, WithHeadings {

                protected $posting;

                protected $headings;


                public function __construct(
                    $posting,
                    $headings
                ) {
                    $this->posting = $posting;

                    $this->headings = $headings;
                }


                // =================================================
                // EXCEL DATA
                // =================================================

                public function array(): array
                {
                    return $this->posting

                        ->map(function ($member) {

                            return [

                                // Member ID
                                $member->memberid,

                                // Personal Details
                                $member->name,

                                $member->father_name,

                                $member->dob,

                                $member->age,

                                // Personal Information
                                $member->gender,

                                $member->martialstatus,

                                // Blood Group
                                $member->group_desc,

                                $member->mobile_number,

                                $member->email,

                                // Qualification
                                $member->qual_desc_eng,

                                // Occupation
                                $member->occupation,

                                // State
                                $member->state,

                                // Constitution
                                $member->acname_eng,

                                // District
                                $member->districtname_eng,

                                // Taluk
                                $member->taluk_name_eng,

                                // Block
                                $member->block_name_eng,

                                // Part
                                $member->part,

                                // Address
                                $member->address,

                                // Voter ID
                                $member->voter_id,

                                // Created
                                $member->created_at,

                                // Updated
                                $member->updated_at,

                                // Region
                                $member->region_name,

                                // Designation
                                $member->designation_name_en
                            ];
                        })

                        ->toArray();
                }


                // =================================================
                // HEADINGS
                // =================================================

                public function headings(): array
                {
                    return $this->headings;
                }
            },

            // =====================================================
            // FILE NAME
            // =====================================================

            'PMI_Approved_Members_' .
                date('Y-m-d') .
                '.xlsx'
        );
    }
}
