mysql -u root -p <<EOF
drop database blober;
create database blober;
EOF

php artisan migrate:refresh --seed;
