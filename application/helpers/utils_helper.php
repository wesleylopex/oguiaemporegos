<?php if (!defined('BASEPATH')) exit('No direct script acess allowed');

function encodeCrip ($string) {
  return hashPassword($string);
}

function decodeCrip ($string) {
  return base64_decode($string);
}

function hashPassword ($password) {
  $options = ['cost' => 12];
  return password_hash($password, PASSWORD_BCRYPT, $options);
}

function compareHash ($password, $hash) {
  return password_verify($password, $hash);
}

function getAge ($date) : int {
  if (!$date) return null;

  $date = new DateTime($date);
  $now = new DateTime();
  $interval = $now->diff($date);

  return $interval->y;
}

function validEmail (string $email) {
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return false;
  }

  return true;
}

function validCpf (string $cpf) {
  $cpf = preg_replace('/[^0-9]/is', '', $cpf);

  if (strlen($cpf) != 11) {
    return false;
  }

  if (preg_match('/(\d)\1{10}/', $cpf)) {
    return false;
  }

  for ($t = 9; $t < 11; $t++) {
    for ($d = 0, $c = 0; $c < $t; $c++) {
      $d += $cpf[$c] * (($t + 1) - $c);
    }

    $d = ((10 * $d) % 11) % 10;
    if ($cpf[$c] != $d) {
      return false;
    }
  }

  return true;
}

function normalize ($string) {
  $table = [
    'Š' => 'S', 'š' => 's', 'Đ' => 'Dj', 'đ' => 'dj', 'Ž' => 'Z', 'ž' => 'z', 'Č' => 'C', 'č' => 'c', 'Ć' => 'C', 'ć' => 'c',
    'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
    'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O',
    'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss',
    'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
    'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o',
    'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b',
    'ÿ' => 'y', 'Ŕ' => 'R', 'ŕ' => 'r',
  ];

  return strtr($string, $table);
}

function slugify ($text) {
  $text = normalize($text);
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, '-');
  $text = preg_replace('~-+~', '-', $text);
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

function antiInjection ($value, $addSlashes = true) {
  $value = preg_replace('/(from|alter table|select|insert|delete|update|where|drop table|show tables|#|\*|--|\\\\)/i', '', $value);
  $value = trim($value);
  $value = strip_tags($value);

  if ($addSlashes) {
    $value = addslashes($value);
  }

  return $value;
}

function getTimePlural (string $time) {
  if ($time == 'mês') return 'meses';
  return $time . 's';
}

function timeElapsedString ($datetime, $full = false) {
  date_default_timezone_set('America/Sao_Paulo');

  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = [
    'y' => 'ano',
    'm' => 'mês',
    'w' => 'semama',
    'd' => 'dia',
    'h' => 'hora',
    'i' => 'minuto',
    's' => 'segundo'
  ];

  foreach ($string as $k => &$v) {
    if ($diff->$k) {
      $v = $diff->$k . ' ' . ($diff->$k > 1 ? getTimePlural($v) : $v);
    } else {
      unset($string[$k]);
    }
  }

  if (!$full) $string = array_slice($string, 0, 1);

  return $string ? implode(', ', $string) . ' atrás' : 'agora mesmo';
}
