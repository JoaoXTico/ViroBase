<?php
session_start();
session_unset();
session_destroy();

// Redireciona para a página de login (ou index)
header("Location: index.html");
exit;
