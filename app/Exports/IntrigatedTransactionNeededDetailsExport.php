<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IntrigatedTransactionNeededDetailsExport implements FromCollection, WithHeadings
{
    protected $registrationReports;

    public function __construct($registrationReports)
    {
        $this->registrationReports = $registrationReports;
    }

    public function collection()
    {
        $data = [];

        foreach ($this->registrationReports as $registration) {
            foreach ($registration->districts as $district) {
                $data[] = [
                    'क्र.सं.' => '', // Fill this with appropriate data
                    'जिल्ला' => $district->name,
                    'लिनदिन पर्ने गरी फर्छ्यौट भएको उजुरी संख्या' => $district->with_transaction_release_count,
                    'कारोवार रकम रु.' => $district->sum_of_with_transaction_release_count,
                    'अदालतमा मुद्दा विचाराधिन अवस्था (भएको)' => '', // Fill this with appropriate data
                    'अदालतमा मुद्दा विचाराधिन अवस्था (नभएको)' => '', // Fill this with appropriate data
                    'नखुलेको उजुरी संख्या' => $district->getTotalNoOfOffenderDemandNotReveal(),
                    'खुलेको रकम रु.' => $district->getTotalSumOfOffenderDemand(),
                    'नगद रु.' => $district->getSumOfApplicantReceivedByNature(1, 1),
                    'चेक रु.' => $district->getSumOfApplicantReceivedByNature(1, 2),
                    'अन्य रु.' => $district->getSumOfApplicantReceivedByNature(1, 8),
                    'जम्मा रकम रु.' => $district->getTotalSumOfApplicantReceived(1),
                    'जग्गा क्षेत्रफल (विघा-कठ्ठा-धुर)' => $district->getTotalSumOfApplicantLand(1),
                    'कित्ता' => $district->getTotalSumOfApplicantLandKitta(1),
                    'नगद रु.' => $district->getSumOfOffenderReturnByNature(1, 1),
                    'तमसुक रु.' => $district->getSumOfOffenderReturnByNature(1, 5),
                    'चेक रु.' => $district->getSumOfOffenderReturnByNature(1, 2),
                    'जग्गा (क्षेत्रफल विघा-कठ्ठा-धुर)' => $district->getTotalSumOfOffenderLand(1),
                    'कित्ता' => $district->getTotalSumOfOffenderLandKitta(1),
                    'सुन (ग्राममा)' => $district->getSumOfOffenderReturnByNature(1, 6),
                    'चाँदी (ग्राममा)' => $district->getSumOfOffenderReturnByNature(1, 7),
                ];
            }
        }

        return new Collection($data);
    }

    public function headings(): array
    {
        return [
            'क्र.सं.',
            'जिल्ला',
            'लिनदिन पर्ने गरी फर्छ्यौट भएको उजुरी संख्या',
            'कारोवार रकम रु.',
            'अदालतमा मुद्दा विचाराधिन अवस्था (भएको)',
            'अदालतमा मुद्दा विचाराधिन अवस्था (नभएको)',
            'नखुलेको उजुरी संख्या',
            'खुलेको रकम रु.',
            'नगद रु.',
            'चेक रु.',
            'अन्य रु.',
            'जम्मा रकम रु.',
            'जग्गा क्षेत्रफल (विघा-कठ्ठा-धुर)',
            'कित्ता',
            'नगद रु.',
            'तमसुक रु.',
            'चेक रु.',
            'जग्गा (क्षेत्रफल विघा-कठ्ठा-धुर)',
            'कित्ता',
            'सुन (ग्राममा)',
            'चाँदी (ग्राममा)',
        ];
    }
}

