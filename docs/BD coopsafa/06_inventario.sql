DROP TABLE IF EXISTS `inventario`;

CREATE TABLE `inventario` (
  `idinventario` int NOT NULL,
  `nomEquipo` varchar(255) NOT NULL,
  `categoria` varchar(45) NOT NULL,
  `departamento` varchar(45) NOT NULL,
  `descripción` varchar(255) NOT NULL,
  `asignado` varchar(45) NOT NULL,
  `filial` varchar(45) NOT NULL,
  PRIMARY KEY (`idinventario`)
)
