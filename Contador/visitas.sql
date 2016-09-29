-- phpMyAdmin SQL Dump
-- version 2.10.0.2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 12-09-2007 a las 17:09:59
-- Versión del servidor: 4.0.26
-- Versión de PHP: 5.0.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `iconosis_prueba`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `visitas`
-- 

CREATE TABLE `visitas` (
  `fecha` char(10) NOT NULL default '',
  `hoy` int(4) NOT NULL default '0',
  `totales` int(7) NOT NULL default '0',
  `impresiones` int(9) NOT NULL default '0'
) TYPE=MyISAM;

-- 
-- Volcar la base de datos para la tabla `visitas`
-- 

INSERT INTO `visitas` (`fecha`, `hoy`, `totales`, `impresiones`) VALUES 
('2007-09-12', 1, 168, 843);
