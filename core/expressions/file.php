<?php

	final class QExpressions {
		const NHS_EMAIL_ADDRESS = '/^([a-z0-9_\.-]+)@nhs\.(net|uk|scot)$/';
		const EMAIL_ADDRESS = '/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/';
		const WEB_ADDRESS = '@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@';
		const TELEPHONE = '/^[0-9\.\(\)\+\-\[\] ]+$/';
		
		const ISO_2_STANDARD = '/[a-zA-Z]{2}/';
		const ISO_3_STANDARD = '/[A-Z]{3}/';
		const ISO_LOCALISATION = '/[a-z]{2}\_[A-Z]{2}/';
		
		const HEX = '/^#?([a-f0-9]{6}|[a-f0-9]{3})$/';
		const IP_ADDRESS = '/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/';
		
		const NUMERICS_ONLY = '/^[0-9]+$/';
		const ALPHA_NUMERICS_ONLY = '/^[a-zA-Z0-9]+$/';
		const ALPHA_CHARS_ONLY = '/^[a-zA-Z]+$/';
		const ALPHA_NUMERICS_WITH_SPACES = '/^[a-zA-Z0-9 ]+$/';
		const ALPHA_CHARS_WITH_SPACES = '/^[a-zA-Z ]+$/';
		
		const ALPHA_NUMERICS_WITH_SYMBOLS = '~^[a-zA-Z0-9 \'\,\@\^\?\(\)\[\]\*\+\#\"\\\/\.\&\=\|\:\%\!]+$~';
		
		const HTML_ENTITY = '/&[^\s]*;/'; 
		const HTML_TAG = '/^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$/';
		
		const UNICODE = '/[\p{N}\p{L}]+/';
		
		const SLUG = '/^[a-z0-9\-]+$/';
		const QUERY_STRING = '/\?.*$/';
		
		const CSV = '/^(application\/csv)|(text\/comma\-separated\-values)|(application\/excel)|(application\/vnd\.msexcel)|(application\/octet\-stream)|(application\/txt)|(application\/vnd\.ms\-excel)|(text\/csv)|(text\/tsv)|(text\/plain)$/';
		const MONETARY = '/[0-9\.\,]+$/';
		const DECIMAL = '/[0-9\.]+$/';
		
		const DATE_ONLY = '/^[0-9\/\-]{10}$/';
		const META_DATA = '/^[a-zA-Z0-9\, ]+$/';
		
		// banking
		const BANKING_IBAN = '[a-zA-Z]{2}[0-9]{2}[a-zA-Z0-9]{4}[0-9]{7}([a-zA-Z0-9]?){0,16}';
		const BANKING_BIC = '([a-zA-Z]{4}[a-zA-Z]{2}[a-zA-Z0-9]{2}([a-zA-Z0-9]{3})?)';
		
		const DAY = '/^[0-9]{2}$/';
		const MONTH = '/^[0-9]{2}$/';
		const YEAR = '/^(20)[0-9]{2}$/';
		const HOUR = '/^[0-9]{2}$/';
		const MINUTE = '/^[0-9]{2}$/';
		const SECOND = '/^[0-9]{2}$/';
		
		const NON_VISIBLE_CHARS = '/[\x00-\x1F\x80-\xFF]/';
		
	}
	
?>