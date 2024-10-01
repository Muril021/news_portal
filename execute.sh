#!/bin/bash
set -e

./scripts/run-install.sh
./scripts/run-migrations.sh
./scripts/run-install-breeze.sh
./scripts/run-serve.sh
