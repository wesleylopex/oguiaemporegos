<?php
class AdminGodController extends AdminController {  
  function __construct () {
    parent::__construct();
    $this->load->model($this->model);
    
    $this->model = $this->{$this->model};
    
    $this->data['permissions'] = $this->permissions;
    $this->data['names'] = $this->names;

    $this->data['uploadFolder'] = isset($this->uploadFolder) ? $this->uploadFolder : '';

    $this->data['fields'] = $this->configSelectFields($this->fields);
  }

  public function index () {
    if (array_key_exists('isUnique', $this->permissions) && $this->permissions['isUnique']) {
      redirect('admin/' . $this->names['link'] . '/update/1');
    }

    if (isset($this->getAllWhere)) {
      $records = $this->model->getAllWhere($this->getAllWhere);
    } else {
      $records = $this->model->getAll();
    }

    if ($this->names['link'] == 'candidates') {
      $records = $this->setCandidatesInfo($records);
      $this->load->model('jobsAreasModel');
      $this->data['jobsAreas'] = $this->jobsAreasModel->getAll();
    }

    $this->data['records'] = $this->configOptionsToTable($records, $this->fields);

    $this->load->view('admin/god-controller/index', $this->data);
  }

  private function setCandidatesInfo ($candidates) {
    $this->load->model('candidatesModel');

    foreach ($candidates as $candidate) {
      $candidate->age = $this->candidatesModel->getAge($candidate);
    }

    return $candidates;
  }

  public function create () {
    if ($this->permissions['create']) {
      $this->load->view('admin/god-controller/form', $this->data);
    } else {
      redirect('admin/' . $this->names['link']);
    }
  }

  public function update ($id = null) {
    $record = $this->model->getByPrimary($id);
    
    if (!$this->permissions['update'] || !$record) {
      redirect('admin/' . $this->names['link']);
    }

    $this->data['record'] = $record;
    $this->load->view('admin/god-controller/form', $this->data);
  }

  private function getCandidateWithForeignRows ($candidate) {
    $this->load->model('candidatesFormationsModel');
    $formations = $this->candidatesFormationsModel->getAllWhere(['candidate_id' => $candidate->id]);

    $this->load->model('candidatesCoursesModel');
    $candidate->courses = $this->candidatesCoursesModel->getAllWhere(['candidate_id' => $candidate->id]);
    
    $this->load->model('candidatesLanguagesModel');
    $candidate->languages = $this->candidatesLanguagesModel->getAllWhere(['candidate_id' => $candidate->id]);

    $this->load->model('candidatesExperiencesModel');
    $candidate->professionalExperiences = $this->candidatesExperiencesModel->getAllWhere(['candidate_id' => $candidate->id]);

    return $candidate;
  }

  private function getCandidatesJobsSituations () {
    $this->load->model('candidatesJobsSituationsModel');
    return $this->candidatesJobsSituationsModel->getAll();
  }

  private function getCandidatesByJob ($job) {
    $this->load->model('candidatesJobsModel');
    $this->load->model('candidatesJobsSituationsModel');
    $this->load->model('candidatesModel');

    $candidatesJobsRelation = $this
      ->candidatesJobsModel
      ->getAllWhere(['job_id' => $job->id]);
    $candidates = [];
    
    foreach($candidatesJobsRelation as $relation) {
      $candidate = $this->candidatesModel->getByPrimary($relation->candidate_id);
      $candidate->situation = $this->candidatesJobsSituationsModel->getByPrimary($relation->situation_id);
      $candidate->interest = $relation;

      array_push($candidates, $candidate);
    }

    return $candidates;
  }

  public function delete () {
    $ids = $this->input->post('id');
    foreach ($ids as $id) {
      $record = $this->model->getByPrimary($id);
      
      if (!$this->permissions['delete'] || !$record) {
        return false;
      }

      $this->deleteRecordFiles($id);
      $this->model->delete($id);
    }
  }

