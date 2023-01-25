<?php
session_start(); // On démarre la session

// Cookie thème
if (isset($_SESSION['user'])) {
  if (isset($_COOKIE[$_SESSION['user']['nickname'] . 'theme'])) {
      $theme = $_COOKIE[$_SESSION['user']['nickname'] . 'theme'];
  } else {
      $theme = 'light';
  }
} else {
  $theme = 'light';
}