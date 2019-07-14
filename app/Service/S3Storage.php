<?php


namespace App\Service;


class S3Storage implements Storage
{

    public function store($pathname, $content, $permissions = []): String
    {
        \Illuminate\Support\Facades\Storage::disk('s3')
            ->put($pathname, $content, $permissions);
        return $this->getUrlStorageFile($pathname);
    }

    public function remove($name)
    {
        \Illuminate\Support\Facades\Storage::disk('s3')->delete($name);
    }

    private function getUrlStorageFile($pathname) {
        return 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/' . $pathname;
    }

}