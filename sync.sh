echo ''
echo './*'
rsync -ruvzl --exclude '.git/*' -e ssh ./* ubuntu@ec2-79-125-68-216.eu-west-1.compute.amazonaws.com:/var/www/dev.zu.no/php_mvc/
