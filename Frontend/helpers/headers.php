<?php
/**********************************************************
 * Package: ${PACKAGE_NAME}
 * Project: Admin-Portal-v2
 * File: headers.php
 * Author: Diego <20026893@tafe.wa.edu.au>
 * Date: 2020-06-26
 * Version: 1.0.0
 * Description: add short description of file's purpose
 **********************************************************/

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/constants.php';

/**
 * @param string $method One of: 'GET', 'POST', 'PUT', 'DELETE'
 *
 * @param  array|null  $data Data sent in the request body. It's an associative array that follows the naming convention established by the API (PascalCase).
 * Example:
 *
 * $method = 'POST' and $data =
 * [
 *  'Id' => 1,
 *  'UserName' => 'user',
 *  'UserPassword' => 'password',
 *  'UserEmail' => 'user@mail.com',
 *  'FirstName' => 'user',
 *  'LastName' => 'user again',
 *  'UserRole => 'developer'
 * ]
 *
 * @return array[] Request headers
 */
function generateHeaders(string $method, array $data = null) {
    $protocol = 'http://';
    // haxx to check whether the application is running under HTTPS or HTTP
    if (isset($_SERVER['HTTPS']) &&
        ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
        $protocol = 'https://';
    }

    if (isset($data)) {
        return array(
            'http' => array(
                'method' => $method,
                'content' => json_encode($data),
                'origin' => $protocol.$_SERVER["HTTP_HOST"],
                'header' => "Accept-language: en\r\n".
                    "Cookie: auth=".$_COOKIE['auth']."\r\n".
                    "Content-Type: application/json\r\n"
            )
        );
    }

    return array(
        'http' => array(
            'method' => $method,
            'origin' => $protocol.$_SERVER["HTTP_HOST"],
            'header' => "Accept-language: en\r\n".
                "Cookie: auth=".$_COOKIE['auth']."\r\n"
        )
    );
}

