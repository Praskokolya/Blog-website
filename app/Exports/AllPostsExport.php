<?php

namespace App\Exports;

use App\Models\Contact;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AllPostsExport implements FromCollection, WithHeadings
{
    /**
     * @var @contact
     */
    public $contact;
    /**
     * ContactsExport constructor
     *
     * @param $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        return $this->contact
            ->join('registred_users', 'contacts.user_id', '=', 'registred_users.id')
            ->select('contacts.message', 'contacts.subject', 'registred_users.email', 'registred_users.nickname')
            ->get();
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
