<?php
require __DIR__.'/../../../vendor/autoload.php';
require __DIR__.'/../../Init/init.php';

use JiraRestlib\Api\Api;
use JiraRestlib\Config\Config;
use JiraRestlib\Resources\Attachments\Attachments;
use JiraRestlib\Result\ResultAbstract;

$defaultOption = array("auth"      => array(USERNAME, PASSWORD),
                       "verify"    => SSL_VERIFICATION);

$config = new Config(JIRA_HOST);
$config->addRequestConfigArray($defaultOption);
$config->addCommonConfig(Config::RESPONSE_FORMAT, ResultAbstract::RESPONSE_FORMAT_OBJECT);

$api = new Api($config);
$attachmentResource = new Attachments();

//use an appropriate issue name or id
$issueKey = "JIR-5";

//valid filenames with path
$files = array("files/jira.jpg",
               "files/a.pdf",);

$attachmentResource->addAttachment($issueKey, $files);

$result = $api->getRequestResult($attachmentResource);

$resultObject = $result->getResponse();
$resultHeader = $result->getResponseHeaders();
$resultStatus = $result->getResponseHttpStatusCode();

print_r($resultObject);

echo PHP_EOL;
print_r("Status:".$resultStatus);

echo PHP_EOL;
print_r("Has error:".$result->hasError()); 
echo PHP_EOL;

if($result->hasError())
{
    print_r($result->getErrorMessages());
    print_r($result->getErrors());
}

echo PHP_EOL;
echo "END";
echo PHP_EOL;

echo "END";