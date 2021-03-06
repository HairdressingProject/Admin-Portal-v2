<?php
/**********************************************************
 * Package: ${PACKAGE_NAME}
 * Project: Admin-Portal-v2
 * File: delete.php
 * Author: Diego <20026893@tafe.wa.edu.au>
 * Date: 2020-06-26
 * Version: 1.0.0
 * Description: add short description of file's purpose
 **********************************************************/

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/utils.php';

/**
 * Delete a resource of type $resourceName with $id
 * @param string $resourceName
 * @param int|string $id
 * @return array Response from the API as an associative array
 */
function deleteResource(string $resourceName, $id) {
    $opts = generateHeaders('DELETE');
    $resourceUrl = API_URL . '/api/' . $resourceName . '/' . $id;
    return Utils::getResponse($resourceUrl, $opts);
}