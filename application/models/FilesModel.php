<?php

class FilesModel extends CI_Model {
  public function __construct () {
    parent::__construct();
  }
  
  public function removeFile (string $folderName, string $fileName, string $fileType) {
    $basePath = 'assets/uploads/' . $fileType . 's/';
    $filePath = $basePath . $folderName . $fileName;
    return $this->unlinkFile($filePath);
  }

  private function unlinkFile ($filePath) {
    if (!is_file($filePath)) return false;

    try {
      @unlink($filePath);
      return true;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function uploadFile (string $folderName, string $fileName, string $fieldName, string $fileType) : array {
    $allowedTypesByFileType = [
      'video' => 'mp4',
      'file' => 'pdf|doc|docx|odt',
      'image' => 'gif|jpeg|jpg|png'
    ];

    if (!array_key_exists($fileType, $allowedTypesByFileType)) {
      return false;
    }

    $fileInfo = pathinfo($fileName);
    $extension = $fileInfo['extension'];
    $fileName = $fileInfo['filename'];

    $settings = [
      'upload_path' => 'assets/uploads/'. $fileType . 's/' . $folderName,
      'allowed_types' => $allowedTypesByFileType[$fileType],
      'file_name' => slugify($fileName). '-' . time() . '.' . $extension,
      'file_ext_tolower' => true
    ];

    $this->load->library('upload', $settings);
    
    if (!$this->upload->do_upload($fieldName)) {
      return ['success' => false, 'error' => strip_tags($this->upload->display_errors())];
    }
    
    $uploadData = $this->upload->data();
    
    if ($fileType === 'image') {
      $this->load->library('image_lib');

      $resizeSettings = [
        'image_library' => 'gd2',
        'source_image' => $uploadData['full_path'],
        'maintain_ratio' => true,
        'width' => 400,
      ];

      $this->image_lib->clear();
      $this->image_lib->initialize($resizeSettings);
      $this->image_lib->resize();
    }

    chmod($uploadData['full_path'], 0777);

    return ['success' => true, 'uploadData' => $uploadData];
  }
}
