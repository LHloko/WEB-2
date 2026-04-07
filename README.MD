# 🚗 Sistema de Gerenciamento de Estacionamento

## 📌 Visão Geral

Esta aplicação web tem como objetivo gerenciar o fluxo de veículos em um estacionamento, controlando:

* Cadastro de veículos
* Ocupação de vagas
* Registro de entrada e saída
* Estado atual do estacionamento

O sistema foi desenvolvido utilizando:

* **PHP (procedural + PDO)**
* **MySQL (banco relacional)**
* **Apache (servidor web)**

---

## 🧱 Estrutura do Banco de Dados

O banco é composto por **3 tabelas principais**:

```text
veiculo → movimentacao → vaga
```

A tabela `movimentacao` atua como **tabela central**, conectando veículos às vagas ao longo do tempo.

---

## 📊 Tabela: `veiculo`

Armazena os veículos cadastrados no sistema.

### 🔹 Estrutura

| Campo  | Tipo       | Descrição                      |
| ------ | ---------- | ------------------------------ |
| id     | INT (PK)   | Identificador único do veículo |
| placa  | VARCHAR(8) | Placa do veículo (única)       |
| modelo | VARCHAR    | Modelo do veículo              |

### 🔹 Regras

* `placa` é **UNIQUE** (não pode repetir)
* Cada veículo pode ter várias movimentações ao longo do tempo

---

## 🅿️ Tabela: `vaga`

Representa as vagas físicas do estacionamento.

### 🔹 Estrutura

| Campo    | Tipo     | Descrição             |
| -------- | -------- | --------------------- |
| id       | INT (PK) | Identificador da vaga |
| num_vaga | INT      | Número da vaga        |

### 🔹 Regras

* `num_vaga` é **UNIQUE**
* As vagas são **pré-definidas** (ex: 1 a 9)

---

## 🔄 Tabela: `movimentacao`

Responsável por registrar o uso das vagas ao longo do tempo.

### 🔹 Estrutura

| Campo        | Tipo     | Descrição                              |
| ------------ | -------- | -------------------------------------- |
| id           | INT (PK) | Identificador da movimentação          |
| data_entrada | DATETIME | Momento de entrada                     |
| data_saida   | DATETIME | Momento de saída (NULL enquanto ativo) |
| id_veiculo   | INT (FK) | Referência ao veículo                  |
| id_vaga      | INT (FK) | Referência à vaga                      |

### 🔹 Regras

* `data_saida = NULL` → veículo ainda estacionado
* Cada registro representa **uma estadia**
* Relações:

  * `id_veiculo → veiculo(id)`
  * `id_vaga → vaga(id)`

---

## 🧠 Lógica do Sistema

---

## 🚗 1. Cadastro de Veículo

Fluxo:

```text
Usuário preenche formulário → store.php → INSERT em veiculo
```

Regras:

* Não permite placas duplicadas
* Caso duplicado → mensagem de erro via session

---

## 🅿️ 2. Estacionar Veículo

Fluxo completo:

```text
index.php (vaga livre)
→ clicar "Estacionar"
→ opcoes.php
→ buscar.php
→ registrar.php
```

### 🔹 Caso veículo já cadastrado:

* Busca por placa
* Se encontrado → registra movimentação

### 🔹 Caso não cadastrado:

* Redireciona para cadastro
* Após cadastro → registra automaticamente

---

## 🔄 3. Registro de Entrada

No `registrar.php`:

### ✔ Etapas:

1. Validar entrada (`vaga`, `veiculo`)
2. Verificar se vaga está ocupada:

   ```sql
   WHERE id_vaga = ? AND data_saida IS NULL
   ```
3. Se livre → inserir movimentação:

   ```sql
   INSERT INTO movimentacao (id_veiculo, id_vaga)
   ```
4. Redirecionar com mensagem de sucesso

---

## ⚠️ Regra de Negócio Principal

```text
Uma vaga NÃO pode ter mais de um veículo ao mesmo tempo
```

Implementação:

* Verificação via query antes do INSERT
* Controle feito no backend (PHP)

---

## 📊 4. Estado das Vagas

A ocupação NÃO é armazenada diretamente na tabela `vaga`.

Ela é **derivada**:

```sql
SELECT * FROM movimentacao
WHERE id_vaga = X AND data_saida IS NULL
```

### ✔ Interpretação:

* Existe registro → vaga ocupada
* Não existe → vaga livre

---

## 🔐 5. Segurança Implementada

* Uso de **PDO com prepared statements**
* Prevenção de **SQL Injection**
* Uso de `htmlspecialchars()` → proteção contra XSS
* Validação básica de entrada
* Mensagens via **session (flash messages)**

---

## 🔄 6. Fluxo de Mensagens

Sistema utiliza sessões:

```php
$_SESSION['erro']
$_SESSION['sucesso']
```

### Funcionamento:

```text
Página A define mensagem
→ redireciona
→ index.php exibe
→ mensagem é apagada
```

---

## 📁 Estrutura do Projeto

```text
estacionamento/
├── config/
│   └── conexao.php
├── includes/
│   └── mensagens.php
├── veiculos/
│   ├── create.php
│   ├── store.php
│   ├── edit.php
│   ├── update.php
│   ├── delete.php
│   └── index.php
├── estacionamento/
│   ├── opcoes.php
│   ├── buscar.php
│   └── registrar.php
├── index.php
```

---

## 🚀 Próximas Funcionalidades (Roadmap)

* Mostrar veículo na vaga (placa/modelo)
* Implementar saída (`data_saida`)
* Calcular tempo de permanência
* Interface com CSS
* Múltiplas vagas dinâmicas

---
