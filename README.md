
📘 README - Guia de Instalação Rápida do Portal FlaMídia

Siga os passos abaixo no seu terminal para instalar e executar o projeto localmente.

---

🚀 1. Clonar o Projeto e Navegar
```bash
cd "C:\xampp\htdocs\sua-pasta-web"
git clone https://github.com/conique/Portal-FlaMidia.git
cd portal-flamidia
```

---

⚙️ 2. Configuração do Projeto
```bash
copy .env.example .env
php artisan key:generate
```

---

🗄️ 3. Banco de Dados

1. Acesse o **phpMyAdmin** e crie um banco de dados com o nome:

```
portal_flamidia
```

2. No arquivo `.env`, atualize os dados de conexão com o banco:

```
DB_DATABASE=portal_flamidia
DB_USERNAME=root
DB_PASSWORD=
```

3. Execute as migrações para criar as tabelas:

```bash
php artisan migrate
```

---

🎨 4. Assets e Link Simbólico
```bash
php artisan storage:link
npm install
npm run dev
```

---

🖥️ 5. Iniciar os Servidores

Abra **dois terminais** na pasta do projeto:

Terminal 1:
```bash
php artisan serve
```

Terminal 2:
```bash
npm run dev
```

---

🌐 6. Acesso ao Sistema

Após seguir todos os passos, acesse o site pelo navegador:

🔗 http://127.0.0.1:8000

---

🔒 7. Acesso ao Painel Admin

1. Vá até: http://127.0.0.1:8000/login  
2. Clique em **Register** para criar seu usuário.  
3. Após o cadastro, faça login normalmente.  
4. Você será redirecionado ao **painel de gerenciamento**.

---

✅ Projeto Pronto!

Agora seu projeto **Portal FlaMídia** está rodando localmente com sucesso!
