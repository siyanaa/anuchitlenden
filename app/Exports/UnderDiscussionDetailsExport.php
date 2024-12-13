<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;

class UnderDiscussionDetailsExport implements FromCollection
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
                'लेनदेन भएको मिति' => \Carbon\Carbon::parse($registration->tansaction_date)->format('Y-m-d'),
                'लेनदेनको प्रयोजन' => $registration->transaction_purposes,
                'कारोवारको प्रकृती' => $registration->transaction_natures,
                'कारोवारको प्रमाण' => $registration->transaction_proof,
                'कारोवारको रु.' => $registration->transaction_proof_amount,
                'कुल छलफल' => count($registration->discussions),
                'छलफल मिति' => $registration->last_discussed_date,
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
            'कारोवारको रु.',
            'कुल छलफल',
            'छलफल मिति',
        ];
    }   

}