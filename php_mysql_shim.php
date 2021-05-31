<?php
############################
### Shim mysql => mysqli ###
############################
global $mysqli_connection;

if (!defined('MYSQL_ASSOC')) define('MYSQL_ASSOC', 1);
if (!defined('MYSQL_NUM')) define('MYSQL_NUM', 2);
if (!defined('MYSQL_BOTH')) define('MYSQL_BOTH', 3);

if (!function_exists('mysql_connect'))
{
	function mysql_connect($host, $user, $pass)
	{
		global $mysqli_connection;
		$mysqli_connection = mysqli_connect($host, $user, $pass);
		return $mysqli_connection;
	}
	
	function mysql_pconnect($host, $user, $pass)
	{
		$host = 'p:' . $host;
		return mysql_connect($host, $user, $pass);
	}
}

if (!function_exists('mysql_select_db'))
{
	function mysql_select_db($db, $link=null)
	{
		global $mysqli_connection;
		$link = $link ? $link : $mysqli_connection;
		return mysqli_select_db($link, $db);
	}
	
}

if (!function_exists('mysql_query'))
{
	function mysql_query($sql, $link=null)
	{
		global $mysqli_connection;
		$link = $link ? $link : $mysqli_connection;
		return mysqli_query($link, $sql);
	}
}

if (!function_exists('mysql_fetch_row'))
{
	function mysql_fetch_row($result)
	{
		return mysqli_fetch_row($result);
	}
}

if (!function_exists('mysql_fetch_assoc'))
{
	function mysql_fetch_assoc($result)
	{
		return mysqli_fetch_assoc($result);
	}
}

if (!function_exists('mysql_fetch_array'))
{
	function mysql_fetch_array($result, $type=MYSQL_BOTH)
	{
		switch ($type)
		{
			case MYSQL_ASSOC: $type = MYSQLI_ASSOC; break;
			case MYSQL_NUM: $type = MYSQLI_NUM; break;
			case MYSQL_BOTH: $type = MYSQLI_BOTH; break;
		}
		return mysqli_fetch_array($result, $type);
	}
}

if (!function_exists('mysql_free_result'))
{
	function mysql_free_result($result)
	{
		return mysqli_free_result($result);
	}
}

if (!function_exists('mysql_num_rows'))
{
	function mysql_num_rows($result)
	{
		return mysqli_num_rows($result);
	}
}

if (!function_exists('mysql_close'))
{
	function mysql_close($link)
	{
		return mysqli_close($link);
	}
}

if (!function_exists('mysql_error'))
{
	function mysql_error($link=null)
	{
		global $mysqli_connection;
		$link = $link ? $link : $mysqli_connection;
		return mysqli_error($link);
	}
}

if (!function_exists('mysql_insert_id'))
{
	function mysql_insert_id($link=null)
	{
		global $mysqli_connection;
		$link = $link ? $link : $mysqli_connection;
		return mysqli_insert_id($link);
	}
}

if (!function_exists('mysql_num_rows'))
{
	function mysql_num_rows($result)
	{
		return mysqli_num_rows($result);
	}
}

if (!function_exists('mysql_num_fields'))
{
	function mysql_num_fields($result)
	{
		return mysqli_num_fields($result);
	}
}

if (!function_exists('mysql_fetch_field'))
{
	function mysql_fetch_field($result)
	{
		return mysqli_fetch_field($result);
	}
}

if (!function_exists('mysql_real_escape_string'))
{
	function mysql_real_escape_string($string)
	{
		return str_replace(array('\'', '"'), array('\\\'', '\\"'), $string);
	}
}


#################
### Shim ereg ###
#################
if (!function_exists('ereg'))
{
	function ereg($pattern, $subject, &$matches = array())
	{
		return preg_match('/'.$pattern.'/', $subject, $matches);
	}
	function eregi($pattern, $subject, &$matches = array())
	{
		return preg_match('/'.$pattern.'/i', $subject, $matches);
	}
	function ereg_replace($pattern, $replacement, $string)
	{
		return preg_replace('/'.$pattern.'/', $replacement, $string);
	}
	function eregi_replace($pattern, $replacement, $string)
	{
		return preg_replace('/'.$pattern.'/i', $replacement, $string);
	}
	function split($pattern, $subject, $limit = -1)
	{
		return preg_split('/'.$pattern.'/', $subject, $limit);
	}
	function spliti($pattern, $subject, $limit = -1)
	{
		return preg_split('/'.$pattern.'/i', $subject, $limit);
	}
}

####################
### Shim session ###
####################
if (!function_exists('session_unregister'))
{
	function session_unregister($key)
	{
		unset($_SESSION[$key]);
	}
	
	function session_register($key)
	{
	}
}
