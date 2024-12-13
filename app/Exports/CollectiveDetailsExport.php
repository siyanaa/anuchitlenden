<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CollectiveDetailsExport implements FromCollection, WithHeadings
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
            // dd($registration->districts);
            foreach ($registration->districts as $district) {
                // dd($registration->districts);
                $data[] = [
                    // 'क्र.सं.' => '', // Fill this with appropriate data
                    'जिल्ला' => $district->name,
                    'कुल उजुरी संख्या' => $district->totalRegistrationCount,
                    'छलफलको क्रममा रहेको उजुरी संख्या' => $district->totalUnderDiscussionCount,
                    'लिनदिन नपर्ने गरी फर्छ्यौट भएको उजुरी संख्या' => $district->no_transaction_release_count,
                    'लिनदिन पर्ने गरी फर्छ्यौट भएको उजुरी संख्या' => $district->with_transaction_release_count,
                    'अदालतमा मुद्दा विचाराधिन भए पनि फर्छंयौट गरिएको संख्या' => $district->sumOfIssueInCourtButReleased,
                    'कारोवार रकम रु' => $district->sumOfCollectiveTransactionAmount,
                    'अनुचित लेनदेनको परिभाषा भित्र नपर्ने' => $district->getCountByReasonOfNoTransactions(1),
                    'आपसी सहमतीमा मिलापत्र गर्न निवेदन फिर्ता' => $district->getCountByReasonOfNoTransactions(2),
                    'निवेदकद्वारा निवेदन फिर्ता' => $district->getCountByReasonOfNoTransactions(3),
                    'लिनदिन नपर्ने गरी मिलापत्र' => $district->getCountByReasonOfNoTransactions(4),
                    'अदालतमा मुद्दा' => $district->getCountByReasonOfNoTransactions(5),
                    'जग्गा खरिद विक्री सम्बन्धी कारोवार भएको देखिएको' => $district->getCountByReasonOfNoTransactions(6),
                    'साहुद्रारा मिनहा गरिएको' => $district->getCountByReasonOfNoTransactions(7),
                    'अन्य कारण' => $district->getCountByReasonOfNoTransactions(8),
                    'विपक्षी साहुबाट माग भएको रकम (नखुलेको उजुरी संख्या)' => $district->getTotalNoOfOffenderDemandNotReveal(),
                    'विपक्षी साहुबाट माग भएको रकम (खुलेको रकम रु)' => $district->getTotalSumOfOffenderDemand(),
                    'नगद रु.' => $district->getSumOfApplicantReceivedByNature(1, 1),
                    'तमसुक रु.' => $district->getSumOfApplicantReceivedByNature(1, 5),
                    'चेक रु.' => $district->getSumOfApplicantReceivedByNature(1, 2),
                    'जग्गा क्षेत्रफल (विघा-कठ्ठा-धुर)' => $district->getTotalSumOfApplicantLand(1),
                    'कित्ता' => $district->getTotalSumOfApplicantLandKitta(1),
                    'नगद रु.' => $district->getSumOfOffenderReturnByNature(1, 1),
                    'तमसुक रु.' => $district->getSumOfOffenderReturnByNature(1, 5),
                    'चेक रु.' => $district->getSumOfOffenderReturnByNature(1, 2),
                    'जग्गा क्षेत्रफल (विघा-कठ्ठा-धुर)' => $district->getTotalSumOfOffenderLand(1),
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
            // 'क्र.सं.',
            'जिल्ला',
            'कुल उजुरी संख्या',
            'छलफलको क्रममा रहेको उजुरी संख्या',
            'लिनदिन नपर्ने गरी फर्छ्यौट भएको उजुरी संख्या',
            'लिनदिन पर्ने गरी फर्छ्यौट भएको उजुरी संख्या',
            'अदालतमा मुद्दा विचाराधिन भए पनि फर्छंयौट गरिएको संख्या',
            'कारोवार रकम रु',
            'अनुचित लेनदेनको परिभाषा भित्र नपर्ने',
            'आपसी सहमतीमा मिलापत्र गर्न निवेदन फिर्ता',
            'निवेदकद्वारा निवेदन फिर्ता',
            'लिनदिन नपर्ने गरी मिलापत्र',
            'अदालतमा मुद्दा',
            'जग्गा खरिद विक्री सम्बन्धी कारोवार भएको देखिएको',
            'साहुद्रारा मिनहा गरिएको',
            'अन्य कारण',
            'विपक्षी साहुबाट माग भएको रकम (नखुलेको उजुरी संख्या)',
            'विपक्षी साहुबाट माग भएको रकम (खुलेको रकम रु)',
            'नगद रु.',
            'तमसुक रु.',
            'चेक रु.',
            'जग्गा क्षेत्रफल (विघा-कठ्ठा-धुर)',
            'कित्ता',
            'नगद रु.',
            'तमसुक रु.',
            'चेक रु.',
            'जग्गा क्षेत्रफल (विघा-कठ्ठा-धुर)',
            'कित्ता',
            'सुन (ग्राममा)',
            'चाँदी (ग्राममा)',
        ];
    }
}
