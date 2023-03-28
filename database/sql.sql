CREATE DATABASE  IF NOT EXISTS `template` ;
USE `template`;
-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: localhost    Database: template
-- ------------------------------------------------------
-- Server version	5.6.25-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacora` (
  `id_bitacora` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_hora` datetime DEFAULT NULL,
  `ip` varchar(80) DEFAULT NULL,
  `accion` varchar(80) DEFAULT NULL,
  `tabla` varchar(80) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_bitacora`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gu_menu`
--

DROP TABLE IF EXISTS `gu_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gu_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(45) DEFAULT NULL,
  `icono` varchar(350) DEFAULT NULL,
  `movil` int(11) DEFAULT '0',
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ;

--
-- Dumping data for table `gu_menu`
--

LOCK TABLES `gu_menu` WRITE;
INSERT INTO `gu_menu` VALUES (1,'Sistema','fa fa-cogs',0,1),(3,'Bitacora','fa fa-database',0,6),(20,'Catalogo','fa fa-book',0,7),(21,'Items','fa fa-clipboard',0,8),(22,'Ofertas','fa fa-coffee',0,9),(23,'Cotizaciones','fa fa-clone',0,10),(25,'Bodega','fa fa-bold',0,3),(26,'Reportes','fa fa-bell',0,5),(27,'Informes','fa fa-archive',0,4),(28,'Proyectos','fa fa-clipboard',0,2);
UNLOCK TABLES;

--
-- Table structure for table `gu_opcion`
--

DROP TABLE IF EXISTS `gu_opcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gu_opcion` (
  `id_opcion` int(11) NOT NULL AUTO_INCREMENT,
  `opcion` varchar(65) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `id_menu` int(11) NOT NULL,
  PRIMARY KEY (`id_opcion`),
  KEY `id_menu` (`id_menu`),
  CONSTRAINT `gu_opcion_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `gu_menu` (`id_menu`)
) ;

--
-- Dumping data for table `gu_opcion`
--

LOCK TABLES `gu_opcion` WRITE;

INSERT INTO `gu_opcion` VALUES (2,'Permisos','permissions_roles',1),(318,'Usuarios','users',1),(321,'Sesiones','log_of_session',3),(322,'Acciones','log_of_actions',3),(334,'Menu','menu',1),(336,'Opciones','options_menu',1),(397,'Tema','tema',1),(409,'Ordenar Modulos','orden',1),(422,'Pantallas','pantallas',1);

UNLOCK TABLES;

--
-- Table structure for table `gu_rol`
--

DROP TABLE IF EXISTS `gu_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gu_rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(45) DEFAULT NULL,
  `id_permiso` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rol`),
  KEY `id_permiso` (`id_permiso`),
  CONSTRAINT `gu_rol_ibfk_1` FOREIGN KEY (`id_permiso`) REFERENCES `permiso_url` (`id_permiso`)
) ;

--
-- Dumping data for table `gu_rol`
--

LOCK TABLES `gu_rol` WRITE;

INSERT INTO `gu_rol` VALUES (1,'admin',1),(2,'Comun',NULL),(3,'admin2',NULL),(4,'lector',NULL),(5,'Roni',NULL),(6,'Liliana',2);

UNLOCK TABLES;

--
-- Table structure for table `gu_rol_menu`
--

DROP TABLE IF EXISTS `gu_rol_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gu_rol_menu` (
  `id_rol` int(11) NOT NULL,
  `id_opcion` int(11) NOT NULL,
  `acceso` tinyint(1) DEFAULT NULL,
  `agregar` tinyint(1) DEFAULT NULL,
  `modificar` tinyint(1) DEFAULT NULL,
  `eliminar` tinyint(1) DEFAULT NULL,
  KEY `id_rol` (`id_rol`),
  KEY `id_opcion` (`id_opcion`),
  CONSTRAINT `gu_rol_menu_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `gu_rol` (`id_rol`),
  CONSTRAINT `gu_rol_menu_ibfk_2` FOREIGN KEY (`id_opcion`) REFERENCES `gu_opcion` (`id_opcion`)
) ;

--
-- Dumping data for table `gu_rol_menu`
--

LOCK TABLES `gu_rol_menu` WRITE;

INSERT INTO `gu_rol_menu` VALUES (1,2,NULL,NULL,NULL,NULL),(1,318,NULL,NULL,NULL,NULL),(1,321,NULL,NULL,NULL,NULL),(1,322,NULL,NULL,NULL,NULL),(1,334,NULL,NULL,NULL,NULL),(1,336,NULL,NULL,NULL,NULL),(1,397,NULL,NULL,NULL,NULL),(1,409,NULL,NULL,NULL,NULL),(1,422,NULL,NULL,NULL,NULL);

UNLOCK TABLES;

--
-- Table structure for table `permiso_url`
--

DROP TABLE IF EXISTS `permiso_url`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permiso_url` (
  `id_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `url_permiso` varchar(200) DEFAULT NULL,
  `nombre_permiso` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_permiso`)
) ;

--
-- Dumping data for table `permiso_url`
--

