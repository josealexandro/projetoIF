-- -----------------------------------------------------
-- Insert `biblioteca`.`autoras`
-- -----------------------------------------------------
INSERT INTO `biblioteca`.`autoras` (`cod_autora`, `nome`, `biografia`, `foto`, `data_nasc`, `data_morte`, `instagram`, `facebook`, `twitter`, `site_autora`) VALUES 
(NULL, 'Nome Autora 1', 'Biografia Autora 1', NULL, '2000-01-01', NULL, '@instagram1', '@facebook1', '@twitter1', 'http://www.autora1.com.br'),
(NULL, 'Nome Autora 2', 'Biografia Autora 2', NULL, '2000-02-02', NULL, '@instagram2', '@facebook2', '@twitter2', 'http://www.autora2.com.br'),
(NULL, 'Nome Autora 3', 'Biografia Autora 3', NULL, '2000-03-03', NULL, '@instagram3', '@facebook3', '@twitter3', 'http://www.autora3.com.br'),
(NULL, 'Nome Autora 4', 'Biografia Autora 4', NULL, '2000-04-04', NULL, '@instagram4', '@facebook4', '@twitter4', 'http://www.autora4.com.br'),
(NULL, 'Nome Autora 5', 'Biografia Autora 5', NULL, '2000-05-05', NULL, '@instagram5', '@facebook5', '@twitter5', 'http://www.autora5.com.br');


-- -----------------------------------------------------
-- Insert `biblioteca`.`editora`
-- -----------------------------------------------------
INSERT INTO `biblioteca`.`editora` (`cod_editora`, `nome`, `cidade`, `estado`, `site_editora`) VALUES 
(NULL, 'Editora 1', 'Cidade 1', 'PE', 'http://www.editora1.com.br'),
(NULL, 'Editora 2', 'Cidade 2', 'PE', 'http://www.editora2.com.br'),
(NULL, 'Editora 3', 'Cidade 3', 'PE', 'http://www.editora3.com.br'),
(NULL, 'Editora 4', 'Cidade 4', 'PE', 'http://www.editora4.com.br'),
(NULL, 'Editora 5', 'Cidade 5', 'PE', 'http://www.editora5.com.br');


-- -----------------------------------------------------
-- Insert `biblioteca`.`tipo_obra`
-- -----------------------------------------------------
INSERT INTO `biblioteca`.`tipo_obra` (`cod_tipo`, `descricao`) VALUES 
(NULL, 'Tipo 1'),
(NULL, 'Tipo 2'),
(NULL, 'Tipo 3'),
(NULL, 'Tipo 4'),
(NULL, 'Tipo 5');


-- -----------------------------------------------------
-- Insert `biblioteca`.`obras`
-- -----------------------------------------------------
INSERT INTO `biblioteca`.`obras` (`cod_obra`, `titulo`, `resumo`, `ano`, `capa`, `url`, `autora_obra`, `tipo_obra`, `editora_obra`) VALUES 
(NULL, 'Título Obra 1', 'Resumo Obra 1', 2011, NULL, 'http://www.obra1.com.br', 2, 3, 4),
(NULL, 'Título Obra 2', 'Resumo Obra 2', 2012, NULL, 'http://www.obra2.com.br', 3, 4, 5),
(NULL, 'Título Obra 3', 'Resumo Obra 3', 2013, NULL, 'http://www.obra3.com.br', 4, 5, 1),
(NULL, 'Título Obra 4', 'Resumo Obra 4', 2014, NULL, 'http://www.obra4.com.br', 5, 1, 2),
(NULL, 'Título Obra 5', 'Resumo Obra 5', 2015, NULL, 'http://www.obra5.com.br', 1, 2, 3);


-- -----------------------------------------------------
-- Insert `biblioteca`.`perfil`
-- -----------------------------------------------------
INSERT INTO `biblioteca`.`perfil` (`cod_perfil`, `descricao`) VALUES 
(NULL, 'Perfil 1'),
(NULL, 'Perfil 2'),
(NULL, 'Perfil 3'),
(NULL, 'Perfil 4'),
(NULL, 'Perfil 5');


-- -----------------------------------------------------
-- Insert `biblioteca`.`usuarios`
-- -----------------------------------------------------
INSERT INTO `biblioteca`.`usuarios` (`cod_usuario`, `nome`, `email`, `senha`, `perfil_usuario`) VALUES 
(NULL, 'admin', 'admin@biblioteca.com', '$2y$10$glTO5UgTBfqY/XS4n0sx8eIHR3VjMMs40/B0U0eOqbsBOt7jr1Gp2', 1), -- p@$$w0rd
(NULL, 'teste', 'teste@biblioteca.com', '$2y$10$7z/m9hKik1ttzCA.OD5Gou.sBUdqvC438vTr0e4.BgaKLkbbkhMnu', 1); -- 123456