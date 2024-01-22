DROP TABLE IF EXISTS `entradassalidas`;

CREATE TABLE `entradassalidas` (
  `idequipoEntradasSalidas` int NOT NULL,
  `nombreEquipo` varchar(45) NOT NULL,
  `categoria` varchar(45) NOT NULL,
  `departamento` varchar(45) NOT NULL,
  `descripción` varchar(255) NOT NULL,
  `asignado` varchar(45) NOT NULL,
  `filial` varchar(45) NOT NULL,
  `fotoEntrada` varchar(255) NOT NULL,
  `fotoSalida` varchar(255) NOT NULL,
  `fotoEquipo` varchar(255) NOT NULL,
  PRIMARY KEY (`idequipoEntradaSalidas`)
)
