CREATE TABLE contas (
  cpf VARCHAR(14) PRIMARY KEY,
  nome VARCHAR(80) NOT NULL,
  email VARCHAR(80) NOT NULL,
  senha VARCHAR(255) NOT NULL
);

CREATE TABLE manifestacoes (
  cpf VARCHAR(14),
  localContaminado VARCHAR(40),
  febre BOOLEAN,
  fadiga BOOLEAN,
  dorCorpo BOOLEAN,
  dorGarganta BOOLEAN,
  tosse BOOLEAN,
  espirros BOOLEAN,
  diarreia BOOLEAN,
  nausea BOOLEAN,
  vomitos BOOLEAN,
  dorAbdominal BOOLEAN,
  faltaApetite BOOLEAN,
  malEstar BOOLEAN,
  desidratacao BOOLEAN,

  FOREIGN KEY (cpf) REFERENCES contas(cpf)
)
