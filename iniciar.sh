
#!/bin/bash

echo "================================"
echo " Iniciando ambiente PHP"
echo "================================"

# Configurar Apache
echo "[1/3] Configurando Apache..."

sudo sed -i 's/Listen 80$//' /etc/apache2/ports.conf

sudo sed -i 's/<VirtualHost \*:80>/ServerName 127.0.0.1\n<VirtualHost *:8080>/' /etc/apache2/sites-enabled/000-default.conf

# Iniciar Apache
sudo apache2ctl start

# Iniciar MariaDB
echo "[2/3] Iniciando MariaDB..."

sudo service mariadb start

# Iniciar PHP
echo "[3/3] Iniciando servidor PHP..."

echo "Ambiente iniciado!"
echo "Apache: http://localhost:8080"
echo "PHP: http://localhost:8000"

php -S 0.0.0.0:8000