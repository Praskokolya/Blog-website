<?php

namespace App\Services;

use App\Exports\UserPostsExport;
use App\Repositories\GetPosts;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class FileService
{

    public $getPosts;
    public function __construct(GetPosts $getPosts)
    {
        $this->getPosts = $getPosts;
    }
    /**
     * @param mixed $methodToInstall
     * @param string $path
     * @return void
     * instal file, first parametr its way how you will install this file, and second its just prefix to path,
     * in my case its excel
     */
    public function saveAllPosts($methodToInstall, $prefixToPath)
    {
        try {
            Excel::store($methodToInstall, $prefixToPath . 'messages.xlsx');
        } catch (Throwable $error) {
            Log::channel('slack')->critical('error', ['error' => $error]);
        }
    }

    /**
     * same function as above, but this getting info from table in method of class (saveUserFile), not like 
     * 'saveFile': inside the export class, as well parameter its prefix and id of user which excel
     * will send
     * @param int $id
     * @param string $prefix
     * @return void
     */
    public function saveUserPosts(int $id, string $prefix)
    {
        try {
            $data = $this->getPosts
                ->getPostByUserId($id);
            Excel::store(new UserPostsExport($data), $prefix . 'messages.xlsx');
        } catch (Throwable $error) {
            Log::channel('slack')->critical('error', ['error' => $error]);
        }
    }
}
