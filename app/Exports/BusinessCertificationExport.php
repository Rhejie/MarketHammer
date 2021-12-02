<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BusinessCertificationExport implements 
	FromArray,
	WithStyles,
	WithHeadings
{
	protected $certifications;

	/**
	 * Pass data from when instatiated
	 *
	 * @param $certifications <array>
	 */
	public function __construct(array $certifications)
    {
        $this->certifications = $certifications;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        return array_map(function ($q) {
        	$q['description'] = __insert_new_line_char($q['description'], 15);
        	return $q;
        }, $this->certifications);
    }

    /**
	 * The export template headers
	 *
	 * @return <array>
     */
    public function headings(): array
    {
        return [
            'No.',
            'Name',
            'Description',
            'Issued Date',
            'Expiration Date'
        ];
    }

    /**
	 * The export template styling. If you want to add additional more custom styling in your sylesheet
	 * just register it here.
     */
    public function styles(Worksheet $sheet)
    {
    	// set header's font to bold
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
    }
}
