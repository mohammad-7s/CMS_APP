#!/usr/bin/env bash
set -e

echo "== Laravel & env =="
php -v || true
composer -V || true
node -v || true
npm -v || true
echo "ENV file present?"; [ -f .env ] && echo "YES" || echo "NO"

echo; echo "== Git status =="
git rev-parse --abbrev-ref HEAD 2>/dev/null || echo "Not a git repo"

echo; echo "== Laravel environment =="
php artisan --version || true
echo "APP_ENV: $(php -r "echo getenv('APP_ENV') ?: 'unknown';")"

echo; echo "== Migrations and DB tables =="
php artisan migrate:status || true
# check typical tables
TABLES=("users" "articles" "categories" "comments" "contact_messages")
for t in "${TABLES[@]}"; do
  echo -n "table $t exists? "
  php -r "try { \$c=new PDO('mysql:host='.getenv('DB_HOST').';dbname='.getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD')); \$r=\$c->query(\"SHOW TABLES LIKE '$t'\"); echo (\$r && \$r->rowCount()>0)?'YES':'NO'; } catch (Exception \$e){ echo 'DB-CONN-ERROR'; }"
  echo
done

echo; echo "== Routes (show admin/article related routes) =="
php artisan route:list --name=admin --columns=method,uri,name | sed -n '1,120p' || true
php artisan route:list --name=articles --columns=method,uri,name | sed -n '1,120p' || true

echo; echo "== Files & Views check =="
[ -d resources/views ] && echo "views dir exists" || echo "no views dir"
echo "Look for article / category views:"
ls resources/views | sed -n '1,200p' || true
echo "grep for tinymce in resources:"
grep -R --line-number "tinymce" resources || echo "tinymce not found in resources"
echo "grep for image upload handling in controllers:"
grep -R --line-number "store(" app/Http/Controllers || true
grep -R --line-number "image" app || true

echo; echo "== Storage check =="
[ -L public/storage ] && echo "public/storage -> linked" || echo "public/storage not linked"
echo "List storage/app/public (first 20):"
ls -la storage/app/public | sed -n '1,120p' || true

echo; echo "== Check admin user exists (email admin@example.com by seeder) =="
php artisan tinker --execute="echo(\App\Models\User::where('email','admin@example.com')->exists()? 'admin user FOUND':'admin user NOT FOUND');" || true

echo; echo "== Quick DB counts (if DB connected) =="
php artisan tinker --execute="echo('Articles: '.\App\Models\Article::count().\"\\nCategories: \".\App\Models\Category::count().\"\\nComments: \".\App\Models\Comment::count()).PHP_EOL;" || true

echo; echo "== Done checks =="