  private function deleteRecordFiles ($recordId) {
    $record = $this->model->getByPrimary($recordId);
    if (!$record) {
      return false;
    }
    
    $fields = array_filter($this->fields, function ($field) {
      return $field['type'] == 'image' || $field['type'] == 'video' || $field['type'] == 'file';
    });

    foreach ($fields as $field) {
      $this->deleteFile($recordId, $field['name'], $field['type']);
    }

    return true;
  }
  
  private function deleteFile ($recordId, string $fieldName, string $fileType) {
    $record = $this->model->getByPrimary($recordId);
    
    if (!$record) {
      return false;
    }

    $recordFile = $record->{$fieldName};

    if (!$recordFile) {
      return false;
    }

    $allowedTypes = ['image', 'video', 'file'];
    if (!in_array($fileType, $allowedTypes)) {
      return false;
    }

    $this->load->model('filesModel');
    $this->filesModel->removeFile(
      $this->uploadFolder ? ($this->uploadFolder . '/') : '',
      $recordFile,
      $fileType
    );
  }

  private function addFile (string $fieldName, string $fileType) {
    $file = $_FILES[$fieldName];
    $fileName = $file['name'];

    if (!$fileName) return false;

    $allowedTypes = ['image', 'video', 'file'];
    if (!in_array($fileType, $allowedTypes)) {
      return false;
    }

    $this->load->model('filesModel');
    $file = $this->filesModel->uploadFile(
      $this->uploadFolder,
      $this->names['link'] . '-' . $fileName,
      $fieldName,
      $fileType
    );

    if (!$file || !array_key_exists('upload_data', $file)) {
      return false;
    }

    $fileName = $file['upload_data']['file_name'];

    return $fileName;
  }

  private function addFileAndGetName (string $fieldName, string $fileType) {
    $this->load->model('filesModel');
    $imageNameOrFalse = $this->addFile($fieldName, $fileType);

    if ($imageNameOrFalse) {
      return $imageNameOrFalse;
    }

    return null;
  }

  private function getFieldValue (string $fieldName, array $fieldInfo) {
    if (!array_key_exists('type', $fieldInfo)) return null;
    
    $actions = [
      'date' => function () use ($fieldName) {
        return implode('-', array_reverse(explode('/', $this->input->post($fieldName))));
      },
      'user_id' => function () {
        $user = $this->session->userdata('admin');

        if (array_key_exists('id', $user)) {
          return $user['id'];
        }

        return null;
      },
      'password' => function () use ($fieldName) {
        $password = $this->input->post($fieldName);

        if ($password) {
          return encodeCrip($password);
        }
      }
    ];

    if (array_key_exists($fieldInfo['type'], $actions)) {
      $action = $actions[$fieldInfo['type']];
      return $action();
    }

    $fileTypes = ['image', 'video', 'file'];
    if (in_array($fieldInfo['type'], $fileTypes)) {
      return $this->addFileAndGetName($fieldName, $fieldInfo['type']);
    }

    return $this->input->post($fieldName);
  }

