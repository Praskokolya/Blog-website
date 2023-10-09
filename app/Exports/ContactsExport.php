<?php

namespace App\Exports;

use App\Models\Contact;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactsExport implements FromCollection, WithHeadings
{
    /**
     * @var @contact
     */
    public $contact; 
    /**
     * ContactsExport constructor
     *
     * @param Contact $contact
     */
    public function __construct(Contact $contact){
        $this->contact = $contact;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        
        return $this->contact->registredUser->email;


    }
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Message',
            'Subject',
            'Email',
            'Nickname',
        ];
    }

}
