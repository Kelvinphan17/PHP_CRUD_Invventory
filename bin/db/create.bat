
psql -U postgres -c "DROP DATABASE subspace" || true
psql -U postgres -c "CREATE DATABASE subspace"
psql -U postgres -d subspace -f ./db/schema.sql
psql -U postgres -d subspace -f ./db/seed.sql