  public function save () {
    $this->setRulesValidation($this->data['fields']);

    $recordData = [];

    foreach ($this->fields as $field) {
      $hasDisabled = array_key_exists('disabled', $field);
      $isEnabled = !$hasDisabled || ($hasDisabled && !$field['disabled']);
      
      $hasShowOnForm = array_key_exists('showOnForm', $field);
      $showOnForm = !$hasShowOnForm || ($hasShowOnForm && $field['showOnForm']);

      if ($isEnabled && $showOnForm) {
        $fileTypes = ['image', 'video', 'file'];
        
        if (
          array_key_exists('id', $recordData)
          && $recordData['id']
          && in_array($field['type'], $fileTypes)
          && $_FILES[$field['name']]['name']
        ) {
          $this->deleteFile($recordData['id'], $field['name'], $field['type']);
        }

        $ignoredFieldTypes = ['separator', 'slug'];
        if (!in_array($field['type'], $ignoredFieldTypes)) {
          if (
            !in_array($field['type'], $fileTypes)
            || (array_key_exists($field['name'], $_FILES) && $_FILES[$field['name']]['name'])
          ) {
            $fieldValue = $this->getFieldValue($field['name'], $field);
            if ($field['type'] != 'password' || ($field['type'] == 'password' && $fieldValue)) {
              $recordData[$field['name']] = $fieldValue;
            }
          }
        }
      }

      if (array_key_exists('slug', $field) && $field['slug'] === true) {
        $slug = slugify($this->input->post($field['name']));

        $where = ['slug' => $slug];
        
        if (array_key_exists('id', $recordData)) {
          $where['id !='] = $recordData['id'];
        }

        $isSlugValid = $this->model->count($where) == 0;

        if (!$isSlugValid) {
          $slug = $slug . '-' . rand(1, 100);
        }

        $recordData['slug'] = slugify($slug);
      }
    }

    if ($this->form_validation->run() == false) {
      echo json_encode(['success' => false, 'errors' => strip_tags(validation_errors())]);
      return false;
    }

    if (array_key_exists('id', $recordData) && $recordData['id']) {
      if ($this->permissions['update'] && $this->model->update($recordData)) {
        $this->session->set_flashdata('success', 'Registro editado com sucesso.');
      }
    } else if ($this->permissions['create'] && $this->model->create($recordData)) {
      $this->session->set_flashdata('success', 'Registro criado com sucesso.');
    }
    
    echo json_encode(['success' => true]);
  }

  public function saveFromTable () {
    $id = $this->input->post('recordId');
    $fieldName = $this->input->post('fieldName');
    $fieldValue = $this->input->post('fieldValue');

    $fieldKey = array_search($fieldName, array_column($this->fields, 'name'));
    $field = $this->fields[$fieldKey];

    if (!$field) {
      echo json_encode(['success' => false, 'errors' => 'Campo não encontrado']);
      return false;
    }

    $recordData = [
      'id' => $id,
      $fieldName => $fieldValue
    ];

    if (array_key_exists('slug', $field)) {
      $slug = slugify($recordData[$fieldName]);
      if ($this->model->count(['slug' => $slug]) > 0) {
        echo json_encode(['success' => false, 'errors' => 'Campo duplicado']);
        return false;
      } else {
        $recordData['slug'] = $slug;
      }
    }

    if ($this->model->update($recordData)) {
      echo json_encode(['success' => true]);
    } else {
      echo json_encode(['success' => false]);
    }
  }

  private function setRulesValidation (array $fields) {
    foreach ($fields as $field) {
      if (array_key_exists('rules', $field)) {
        $this->form_validation->set_rules($field['name'], $field['name'], $field['rules']);
      }
    }
  }

  private function configSelectFields (array $fields)  {
    $fields = array_map(function ($field) {
      if (
        $field['type'] == 'select'
        && array_key_exists('fromDataBase', $field)
        && $field['fromDataBase'] == true
      ) {
        $field['options'] = $this->getSelectFieldOptions($field);
      }

      return $field;
    }, $fields);

    return $fields;
  }

  private function getSelectFieldOptions ($field) {
    $modelName = $field['options']['model'];

    $this->load->model($modelName);
    $model = $this->{$modelName};

    $records = $model->getAll();
    $options = [];

    foreach ($records as $record) {
      $options[$record->{$field['options']['value']}] = $record->{$field['options']['text']};
    }

    return $options;
  }

  private function configOptionsToTable ($records, $fields) {
    foreach ($records as $record) {
      foreach ($fields as $field) {
        if (
          $field['type'] == 'select'
          && array_key_exists('fromDataBase', $field)
          && $field['fromDataBase'] === true
        ) {
          $modelName = $field['options']['model'];
          $this->load->model($modelName);
          $model = $this->{$modelName};

          $row = $model->getByPrimary($record->{$field['name']});
          if (!array_key_exists('editableOnTable', $field) || !$field['editableOnTable']) {
            $record->{$field['name']} = [];
            if ($row) {
              $record->{$field['name']}['selectText'] = $row->{$field['options']['text']};
            } else {
              $record->{$field['name']}['selectText'] = null;
            }
          }
        }
      }
    }

    return $records;
  }
}