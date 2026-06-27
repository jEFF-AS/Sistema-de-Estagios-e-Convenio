# Sistema de Gestão de Estágios e Convênios

Sistema web desenvolvido como projeto prático para o relatório final de estágio. A aplicação foi concebida para centralizar e automatizar o controle operacional de empresas conveniadas, alunos elegíveis e termos de compromisso (vínculos de estágio), além de fornecer um dashboard com indicadores gerenciais para o tomador de decisão.

## 🚀 Tecnologias Utilizadas

*   **Backend:** PHP 8.3
*   **Framework Web:** Laravel 13
*   **Reatividade:** Livewire (Interfaces dinâmicas sem a necessidade de SPA separada)
*   **Frontend & Design Responsivo:** Tailwind CSS
*   **Banco de Dados:** MySQL
*   **Ambiente de Desenvolvimento:** Laragon / PHP CLI Server

## 📋 Pré-requisitos

Antes de iniciar a instalação, certifique-se de ter instalado em sua máquina:

*   **PHP 8.3** ou superior
*   **Composer** (Gerenciador de dependências do PHP)
*   **MySQL** (ou servidor local como Laragon/XAMPP)
*   **Node.js & NPM** (Para compilar os assets do Tailwind CSS)

---

## 🔧 Instalação e Configuração

Siga os passos abaixo para clonar e configurar o projeto em seu ambiente local:

### 1. Clonar o Repositório
```bash
git clone [https://github.com/seu-usuario/nome-do-repositorio.git](https://github.com/seu-usuario/nome-do-repositorio.git)
cd nome-do-repositorio
```

### 2. Instalar as Dependências do PHP
```bash
composer install
```

### 3. Instalar as Dependências do Frontend
```bash
npm install
```

### 4. Configurar o Arquivo de Ambiente (.env)

Copie o arquivo de exemplo .env.example para criar o seu .env:

```bash
cp .env.example .env
```

Abra o arquivo .env criado na raiz do projeto e ajuste as configurações do seu banco de dados local e os parâmetros de segurança do motor criptográfico:

```bash
Ini, TOML
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=estagios_convenios
DB_USERNAME=seu_usuario_mysql
DB_PASSWORD=sua_senha_mysql

# Configuração de Segurança Máxima (Motor Argon2id)
HASH_DRIVER=argon2id
ARGON_MEMORY=65536
ARGON_THREADS=2
ARGON_TIME=4
```

### 5. Gerar a Chave da Aplicação

```bash
php artisan key:generate
```

### 6. Executar as Migrations (Criar as Tabelas no Banco)

Certifique-se de que o seu servidor MySQL está ativo e que o banco de dados especificado em DB_DATABASE já foi criado. Em seguida, rode:

```bash
php artisan migrate
```

## Como Rodar a Aplicação

Com tudo configurado, você precisará de dois terminais rodando simultaneamente para executar o servidor backend e o compilador do frontend:

Terminal 1: Servidor Backend (Laravel) 

```bash
php artisan serve
```

O sistema estará disponível em: http://localhost:8000

Terminal 2: Compilador de Estilos (Tailwind CSS)

```bash
npm run dev
```
