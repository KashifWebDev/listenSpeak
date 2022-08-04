<?php
require 'app.php';

session_unset();
session_destroy();

js_redirect("../");