<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;

class AgreementNoImplementationExport implements FromCollection
{
    protected $registrations;

    public function __construct($registrations)
    {
        $this->registrations = $registrations;
    }

    public function collection()
    {
        return $this->registrations->map(function ($registration) {
            return [
                'सि.नं.' => $registration->id,
                'दर्ता मिति' => $registration->registration_date,
                'नाम (निवेदकको विवरण)' => $registration->applicants_names,
                'स्थानीय तह (निवेदकको विवरण)' => $registration->applicants_local_governments,
                'वडा नं. (निवेदकको विवरण)' => $registration->applicants_wadas,
                'सम्पर्क नं. (निवेदकको विवरण)' => $registration->applicants_contacts,
                'नाम (विपक्षी/साहुको विवरण)' => $registration->offenders_names,
                'स्थानीय तह (विपक्षी/साहुको विवरण)' => $registration->offenders_local_governments,
                'वडा नं. (विपक्षी/साहुको विवरण)' => $registration->offenders_wadas,
                'सम्पर्क नं. (विपक्षी/साहुको विवरण)' => $registration->offenders_contacts,
                'लेनदेन भएको मिति' => $registration->tansaction_date,
                'लेनदेनको प्रयोजन' => $registration->transaction_purposes,
                'कारोवारको प्रकृती' => $registration->transaction_natures,
                'कारोवारको प्रमाण' => $registration->transaction_proof,
                'सहमती/फर्छ्यौट मिति' => $registration->releases->release_agreement_date ?? '',
                'अदालतमा मुद्दा विचाराधिन' => $registration->releases->issue_in_court ?? '',
                'विपक्षी साहुबाट माग रकम' => $registration->offender_demand,
                'सहमती/फिर्ता विवरण' => '', // This column is not present in the table headers
                'नगद रु.' => $registration->applicant_receive_on_release_cash ?? '',
                'चेक द्वारा भूक्तानी रु.' => $registration->applicant_receive_on_release_cheque ?? '',
                'जग्गा छोडेको क्षेत्रफल (विघा-कठ्ठा-धुर)' => $registration->applicant_receive_on_release_land ?? '',
                'कित्ता' => $registration->applicant_receive_on_release_kitta,
                'अन्य तरिका' => $registration->applicant_receive_on_release_other_nature ?? '',
                'नगद रु.' => $registration->offender_refund_on_release_cash ?? '',
                'तमसुक रु.' => $registration->offender_refund_on_release_tamasuk ?? '',
                'चेक रु.' => $registration->offender_refund_on_release_cheque ?? '',
                'जग्गा छोडेको क्षेत्रफल (विघा-कठ्ठा-धुर)' => $registration->offender_refund_on_release_land ?? '',
                'कित्ता' => $registration->offender_refund_on_release_kitta,
                'सुन (ग्राममा)' => $registration->offender_refund_on_release_gold ?? '',
                'चाँदी (ग्राममा)' => $registration->offender_refund_on_release_silver ?? '',
                'सहमती कार्यान्वयन हदम्यादको अन्तिम मिति' => $registration->releases->applied_due_date ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'सि.नं.',
            'दर्ता मिति',
            'नाम (निवेदकको विवरण)',
            'स्थानीय तह (निवेदकको विवरण)',
            'वडा नं. (निवेदकको विवरण)',
            'सम्पर्क नं. (निवेदकको विवरण)',
            'नाम (विपक्षी/साहुको विवरण)',
            'स्थानीय तह (विपक्षी/साहुको विवरण)',
            'वडा नं. (विपक्षी/साहुको विवरण)',
            'सम्पर्क नं. (विपक्षी/साहुको विवरण)',
            'लेनदेन भएको मिति',
            'लेनदेनको प्रयोजन',
            'कारोवारको प्रकृती',
            'कारोवारको प्रमाण',
            'सहमती/फर्छ्यौट मिति',
            'अदालतमा मुद्दा विचाराधिन',
            'विपक्षी साहुबाट माग रकम',
            'सहमती/फिर्ता विवरण',
            'नगद रु.',
            'चेक द्वारा भूक्तानी रु.',
            'जग्गा छोडेको क्षेत्रफल (विघा-कठ्ठा-धुर)',
            'कित्ता',
            'अन्य तरिका',
            'नगद रु.',
            'तमसुक रु.',
            'चेक रु.',
            'जग्गा छोडेको क्षेत्रफल (विघा-कठ्ठा-धुर)',
            'कित्ता',
            'सुन (ग्राममा)',
            'चाँदी (ग्राममा)',
            'सहमती कार्यान्वयन हदम्यादको अन्तिम मिति',
        ];
    }
}
