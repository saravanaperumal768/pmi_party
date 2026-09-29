<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;

class MembercardController extends Controller
{
    public function generatePDF($memberid)
    {
        // -------------------------------------------------
        // 1. Get member details
        // -------------------------------------------------

        $member = DB::table('pmi_registration')
            ->leftJoin(
                'mst_designation',
                'pmi_registration.posting',
                '=',
                'mst_designation.id'
            )
            ->where('pmi_registration.memberid', $memberid)
            ->select(
                'pmi_registration.memberid',
                'pmi_registration.name',
                'pmi_registration.mobile_number',
                'pmi_registration.age',
                'pmi_registration.dob',
                'pmi_registration.posting',
                'pmi_registration.photo',
                'mst_designation.designation_name_en'
            )
            ->first();

        if (!$member) {
            abort(404, 'Member not found.');
        }



        $dob = '-';

        if (!empty($member->dob)) {
            $dob = date('d-m-Y', strtotime($member->dob));
        }


        // -------------------------------------------------
        // 3. Convert photo to Base64
        // -------------------------------------------------

        $photo = '';

        if (!empty($member->photo)) {

            $photoPath = public_path(
                $member->photo
            );

            if (file_exists($photoPath)) {

                $imageData = file_get_contents($photoPath);

                $imageType = strtolower(
                    pathinfo($photoPath, PATHINFO_EXTENSION)
                );

                // Convert jpg/jpeg correctly
                if ($imageType === 'jpg') {
                    $imageType = 'jpeg';
                }

                $photo = 'data:image/' .
                    $imageType .
                    ';base64,' .
                    base64_encode($imageData);
            }
        }


        // -------------------------------------------------
        // 4. Escape values
        // -------------------------------------------------

        $name = htmlspecialchars(
            $member->name ?? '-',
            ENT_QUOTES,
            'UTF-8'
        );

        $mobile = htmlspecialchars(
            $member->mobile_number ?? '-',
            ENT_QUOTES,
            'UTF-8'
        );

        $age = htmlspecialchars(
            $member->age ?? '-',
            ENT_QUOTES,
            'UTF-8'
        );

        $posting = htmlspecialchars(
            $member->designation_name_en ?? '-',
            ENT_QUOTES,
            'UTF-8'
        );

        $memberId = htmlspecialchars(
            $member->memberid ?? '-',
            ENT_QUOTES,
            'UTF-8'
        );


        // -------------------------------------------------
        // 5. Photo HTML
        // -------------------------------------------------

        if (!empty($photo)) {

            $photoHtml = '
        <img
            src="' . $photo . '"
            style="
                width:15mm;
                height:15mm;
                border-radius:50%;
                border:0.3mm solid #cccccc;
                object-fit:cover;
            "
        >
    ';
        } else {

            $photoHtml = '
        <div
            style="
                width:15mm;
                height:15mm;
                border-radius:50%;
                border:0.3mm solid #cccccc;
                text-align:center;
                line-height:15mm;
                font-size:7px;
                color:#777777;
            "
        >
            PHOTO
        </div>
    ';
        }


        // -------------------------------------------------
        // 6. HTML
        // -------------------------------------------------

        $html = '

    <html>

    <head>

        <meta charset="UTF-8">

        <style>

            @page {
                margin: 0;
            }

            body {
                margin: 0;
                padding: 0;
                font-family: dejavusans;
                text-align: center;
            }

            .card {
                width: 85.6mm;
                height: 54mm;

                border: 0.4mm solid #1d4ed8;

                text-align: center;

                overflow: hidden;
            }

        .header {
    width: 100%;
    height: 9mm;
    background-color: #1d4ed8;
    color: white;
    text-align: center;
    padding-top: 1.5mm;
    box-sizing: border-box;
}

            .title {
                font-size: 13px;
                font-weight: bold;
            }

            .subtitle {
                font-size: 6px;
                margin-top: 0.8mm;
            }

      .photo-section {
    text-align: center;
    padding-top: 1.5mm;
}

           .details {
                width: 100%;
                margin-top: 1mm;
                text-align: center;
            }

            .details-table {
                width: 100%;
                margin: 0 auto;
                border-collapse: collapse;
            }

            .details-table td {
                font-size: 6.5px;
                line-height: 1.1;
                padding: 0.6mm 0;
                vertical-align: middle;
            }

            .details-table .label {
                width: 25mm;
                font-weight: bold;
                color: #555555;
                text-align: right;
                padding-right: 1.5mm;
            }

            .details-table .value {
                font-weight: bold;
                color: #111111;
                text-align: left;
            }

            .member-id {
                margin-top: 1mm;
                font-size: 7px;
                font-weight: bold;
                color: #1d4ed8;
                text-align: center;
            }

            .row {
                margin-bottom: 1mm;

                font-size: 7.5px;

                line-height: 1.2;
            }

            .label {
                font-weight: bold;
                color: #555555;
            }

            .value {
                font-weight: bold;
                color: #111111;
            }

            .member-id {
                margin-top: 1mm;

                font-size: 7px;

                font-weight: bold;

                color: #1d4ed8;
            }

    .footer {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 3.5mm;
    background-color: #f1f5f9;
    text-align: center;
    padding-top: 0.8mm;
    font-size: 5px;
    color: #555555;
    box-sizing: border-box;
}
      .top-image {
    width: 100%;
    height: 2mm;
    text-align: center;
    overflow: hidden;
    margin: 0;
    padding: 0;
}

.top-image img {
    width: 100%;
    height: 15mm;

    display: block;
}

        </style>

    </head>


   <body>

    <div class="card">

        <!-- TOP ELECTION IMAGE -->

        <div class="top-image">

            <img src="assets/images/election-bg.png">

        </div>


        <!-- HEADER -->

        <div class="header">

            <div class="title">
                MEMBER CARD
            </div>

            <div class="subtitle">
                MEMBERSHIP IDENTIFICATION CARD
            </div>

        </div>


            <!-- CENTER PHOTO -->

            <div class="photo-section">

                ' . $photoHtml . '

            </div>


            <!-- CENTER DETAILS -->

            <div class="details">

    <table class="details-table">

        <tr>
            <td class="label">
                Name :
            </td>
            <td class="value">
                ' . $name . '
            </td>
        </tr>

        <tr>
            <td class="label">
                Mobile :
            </td>
            <td class="value">
                ' . $mobile . '
            </td>
        </tr>

        <tr>
            <td class="label">
                Age :
            </td>
            <td class="value">
                ' . $age . '
            </td>
        </tr>

        <tr>
            <td class="label">
                DOB :
            </td>
            <td class="value">
                ' . $dob . '
            </td>
        </tr>

        <tr>
            <td class="label">
                Posting :
            </td>
            <td class="value">
                ' . $posting . '
            </td>
        </tr>

    </table>

    <div class="member-id">
        Member ID : ' . $memberId . '
    </div>

</div>


            <!-- FOOTER -->

            <div class="footer">

                This card is issued to the registered member.

            </div>

        </div>

    </body>

    </html>

    ';


        // -------------------------------------------------
        // 7. Create mPDF
        // -------------------------------------------------

        $mpdf = new \Mpdf\Mpdf([

            'mode' => 'utf-8',

            'format' => [85.6, 54],

            'orientation' => 'L',

            'margin_left' => 0,

            'margin_right' => 0,

            'margin_top' => 0,

            'margin_bottom' => 0,

            'margin_header' => 0,

            'margin_footer' => 0,

        ]);


        // -------------------------------------------------
        // 8. PDF metadata
        // -------------------------------------------------

        $mpdf->SetTitle(
            'Member Card - ' . $member->memberid
        );

        $mpdf->SetAuthor('PMI');

        $mpdf->SetCreator('Laravel mPDF');


        // -------------------------------------------------
        // 9. Generate PDF
        // -------------------------------------------------

        $mpdf->WriteHTML($html);


        // -------------------------------------------------
        // 10. Display PDF in browser
        // -------------------------------------------------

        return response(
            $mpdf->Output(
                'member-card-' . $member->memberid . '.pdf',
                'S'
            )
        )
            ->header(
                'Content-Type',
                'application/pdf'
            )
            ->header(
                'Content-Disposition',
                'inline; filename="member-card-' .
                    $member->memberid .
                    '.pdf"'
            );
    }
}
