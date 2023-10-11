<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserPostsExport implements FromCollection, WithHeadings
{
    public $userPosts;
    /**
     * Undocumented function
     *
     * @param \Illuminate\Support\Collection $userPosts
     */
    public function __construct(Collection $userPosts)
    {
        $this->userPosts = $userPosts;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->userPosts;
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
