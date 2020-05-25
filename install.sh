
#!/bin/bash

echo -e "\n### Install TestAkna ###"

echo -e "\n# Start services (Apache/MySQL)"
sudo service apache2 start
sudo service mysql start

echo -e "\n# Create database..."
echo -e "\n Enter user in mysql: "
read umysql
echo -e "\n Enter password in mysql:"
read pmysql
mysql -u $umysql -p$pmysql   <<-EOF
   	DROP DATABASE IF EXISTS test_akna;
    CREATE DATABASE test_akna;
EOF

mysql -u $umysql -p$pmysql test_akna < install-db.sql 
<<-EOF 
EOF

echo -e "\n### Install Complete !!!\n"
