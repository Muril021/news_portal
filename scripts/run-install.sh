#!/bin/bash

composer install
php artisan key:generate

FILE_PATH=".env"

if [ ! -f "$FILE_PATH" ]; then
  echo "------------------------------------------------------------------------------------------------------------------------------------------------------------------"
  echo ""
  echo "ARQUIVO .env INEXISTENTE, POR FAVOR, CRIE O ARQUIVO COM BASE EM .env.example, ADICIONE SUAS INFORMAÇÕES DE BANCO DE DADOS E RODE O ARQUIVO ./execute.sh NOVAMENTE."
  echo ""
  echo "------------------------------------------------------------------------------------------------------------------------------------------------------------------"
  echo ""
  echo ""
  echo ""
  exit 1
fi
