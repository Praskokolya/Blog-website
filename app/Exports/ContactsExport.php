<?php

namespace App\Exports;

use App\Models\Contact;
use App\Models\RegistredUsers;

use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ContactsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $contact = new Contact;
        
        return $contact->join('registred_users', 'contacts.user_id', '=', 'registred_users.id')
        ->select('contacts.message', 'contacts.subject', 'registred_users.email', 'registred_users.nickname')
        ->get()->prepend(['Message', 'Subject', 'Email', 'Nickname'], null);
    }
}
