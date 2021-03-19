CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `login` varchar(255),
  `tipo` varchar(255),
  `password` varchar(255),
  `created_at` timestamp
);

CREATE TABLE `pacientes` (
  `id` int,
  `nome` varchar(255),
  `email` varchar(255),
  `idade` int,
  `telefone` int,
  `cpf` int,
  `endereco` varchar(255),
  `genero` ENUM ('Feminino', 'Masculino', 'Outros'),
  `infos` varchar(255)
);

CREATE TABLE `medicos` (
  `id` int,
  `nome` varchar(255),
  `email` varchar(255),
  `idade` int,
  `telefone` int,
  `crm` int,
  `endereco` varchar(255),
  `genero` ENUM ('Feminino', 'Masculino', 'Outros'),
  `infos` varchar(255)
);

CREATE TABLE `laboratorios` (
  `id` int,
  `nome` varchar(255),
  `email` varchar(255),
  `telefone` int,
  `cnpj` int,
  `endereco` varchar(255),
  `tipoexame` ENUM ('Ultrassom', 'Sangue', 'Teste'),
  `infos` varchar(255)
);

CREATE TABLE `exames` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int UNIQUE NOT NULL,
  `date` date,
  `med_id` int,
  `pac_id` int,
  `lab_id` int,
  `email` varchar(255),
  `diagnostico` varchar(255),
  `receita` varchar(255),
  `exame` varchar(255),
  `infos` varchar(255),
  `created_at` timestamp
);

CREATE TABLE `consultas` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int UNIQUE NOT NULL,
  `date` date,
  `med_id` int,
  `pac_id` int,
  `lab_id` int,
  `diagnostico` varchar(255),
  `exame` varchar(255),
  `resultados` varchar(255),
  `created_at` timestamp
);

ALTER TABLE `pacientes` ADD FOREIGN KEY (`id`) REFERENCES `users` (`id`);

ALTER TABLE `laboratorios` ADD FOREIGN KEY (`id`) REFERENCES `users` (`id`);

ALTER TABLE `medicos` ADD FOREIGN KEY (`id`) REFERENCES `users` (`id`);

ALTER TABLE `exames` ADD FOREIGN KEY (`med_id`) REFERENCES `medicos` (`id`);

ALTER TABLE `exames` ADD FOREIGN KEY (`pac_id`) REFERENCES `pacientes` (`id`);

ALTER TABLE `exames` ADD FOREIGN KEY (`lab_id`) REFERENCES `laboratorios` (`id`);

ALTER TABLE `consultas` ADD FOREIGN KEY (`med_id`) REFERENCES `medicos` (`id`);

ALTER TABLE `consultas` ADD FOREIGN KEY (`pac_id`) REFERENCES `pacientes` (`id`);

ALTER TABLE `consultas` ADD FOREIGN KEY (`lab_id`) REFERENCES `laboratorios` (`id`);