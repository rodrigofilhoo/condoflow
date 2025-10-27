<?php
// Copia os arquivos necessários do Laravel para dist
if (file_exists(__DIR__ . '/../public/index.php')) {
    copy(__DIR__ . '/../public/index.php', __DIR__ . '/../dist/index.php');
}

// Redireciona para o entry point do Laravel
require __DIR__ . '/../public/index.php';
