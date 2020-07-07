-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-07-2020 a las 22:52:00
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_radio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `columnista`
--

CREATE TABLE `columnista` (
  `id_columnista` int(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `profesion` varchar(100) NOT NULL,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `columnista`
--

INSERT INTO `columnista` (`id_columnista`, `nombre`, `profesion`, `descripcion`) VALUES
(6, 'Felipe Pigna', 'Historiador', 'Historias de nuestra historia'),
(7, 'Alejandro Dolina', 'Humorista', 'La venganza será terrible'),
(8, 'Gabriel Rolón', 'Psicólogo', 'Palabra Plena'),
(9, 'Paulina Cocina', 'Cocinera', 'Receta en 30 minutos'),
(10, 'Darío Sztajnszrajber', 'Filósofo', 'Pienso luego existo'),
(11, 'Eduardo Sacheri', 'Escritor', 'Libros que nos gustan'),
(30, 'Susana Horia', 'Cheff', 'Saladito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `podcast`
--

CREATE TABLE `podcast` (
  `id_podcast` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `url_audio` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `duracion` int(10) NOT NULL,
  `tag` varchar(30) DEFAULT NULL,
  `invitado` varchar(20) DEFAULT NULL,
  `id_columnista_fk` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `podcast`
--

INSERT INTO `podcast` (`id_podcast`, `nombre`, `descripcion`, `url_audio`, `fecha`, `duracion`, `tag`, `invitado`, `id_columnista_fk`) VALUES
(2, 'Las llamas del amor', 'Los efectos de la pasión, ese encendido permanente, que ilumina nuestra vida pero a veces puede arder demasiado. ¿Cómo controlar esas llamas al punto justo?', 'audio/las-llamas-del-amor.ogg', '2020-03-24', 10, 'amor', NULL, 8),
(3, 'Sufrir con dignidad', '¿Se puede ser digno en el sufrimiento? Gabriel habla sobre las fortalezas que tienen que resurgir en momentos de fragilidad. ¿Por qué no ser querido nos vuelve vulnerables?', 'audio/sufrir-con-dignidad.ogg', '2020-03-31', 9, 'sufrimiento', NULL, 8),
(4, 'La felicidad', 'El lugar al que todos queremos llegar, y cuando lo conseguimos, no nos queremos ir. ¿Podemos concebir a la felicidad como algo finito sin entrar en la desesperación? ¿Puede ser un proceso más que una meta?', 'audio/la-felicidad.ogg', '2020-04-07', 10, 'felicidad', NULL, 8),
(5, 'El duelo', 'Soltar es una palabra que se escucha en boca de todos. La idea de desprendernos de los que nos angustia es tentadora, pero ¿sopesamos nuestras ausencias? El duelo se trata de eso.', 'audio/el-duelo.ogg', '2020-04-14', 10, 'dolor', NULL, 8),
(6, '“Endeudar y Fugar”, el libro de Pablo Manzanelli sobre la deuda argentina', 'Felipe Pigna conversa con Pablo Manzanelli, Doctor en Ciencias Sociales por la UBA, Magíster en Economía Política de FLACSO y Licenciado en Sociología de la UBA. Además es Investigador y Profesor del Área de Economía y Tecnología de la FLACSO. Juntos analizan el origen y los vaivenes de la deuda externa argentina.', 'audio/historias-6.ogg', '2020-05-05', 54, 'endeudamiento', 'Pablo Manzanelli', 6),
(7, 'Un análisis profundo que advierte sobre el “renacimiento” del fascismo', 'En diálogo con Historias de nuestra historia, el investigador y escritor, Daniel Feierstein, presentó su nuevo libro “La construcción del enano fascista: los usos del odio como estrategia política en Argentina“, que analiza y advierte por los atisbos del fascismo en nuestro país.', 'audio/historias-5.ogg', '2020-04-28', 55, 'fascismo', 'Daniel Feierstein', 6),
(8, 'Felipe Pigna, Pedro Saborido y Una historia del peronismo', 'Felipe Pigna recibe a Pedro Saborido quien arranca la charla contando que para peronizar la pandemia “se debe pensar en lo comunitario, en lo social y en la forma de ayudar al prójimo”. Luego la charla pasará por varios temas, siempre relacionados con el peronismo.', 'audio/historias-4.ogg', '2020-04-21', 55, 'peronismo', 'Pedro Saborido', 6),
(9, 'Las teorías conspirativas, desde JFK-hasta el COVID-19', 'Felipe Pigna conversa con Atilio Borón un sociólogo, politólogo, catedrático y escritor argentino; Doctorado en Ciencia Política por la Universidad de Harvard, Profesor de la Universidad de Buenos Aires e investigador del CONICET.', 'audio/historias-3.ogg', '2020-04-21', 54, 'conspiraciones', 'Atilio Borón', 6),
(10, 'La historia de las pandemias', 'Felipe Pigna nos contó la historia de las pandemias más recordadas. “La pandemia se extiende a toda la población, hubo muchas a lo largo de la historia. Una de las más  famosas es la plaga de Atenas , en el segundo año de la Guerra del Peloponeso. Se llevó más de 15 mil personas y también a Pericles aquel estratega. Esta peste entró por el puerto que estaba en contacto con medio oriente y Europa”, recordó Pigna.', 'audio/historias-2.ogg', '2020-04-07', 52, 'pandemia', NULL, 6),
(11, 'La historia y el origen del sistema judicial', 'Felipe Pigna conversó con el fiscal federal Federico Delgado sobre la historia y el origen del sistema judicial. También nos contó a qué se dedica un fiscal. “En Argentina tenemos una constitución que mira a Estados Unidos y los códigos civil y penal están mirando a Francia. El modelo francés supone que la ley es el juez.”, sostuvo el fiscal Federico Delgado.', 'audio/historias-1.ogg', '2020-03-31', 56, 'sistema judicial', 'Federico Delgado', 6),
(12, 'Leonardo Da Vinci y el caballo de los Sforza', 'Leonardo trabajó durante 12 años en una estatua ecuestre de bronce, con la figura del padre de su mecenas Ludovico Sforza. Alejando Dolina relata la historia de esta estatua, de mas de 7 metros de altura.', 'audio/dolina-sforza.ogg', '2020-05-09', 33, 'Sforza', NULL, 7),
(13, 'La hermana de Moctezuma', 'Papantzin, hermana de Moctezuma que, según la tradición, en un trance entre la vida y la muerte tuvo la visión del fin del imperio Azteca y la llegada de los españoles.La tradición azteca recoge en su historia que Papantzin, señora de Tula y hermana de Moctezuma, murió 4 días y resucitó.', 'audio/dolina-moctezuma.ogg', '2020-05-02', 16, 'Moctezuma', NULL, 7),
(14, 'María Antonieta', 'Una de las historias de María Antonieta en 1793, mientras permanecía presa junto a Luis XVI tras la fallida fuga de Varennes.', 'audio/dolina-MariaAntonieta.ogg', '2020-04-25', 25, 'María Antonieta', NULL, 7),
(15, 'Francis Drake', 'El más famoso pirata inglés, héroe en su país y demonio para los españoles a los que saqueó sin misericordia en el siglo XVI, nació en Tavistock, Devon, en una familia de granjeros protestantes. A los 13 años, Francis Drake zarpó a la mar en un carguero en el que aprendió a navegar y fue ascendiendo hasta convertirse en capitán con sólo 20 años.', 'audio/dolina-FrancisDrake.ogg', '2020-04-18', 19, 'Francis Drake', NULL, 7),
(16, 'Dostoievski y la ruleta', 'El escritor ruso Fiódor Dostoievski descubrió en los balnearios europeos el placer de la ruleta. El juego le atrapó y con esta obsesión recorrió las ciudades termales preso de su adicción, un vicio que le llevó a la ruina y que él reflejó en su novela \"El jugador\"', 'audio/dolina-dostoievskiy.ogg', '2020-04-11', 11, 'Dostoievski', NULL, 7),
(17, 'El origen de las cruzadas', 'Las cruzadas fueron un grupo de campañas militares y religiosas impulsadas por el cristianismo, llevadas a cabo entre los años 1096 y 1291, con el objetivo de recuperar territorios y unir a los pueblos bajo la misma religión. Estas fueron impulsadas principalmente por el papa Urbano II.', 'audio/dolina-cruzadas.ogg', '2020-04-04', 15, 'Cruzadas', NULL, 7),
(18, 'Brownie en cuatro pasos', 'El chocolate de ser una de las mejores cosas que existen, te inyecta una cantidad increíble de endorfinas cuando lo comes. ¿Y alguien me puede explicar una sensación mejor que cuando se te derrite en la boca? ¡No! ¡Porque no la hay, loco! no la hay. Bueno, me descontrolé.', 'audio/paulina-brownie.ogg', '2020-05-10', 7, 'Brownie', '', 6),
(19, 'Medialunas de manteca bien argentinas', 'Las medialunas son parte de las facturas argentinas, tal vez la mas tradicionales, paso a paso yo hago las medialunas dulces fáciles. Típicas para el desayuno, merienda, para tomar con el mate, en la hora del té o en un día de lluvia.', 'audio/paulina-medialunas.ogg', '2020-04-30', 12, 'medialunas', NULL, 9),
(20, 'Postre de vainillas y dulce de leche', 'Para los amantes vagos de los postres, tenemos un postre que es tan fácil que lo podés hacer en un ratito que tengas libre. Y te queda ahí en la heladera, esperándote para darte mucho amor en forma de vainillas. Es esos postres que te saludan cuando abrís la puerta del freezer como un perro que espera que llegues a casa.', 'audio/paulina-postreVainillas.ogg', '2020-04-25', 10, 'Vainillas', NULL, 9),
(21, 'Tarta de frutillas:¡Divina y riquísima!', 'Bienvenidos a Paulina Cocina! Hoy tenemos una tarta de frutillas que se van a volver recontra locos! Esta es una de las primeras tartas que hice en mi juventud, un octubre para el cumpleaños de mi hermano. Obvio que me quería levantar a un amigo (o a un par la verdad) y se me ocurrió que con esta tarta de frutillas iba a ganar un par de puntos. Si, también es la tarta favorita de mi hermano, pero eso no es lo importante.', 'audio/paulina-tartaFrutillas.ogg', '2020-04-20', 11, 'Frutillas', NULL, 9),
(22, 'La fiesta del Chivo - Mario Vargas Llosa', 'El libro tiene lugar en República Dominicana y se centra en el asesinato del dictador Rafael Trujillo, y los hechos posteriores, desde dos puntos de vista con una diferencia generacional: durante la planificación y después del asesinato en sí mismo, en mayo de 1961; y treinta y cinco años después, en 1996.', 'audio/sacheri-laFiesta.ogg', '2020-05-08', 3, 'Mario Vargas LLosa', NULL, 11),
(23, 'El túnel - Ernesto Sábato', 'Una novela corta argentina en la cual Juan Pablo Castel, personaje principal y narrador, cuenta desde la cárcel los motivos que lo llevaron a cometer un asesinato contra su amante María Iribarne.', 'audio/sacheri-elTunel.ogg', '2020-05-04', 2, 'Ernesto Sábato', NULL, 11),
(24, 'Cuarteles de Invierno - Osvaldo Soriano', 'La historia transcurre en Colonia Vela, un pequeño pueblo provinciano argentino de ficción, durante la dictadura militar. Comienza cuando Andrés Galván, un cantor de tangos en decadencia y narrador de la historia, y Tony Rocha, un boxeador olvidado, se conocen en la estación de tren del pueblo y se hacen amigos.', 'audio/sacheri-cuarteles.ogg', '2020-04-10', 2, 'Osvaldo Soriano', NULL, 11),
(26, 'Libertad y ambiguedad', 'Estoy convencido que el fituro está en la ambigüedad. En ambigüar, en disolver esos lugares supuestamentes tan estructurantes. Estamos entre la tensión del pensar y ser pensado; y en un respiro de ésta encontramos la libertad.', 'audio/sztajnszrajber-libertad.ogg', '2020-04-17', 1, 'Libertad', NULL, 10),
(27, '¿Por que el Ser y no más bien la Nada?', 'Continuamos con el desarrollo de la filosofía presocrática, desarrollando el momento del pensamiento antes de Sócrates y Aristóteles. Hablaremos de Tales, Anaxímenes y Pitágoras, entre otros', 'audio/sztajnszrajber-elSerYLaNada.ogg', '2020-05-09', 11, 'Filosofía Presocrática', NULL, 10),
(28, 'El origen de la filosofía', 'Vamos a tratar de ver el origen de la filosofía, la analizaremos etimologícamente, y a partir de ahí, un ejercicio continuo de preguntas incesante.', 'audio/sztajnszrajber-origen.ogg', '2020-05-08', 11, 'Filosofía', NULL, 10),
(29, 'Los filósofos presocráticos', 'Observamos el perfil de los primeros pensadores, como Tales de Mileto, con la filosofía aún relacionada con el mito. Describiremos sus características que forjaron sun identidad.', 'audio/sztajnszrajber-presocratico.ogg', '2020-05-07', 10, 'Filosofía Presocrática', NULL, 10),
(35, 'lksmfvls', 'lsldmfsdm', 'audio/5efb88a8748906.26334182.ogg', '2020-06-03', 10, 'djfgldjfl', '', 6),
(36, 'asdasd', 'asdasdasdad', 'audio/5f04c92b5373a8.51969141.ogg', '2020-07-07', 1, 'adsdas', 'adasd', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `admin`, `token`) VALUES
(1, 'Admin', 'admin1@admin.com', '$2y$10$1lwD7kKtOZKKRLLv.EbLseMhfQqfdkU7nCiCcAl5OjcBPoRwB33WK', 1, NULL),
(2, 'User', 'user1@user.com', '$2y$10$nBROcHG6T2ac7CIZlVZ0iOkruCeOPjv3.NWOOMlO.MuNgGsPbVrGO', 0, NULL),
(8, 'Amadeo', 'amadeosou@gmail.com', '$2y$10$8yVahpu0sq7PWcD.wA6pmepgYP0KFsSngzGC9W3gPb.IkGR9dSq9e', 0, NULL),
(9, 'Mauricio', 'moruezabal@gmail.com', '$2y$10$Lywgzd6.rODsWWeJUoJJye6z6v1JT3tfjzm3NdAFUkBzOuV2r0ZiC', 1, NULL),
(10, 'Iván', 'ivannoble@gmail.com', '$2y$10$.GXQfa7laAUb5uxHzFDXneMa2RkFa2yBUf82er8wtDNuVpiLnT3sa', 0, NULL),
(14, 'Loli', 'loli@gmail.com', '$2y$10$Dn1S4LowpUO/H5I40Eid9.dRxXOO3NUx2BDw0yAn0hpjOFSv30kPm', 1, NULL),
(15, 'Julian', 'julian@gmail.com', '$2y$10$3AYm4SsLlRsk/jEuPKC1gOewh5NgCb8YGJglPfgN5jdIo7EMWT.Rm', 0, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `columnista`
--
ALTER TABLE `columnista`
  ADD PRIMARY KEY (`id_columnista`);

--
-- Indices de la tabla `podcast`
--
ALTER TABLE `podcast`
  ADD PRIMARY KEY (`id_podcast`),
  ADD KEY `id_columnista_fk` (`id_columnista_fk`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `columnista`
--
ALTER TABLE `columnista`
  MODIFY `id_columnista` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `podcast`
--
ALTER TABLE `podcast`
  MODIFY `id_podcast` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `podcast`
--
ALTER TABLE `podcast`
  ADD CONSTRAINT `id_columinst_fk-id_columnist` FOREIGN KEY (`id_columnista_fk`) REFERENCES `columnista` (`id_columnista`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
