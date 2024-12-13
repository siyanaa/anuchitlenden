<?php

namespace App\Exports;

use App\Models\Registration;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class RegistrationExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($registration) {
            return [
                'सि.नं.' => $registration->id,
                'दर्ता नं.' => $registration->registration_id,
                'दर्ता मिति' => $registration->created_at->format('Y-m-d'),
                'नाम (निवेदक)' => $registration->applicants_names,
                'स्थानीय तह (निवेदक)' => $registration->applicants_local_governments,
                'वडा नं. (निवेदक)' => $registration->applicants_wadas,
                'सम्पर्क नं. (निवेदक)' => $registration->applicants_contacts,
                'नाम (विपक्षी/साहु)' => $registration->offenders_names,
                'स्थानीय तह (विपक्षी/साहु)' => $registration->offenders_local_governments,
                'वडा नं. (विपक्षी/साहु)' => $registration->offenders_wadas,
                'सम्पर्क नं. (विपक्षी/साहु)' => $registration->offenders_contacts,
                'लेनदेन भएको मिति' => $registration->tansaction_date,
                'लेनदेनको प्रयोजन' => $registration->transaction_purposes,
                'कारोवारको प्रकृती' => $registration->transaction_natures,
                'कारोवारको प्रमाण' => $registration->transaction_proof,
                'कारोवारको रु.' => $registration->transaction_proof_amount,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'सि.नं.',
            'दर्ता नं.',
            'दर्ता मिति',
            'नाम (निवेदक)',
            'स्थानीय तह (निवेदक)',
            'वडा नं. (निवेदक)',
            'सम्पर्क नं. (निवेदक)',
            'नाम (विपक्षी/साहु)',
            'स्थानीय तह (विपक्षी/साहु)',
            'वडा नं. (विपक्षी/साहु)',
            'सम्पर्क नं. (विपक्षी/साहु)',
            'लेनदेन भएको मिति',
            'लेनदेनको प्रयोजन',
            'कारोवारको प्रकृती',
            'कारोवारको प्रमाण',
            'कारोवारको रु.',
        ];
    }
}


