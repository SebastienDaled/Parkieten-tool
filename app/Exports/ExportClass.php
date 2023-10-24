<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Order as AppOrder;

class ExportClass implements FromQuery, WithMapping, WithHeadings
{
    protected $fromDate;
    protected $toDate;

    public function __construct($fromDate, $toDate)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function query()
    {
        return AppOrder::with('user')
            ->whereBetween('created_at', [$this->fromDate, $this->toDate]);
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->user->name,
            $order->user->email,
            $order->status,
            $order->total_price,
            $order->payment_data,
            $order->remarks,
            $order->admin_remarks,
            $order->created_at,
            $order->updated_at,            
            // Include any other columns or attributes from the Order and User models
        ];
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Gebruikersnaam',
            'Email',
            'Status',
            'Totaal prijs',
            'Payment data',
            'Opmerkingen',
            'Admin opmerkingen',
            'Aangemaakt op',
            'Bijgewerkt op',

            // Include headings for any other columns or attributes
        ];
    }
}

