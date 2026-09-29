<?php

namespace App\Exports;

use App\Models\PmiRegistration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\WithHeadings;

class MembersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function collection()
    {
        return DB::table('pmi_registration')
            ->where('regi_flag', '1')
            ->orderBy('id', 'asc')
            ->get([
                'id',
                'application_id',
                'name',
                'father_name',
                'dob',
                'age',
                'community',
                'gender',
                'martialstatus',
                'blood_group',
                'mobile_number',
                'email',
                'qualification',
                'occupation',
                'state',
                'constitution',
                'district',
                'taluk',
                'block',
                'part',
                'address',
                'voter_id',
                'memberid',
                'regi_flag',
                'regi_status',
                'created_at',
                'updated_at'
            ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Application ID',
            'Name',
            'Father Name',
            'Date of Birth',
            'Age',
            'Community',
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
            'Member ID',
            'Registration Flag',
            'Registration Status',
            'Created At',
            'Updated At'
        ];
    }
}
