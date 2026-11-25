
echo "================================"
echo " Iniciando ambiente PHP"
echo "================================"

echo "Configurando Apache..."
sudo sed -i 's/Listen 80$//' /etc/apache2/ports.conf
sudo sed -i 's/<VirtualHost \*:80>/ServerName 127.0.0.1\n<VirtualHost *:8080>/' /etc/apache2/sites-enabled/000-default.conf

sudo apache2ctl start

echo "Conectando ao MariaDB..."
mysql --skip-ssl -h 127.0.0.1 -P 3306 -u root -p

echo "Iniciando servidor PHP..."
echo "Ambiente iniciado!"
echo "Apache: http://localhost:8080"
echo "PHP: http://localhost:8000"
php -S 0.0.0.0:8000