#!/bin/bash
rm -rf data

mkdir -p  "data/in"
mkdir -p  "data/in/tables"
mkdir -p  "data/in/files"
mkdir -p  "data/in/user"

mkdir -p "data/out"
mkdir -p "data/out/tables"
mkdir -p "data/out/files"
mkdir -p "data/in/user"

echo "foobar" > "data/out/tables/table.sql"

echo "{}" > data/config.json
