-- phpMyAdmin SQL Dump
-- version 2.10.0.2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 12-09-2007 a las 17:08:38
-- Versión del servidor: 4.0.26
-- Versión de PHP: 5.0.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `iconosis_prueba`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `visitantes_activos`
-- 

CREATE TABLE `visitantes_activos` (
  `ip` char(20) NOT NULL default '',
  `fecha` int(11) NOT NULL default '0'
) TYPE=MyISAM;

-- 
-- Volcar la base de datos para la tabla `visitantes_activos`
-- 

INSERT INTO `visitantes_activos` (`ip`, `fecha`) VALUES 
('127.0.0.1', 1189634739);
