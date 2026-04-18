# ONG - Implementação de CRUD (Regras de Negócio)

Atividade: **Implementação de CRUD com Regras de Negócio**

## Entidade escolhida

- **ONG**
- Atributos:
	- **CPF/CNPJ**
	- **Nome**
	- **Telefone**
	- **E-mail**
	- **Endereço**

## Requisitos atendidos

### 1) Operações CRUD

- **Cadastrar uma nova ONG**
- **Editar uma ONG existente**
- **Excluir uma ONG**
- **Listar todas as ONGs cadastradas**
- **Exibir os dados de uma ONG por identificador (id)**

### 2) Validações

- Campos obrigatórios:
	- Nome
	- CPF/CNPJ
	- Telefone
	- E-mail
	- Endereço
- Formatos/consistência:
	- **E-mail** deve ser válido
	- **CPF/CNPJ** deve conter **11 ou 14 dígitos** (após remover caracteres não numéricos)

### 3) Regra de Negócio

- **Impede cadastro duplicado** de ONG por:
	- CPF/CNPJ já existente
	- E-mail já existente
- **Impede atualização** quando o CPF/CNPJ ou e-mail informados já pertencem a **outra ONG**
- Antes de salvar/atualizar:
	- CPF/CNPJ é **normalizado** (salva apenas números)
	- E-mail é **normalizado** (trim + minúsculo)

### 4) Controle de Acesso

- **Acesso público (sem login):**
	- Listagem de ONGs
	- Visualização de detalhes de uma ONG
- **Acesso restrito (precisa estar autenticado):**
	- Cadastro
	- Edição
	- Exclusão

