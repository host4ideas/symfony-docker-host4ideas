# This project runs with mysql as a service inside the image
git clone https://github.com/yemiwebby/symfony-docker-tut.git
Set-Location symfony-docker-tut
symfony self:update
$projectName = Read-Host -Prompt "Enter your project name"
symfony new --full $projectName
Set-Location $projectName
composer require doctrine/annotations
composer require twig/twig
composer require symfony/mailer
composer require symfony/google-mailer
composer require symfony/form
composer require symfony/validator
composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
symfony check:security
docker-compose ps
Set-Location ..
Write-Host "`r`nYour project is complete`r`nRun 'docker-compose up -d' to build the Docker image or`r`nstart the local server 'symfony server:start -d' inside the app folder`r`n"
