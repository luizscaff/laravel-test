Olá! Essa é a minha resolução do teste prático para desenvolvedor PHP (Laravel)!

//-----------------------------------------------------------------------

Essa resolução foi desenvolvida com Laravel 9.x em ambiente Linux (Ubuntu);

Antes da primeira utilização, é necessário configurar o arquivo .env, o ambiente local e rodar os seguintes comandos:

    "composer update",
    
    "npm install",
    
    "php artisan migrate --seed",
    
    "npm run dev;
    

//-----------------------------------------------------------------------

O banco de dados estará preenchido com quatro usuários e três tipos de permissão (especificadas nas instruções do teste):

Administrador:

    Login: admin@system
    
    Senha: 12345678
    

Usuário comum sem permissões concedidas:

    Login: user@nopermissions
    
    Senha: 12345678
    

Usuário comum com todas permissões concedidas:

    Login: user@allpermissions
    
    Senha: 12345678
    

Usuário comum com algumas permissões concedidas:

    Login: user@somepermissions
    
    Senha: 12345678
    

//-----------------------------------------------------------------------
