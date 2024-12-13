<?php

namespace App\Exports;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IntrigatedNoTransactionDetailsExport implements FromCollection, WithHeadings
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
                    'लिनदिन नपर्ने गरी फर्छ्यौट भएको उजुरी संख्या' => $district->no_transaction_release_count,
                    'कारोवार रकम रु.' => $district->sum_of_transaction_amount,
                    'अदालतमा मुद्दा विचाराधिन अवस्था (भएको)' => '', // Fill this with appropriate data
                    'अदालतमा मुद्दा विचाराधिन अवस्था (नभएको)' => '', // Fill this with appropriate data
                    'अनुचित लेनदेनको परिभाषा भित्र नपर्ने' => $district->getCountByReasonOfNoTransactions(1),
                    'आपसी सहमतीमा मिलापत्र गर्न निवेदन फिर्ता' => $district->getCountByReasonOfNoTransactions(2),
                    'निवेदकद्वारा निवेदन फिर्ता' => $district->getCountByReasonOfNoTransactions(3),
                    'लिनदिन नपर्ने गरी मिलापत्र' => $district->getCountByReasonOfNoTransactions(4),
                    'अदालतमा मुद्दा' => $district->getCountByReasonOfNoTransactions(5),
                    'जग्गा खरिद विक्री सम्बन्धी कारोवार भएको देखिएको' => $district->getCountByReasonOfNoTransactions(6),
                    'साहुद्रारा मिनहा गरिएको' => $district->getCountByReasonOfNoTransactions(7),
                    'अन्य कारण' => $district->getCountByReasonOfNoTransactions(8),
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
            'लिनदिन नपर्ने गरी फर्छ्यौट भएको उजुरी संख्या',
            'कारोवार रकम रु.',
            'अदालतमा मुद्दा विचाराधिन अवस्था (भएको)',
            'अदालतमा मुद्दा विचाराधिन अवस्था (नभएको)',
            'अनुचित लेनदेनको परिभाषा भित्र नपर्ने',
            'आपसी सहमतीमा मिलापत्र गर्न निवेदन फिर्ता',
            'निवेदकद्वारा निवेदन फिर्ता',
            'लिनदिन नपर्ने गरी मिलापत्र',
            'अदालतमा मुद्दा',
            'जग्गा खरिद विक्री सम्बन्धी कारोवार भएको देखिएको',
            'साहुद्रारा मिनहा गरिएको',
            'अन्य कारण',
        ];
    }
}

