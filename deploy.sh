#!/bin/bash

# Script simplificado para o deploy no Vercel
echo "Iniciando build para o Vercel..."

# Executar o build do Vite
npm run build

# Verificar o conteúdo do diretório public
echo "Conteúdo do diretório public após o build:"
ls -la public/

echo "Build concluído!"
