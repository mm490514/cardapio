# Cardápio Digital - Sistema de Pedidos para Restaurantes

Este é um sistema de cardápio digital e pedidos para restaurantes, implementado em PHP. Ele permite aos clientes visualizar as categorias de itens no menu, pesquisar pratos, adicionar itens ao carrinho e fazer pedidos. O sistema é projetado para uso em um ambiente de restaurante onde os clientes podem fazer pedidos por meio de um aplicativo da web.

## Pré-requisitos

- Servidor web com suporte a PHP
- Banco de dados MySQL ou outro sistema de gerenciamento de banco de dados

Certifique-se de configurar o servidor web e o banco de dados antes de usar este sistema.

## Instalação

1. Clone ou faça o download deste repositório em seu servidor web.

2. Crie um banco de dados MySQL e importe o esquema do banco de dados usando o arquivo SQL fornecido no diretório `db`.

3. Configure as credenciais do banco de dados no arquivo `config/Database.php`.

4. Certifique-se de que o servidor web esteja configurado para servir arquivos PHP.

## Uso

1. Acesse o sistema no navegador usando o URL do servidor web.

2. Leia o QR Code exibido no restaurante para vincular-se à mesa. Ou, se você já fez isso, acesse a mesa previamente vinculada.

3. Navegue pelas categorias de itens do menu ou use a barra de pesquisa para encontrar pratos específicos.

4. Adicione itens ao carrinho e faça o pedido.

5. O sistema registrará os pedidos e os enviará para a cozinha ou área de preparo.

## Personalização

Você pode personalizar este sistema de acordo com as necessidades do seu restaurante. Alguns pontos de personalização possíveis incluem:

- Personalização do estilo e layout da interface do usuário (arquivos CSS e HTML).
- Adição de novas categorias e pratos ao menu (banco de dados).
- Implementação de integrações de pagamento.

## Contribuições

Contribuições são bem-vindas. Se você encontrar bugs ou tiver melhorias a sugerir, crie um problema ou envie um pull request.

## Autores

Matheus Mendes e Martin Almeida.

## Agradecimentos

- Agradecemos ao Luiz Miguel luizmiguelproenca por fornecer o código-base deste sistema.
