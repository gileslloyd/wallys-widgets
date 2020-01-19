#!/bin/bash
set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" <<-EOSQL
    ALTER USER postgres PASSWORD 'password';
    GRANT ALL PRIVILEGES ON DATABASE fmf-traderprofile TO fmf-traderprofile;

EOSQL

psql fmf-traderprofile -c 'create extension hstore;'