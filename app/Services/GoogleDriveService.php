<?php

namespace App\Services;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;

/**
 * Class GoogleDriveService
 *
 * This service provides functionality to upload files to Google Drive
 * using Google's API client. It handles authentication and file transmission.
 *
 * @package App\Services
 */
class GoogleDriveService
{
    /**
     * Google API client instance.
     *
     * @var Google_Client
     */
    protected $client;

    /**
     * Google Drive service instance.
     *
     * @var Google_Service_Drive
     */
    protected $service;

    /**
     * Initializes the Google Drive client and service.
     *
     * The credentials file must be located at 'storage/app/google-drive.json',
     * and the required scope is set to allow file-level access.
     */
    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setAuthConfig(storage_path('app/google-drive.json'));
        $this->client->addScope(Google_Service_Drive::DRIVE_FILE);

        $this->service = new Google_Service_Drive($this->client);
    }

    /**
     * Uploads a file to Google Drive.
     *
     * The uploaded file will be stored in the folder specified by the
     * GOOGLE_DRIVE_FOLDER_ID environment variable.
     *
     * @param string $filePath Full path to the local file to upload.
     * @param string $fileName Desired name of the file on Google Drive.
     * @return string|null The ID of the uploaded file, or null on failure.
     */
    public function uploadFile($filePath, $fileName)
    {
        // Prepare the file metadata
        $file = new Google_Service_Drive_DriveFile();
        $file->setName($fileName);
        $file->setParents([env('GOOGLE_DRIVE_FOLDER_ID')]);

        // Read the file content
        $content = file_get_contents($filePath);

        // Upload the file to Google Drive
        $result = $this->service->files->create($file, [
            'data' => $content,
            'mimeType' => 'application/pdf',
            'uploadType' => 'multipart',
        ]);

        // Return the ID of the uploaded file
        return $result->getId();
    }
}
