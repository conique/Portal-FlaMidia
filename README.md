🚀 Guia de Instalação Rápida
Siga estes comandos, um por um, no seu terminal.

1. Clonar e Navegar
cd "C:\xampp\htdocs\sua-pasta-web"
git clone https://github.com/conique/Portal-FlaMidia.git
cd portal-flamidia

2. Configuração do Projeto
# Copia o arquivo de ambiente
copy .env.example .env

# Gera a chave da aplicação
php artisan key:generate

3. Banco de Dados
Crie um banco de dados chamado portal_flamidia no phpMyAdmin.

Abra o arquivo .env e configure as credenciais:

DB_DATABASE=portal_flamidia
DB_USERNAME=root
DB_PASSWORD=

Rode as migrações para criar as tabelas:
php artisan migrate

4. Assets e Link Simbólico
# Cria o link para as imagens
php artisan storage:link

# Instala as dependências do frontend
npm install

# Compila os assets do frontend
npm run dev

5. Iniciar Servidores
Abra dois terminais na pasta do projeto e execute:

Terminal 1:
php artisan serve

Terminal 2:
npm run dev

🌐 Acesso ao Sistema
Após seguir os passos, seu site estará disponível em:

http://127.0.0.1:8000

🔒 Acesso ao Admin
Vá para http://127.0.0.1:8000/login

Clique em "Register" para criar seu usuário.

Faça login para acessar o painel de gerenciamento.
