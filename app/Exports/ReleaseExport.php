<?php

namespace App\Exports;
use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReleaseExport implements FromCollection, WithHeadings
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
                'दर्ता नं.' => $registration->registration_number,
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
                'लिन दिन नपर्ने गरी फर्छ्यौट' => $registration->no_transaction_purpose,
                'लिनदिन पर्ने गरी फर्छ्यौट' => $registration->releases->issue_on_agreement_date ?? '',
                'निवेदनकले भूक्तानी गरेको/गर्ने जम्मा रकम रु' => $registration->releases->applicant_payment_amount ?? '',
                'साहुद्वारा फिर्ता भएको विवरण' => $registration->releases->refund_details ?? '',
                'सहमती कार्यान्वयनको अवस्था' => ($registration->releases && isset($registration->releases->agreement_applied_status)) ? (($registration->releases->agreement_applied_status == 1) ? 'भएको' : 'नभएको') : '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'सि.नं.',
            'दर्ता नं.',
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
            'लिन दिन नपर्ने गरी फर्छ्यौट',
            'लिनदिन पर्ने गरी फर्छ्यौट',
            'निवेदनकले भूक्तानी गरेको/गर्ने जम्मा रकम रु',
            'साहुद्वारा फिर्ता भएको विवरण',
            'सहमती कार्यान्वयनको अवस्था',
        ];
    }
}
