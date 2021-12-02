<?php

namespace App\Exports;

use App\Model\Business;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BusinessListExportExcel implements WithHeadings,
    WithEvents,
    ShouldAutoSize
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return ['legal_name',
                'phone',
                'fax',
                'email',
                'eid',
                'corp_ssn',
                'business_category',
                'country',
                'state',
                'city',
                'postal_code',
                'street1',
                'address_type',
                'factory_type',
                'lot_area',
                'mfr_area',
                'name',
                'title',
                'about_us',
                'website',
                'date_established'];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:U1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
                $event->sheet->getDelegate()->getStyle('A1:U1')->getFont()->setSize(12);
            }
        ];
    }
}
