<?php

namespace App\Exports;


use App\User;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Carbon;
use Maatwebsite\ Excel\ Concerns\ WithEvents;
use Maatwebsite\ Excel\ Events\ AfterSheet;


class PendapatanExport implements FromCollection, WithHeadings, WithEvents
{
    protected $daterange;

    function __construct($daterange) {
            $this->daterange = $daterange;
    }
    public function collection()
        {
           
        $date = explode('+', $this->daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        return $payments = DB::Table('payments')
        ->join('districts','districts.id','=','payments.district_id')
        ->select('payments.fullname','payments.address','payments.total')
        ->where('status_id', 3)
        ->whereBetween('payments.created_at', [$start, $end])
        ->get();
        }
        public function headings(): array
        {
            //Put Here Header Name That you want in your excel sheet 
            return [
                'Pelanggan',
                'Alamat',
                'Total',
            ];
        }
        public function registerEvents(): array {
            return [
            AfterSheet::class    => function(AfterSheet $event) {
                   $event->sheet->getStyle('A1:AB1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(20);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(20);
            },
        ];
   } 
}