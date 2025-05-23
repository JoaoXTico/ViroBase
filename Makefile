instalarDependencias:
	@composer require vlucas/phpdotenv
	read -p "Digite a senha do banco de dados: " senha
	@echo "DB_SENHA=${senha}" > .env