LOCK TABLES `permiso_url` WRITE;

INSERT INTO `permiso_url` VALUES (1,'View_administrador','Administradores'),(2,'View_oferta','Cobros'),(3,'View_bodega','Bodega'),(4,'View_stock','bodega stock');

UNLOCK TABLES;

--
-- Table structure for table `sesiones`
--

DROP TABLE IF EXISTS `sesiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sesiones` (
  `id_sesion` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `salida` varchar(25) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id_sesion`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `sesiones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ;

--
-- Dumping data for table `sesiones`
--

LOCK TABLES `sesiones` WRITE;
INSERT INTO `sesiones` VALUES (1590,'SISTEMAS',371,'ADMINISTRADOR','2021-02-08 11:11:22','2021-02-08 11:13:53',1);
UNLOCK TABLES;

--
-- Table structure for table `tbl_tema`
--

DROP TABLE IF EXISTS `tbl_tema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tema` (
  `id_tema` int(11) NOT NULL AUTO_INCREMENT,
  `barra_superior_1` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'black',
  `barra_superior_2` varchar(100) COLLATE utf8_unicode_ci DEFAULT '#0C1D3A',
  `foto_banner` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_usuario` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barra_inferior_1` varchar(100) COLLATE utf8_unicode_ci DEFAULT '#0E4AA5',
  `barra_inferior_2` varchar(100) COLLATE utf8_unicode_ci DEFAULT '#0C1D3A',
  `encabezado_tabla` varchar(100) COLLATE utf8_unicode_ci DEFAULT '#00BCD4',
  `encabezado_modal` varchar(100) COLLATE utf8_unicode_ci DEFAULT '#00BCD4',
  `tema` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'teal',
  `id_usuario` int(11) DEFAULT NULL,
  `texto_barra_superior` varchar(45) COLLATE utf8_unicode_ci DEFAULT '#fff',
  `texto_barra_inferior` varchar(45) COLLATE utf8_unicode_ci DEFAULT '#fff',
  `texto_modal` varchar(45) COLLATE utf8_unicode_ci DEFAULT '#fff',
  `texto_tabla` varchar(45) COLLATE utf8_unicode_ci DEFAULT '#fff',
  PRIMARY KEY (`id_tema`),
  KEY `id_usuario` (`id_usuario`)
);

--
-- Dumping data for table `tbl_tema`
--

LOCK TABLES `tbl_tema` WRITE;
INSERT INTO `tbl_tema` VALUES (1,'#000000','#103c63','1156648641.png','','#153b69','#000000','#324b6c','#000000','indigo',371,'#fff','#fff','#fff','#ffffff'),(2,'black','#0C1D3A','1334876789.jpg','','#0E4AA5','#0C1D3A','#003c6c','#040a1a','indigo',381,'#fff','#fff','#bdcbff','#fff'),(3,'#574eba','#288f8f','966183780.jpg','1836537042.png','#7a4b82','#46517a','#00BCD4','#00BCD4','light-blue',382,'#fff','#fff','#fff','#fff'),(4,'black','#0C1D3A',NULL,NULL,'#0E4AA5','#0C1D3A','#00BCD4','#00BCD4','teal',383,'#fff','#fff','#fff','#fff'),(5,'black','#0C1D3A','1852596369.jpg','','#0E4AA5','#0C1D3A','#00BCD4','#00BCD4','teal',384,'#fff','#fff','#fff','#fff'),(6,'black','#0C1D3A',NULL,NULL,'#0E4AA5','#0C1D3A','#00BCD4','#00BCD4','teal',385,'#fff','#fff','#fff','#fff'),(7,'rgba(0,0,0,0.99)','#0f1414','1218226549.jpeg','1755447378.png','#191b1f','#0C1D3A','#00BCD4','#00BCD4','teal',386,'#0930ea','#fff','#fff','#fff'),(8,'#0097ff','#224f9b','2098585117.jpeg','','#0E4AA5','#0C1D3A','#00BCD4','#00BCD4','teal',387,'#ffffff','#fff','#fff','#fff'),(9,'black','#0c3a16','1432891507.jpg','','#113921','#000000','#032c0a','#11331f','teal',858,'#fff','#fff','#fff','#fff');

UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) CHARACTER SET latin1 NOT NULL,
  `clave` varchar(60) CHARACTER SET latin1 NOT NULL,
  `id_rol` int(11) NOT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `nombre_completo` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `estado` int(11) DEFAULT '0',
  PRIMARY KEY (`id_usuario`),
  KEY `fk_usuarios_gu_rol1` (`id_rol`),
  CONSTRAINT `fk_usuarios_gu_rol1` FOREIGN KEY (`id_rol`) REFERENCES `gu_rol` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;

INSERT INTO `usuarios` VALUES (371,'admin@admin.com','827ccb0eea8a706c4c34a16891f84e7b',1,'2019-06-10 16:26:55','ADMINISTRADOR',1);

UNLOCK TABLES;

--
-- Dumping events for database 'template'
--

--
-- Dumping routines for database 'template'


-- Dump completed on 2021-02-08 11:15:58
