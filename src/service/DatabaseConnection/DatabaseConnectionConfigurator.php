<?php

namespace App\Service\DatabaseConnection;


use App\Service\ServerVersion\ServerVersionProvider;
use App\Service\SystemInfo\SystemInfoProvider;
use App\Service\SystemInfo\UserProvider;
use App\Service\XmlFile\XmlFileManager;
use App\Utils\UuidGenerator;
use Exception;
use Psr\Log\LoggerInterface;
use SimpleXMLElement;

class DatabaseConnectionConfigurator implements DatabaseConnectionConfiguratorInterface
{
    private SystemInfoProvider $systemInfoProvider;
    private LoggerInterface $logger;
    private ServerVersionProvider $serverVersionProvider;
    private UuidGenerator $uuidGenerator;
    private XmlFileManager $xmlFileManager;
    private UserProvider $userProvider;

    public function __construct(
        SystemInfoProvider $systemInfoProvider,
        XmlFileManager $xmlFileManager,
        LoggerInterface $logger,
        ServerVersionProvider $serverVersionProvider,
        UuidGenerator $uuidGenerator,
        UserProvider $userProvider
    ) {
        $this->systemInfoProvider = $systemInfoProvider;
        $this->logger = $logger;
        $this->serverVersionProvider = $serverVersionProvider;
        $this->xmlFileManager = $xmlFileManager;
        $this->uuidGenerator = $uuidGenerator;
        $this->userProvider = $userProvider;
    }

    public function addMysqlWorkbenchConnection(
        string $connectionName,
        string $hostname,
        string $port,
        string $username,
        ?string $password,
        string $schema = ''
    ): bool {
        try {
            $connectionsFile = $this->systemInfoProvider->getConnectionsFilePath();

            $dom = $this->xmlFileManager->loadXmlFile($connectionsFile);

            // Convert DOMDocument to SimpleXMLElement
            $xmlString = $dom->saveXML();
            $xml = new SimpleXMLElement($xmlString);

            // Ensure the password is a string
            $password = $password ?? '';

            // Retrieve MySql server version
            $serverVersion = $this->serverVersionProvider->getServerVersion($hostname, $port, $username, $password);

            // Retrieve owner value
            $ownerLink = $this->getOwnerLink($xml);

            // Find the specific <value> element where new connections should be added
            $targetList = $xml->xpath("//value[@_ptr_='000001F0DCD8E7E0' and @type='list' and @content-type='object' and @content-struct-name='db.mgmt.Connection']")[0];

            if (!$targetList) {
                throw new Exception("Cannot find the target list to add the new connection.");
            }

            $newConnection = $targetList->addChild('value');
            $newConnection->addAttribute('type', 'object');
            $newConnection->addAttribute('struct-name', 'db.mgmt.Connection');
            $newConnection->addAttribute('id', '{' . $this->uuidGenerator->generateUuid() . '}');
            $newConnection->addAttribute('struct-checksum', '0x96ba47d8');

            // Add link element with attributes
            $linkElement = $newConnection->addChild('link', 'com.mysql.rdbms.mysql.driver.native');
            $linkElement->addAttribute('type', 'object');
            $linkElement->addAttribute('struct-name', 'db.mgmt.Driver');
            $linkElement->addAttribute('key', 'driver');

            // Add a new "value" element for the hostIdentifier
            $hostIdentifierElement = $newConnection->addChild('value', "Mysql@$hostname:$port");
            $hostIdentifierElement->addAttribute('type', 'string');
            $hostIdentifierElement->addAttribute('key', 'hostIdentifier');

            // Add a new child for 'isDefault'
            $isDefaultElement = $newConnection->addChild('value', '0');
            $isDefaultElement->addAttribute('type', 'int');
            $isDefaultElement->addAttribute('key', 'isDefault');

            // Add a new child for 'modules'
            $modulesElement = $newConnection->addChild('value');
            $modulesElement->addAttribute('_ptr_', '000001F0DCE69230');
            $modulesElement->addAttribute('type', 'dict');
            $modulesElement->addAttribute('key', 'modules');

            $parameterValues = $newConnection->addChild('value');
            $parameterValues->addAttribute('_ptr_', '000001F0DCE6A9D0');
            $parameterValues->addAttribute('type', 'dict');
            $parameterValues->addAttribute('key', 'parameterValues');

            $lastDefaultSchemaElement = $parameterValues->addChild('value', $schema);
            $lastDefaultSchemaElement->addAttribute('type', 'string');
            $lastDefaultSchemaElement->addAttribute('key', 'DbSqlEditor:LastDefaultSchema');

            $sqlModeElement = $parameterValues->addChild('value', '');
            $sqlModeElement->addAttribute('type', 'string');
            $sqlModeElement->addAttribute('key', 'SQL_MODE');

            $hostNameElement = $parameterValues->addChild('value', $hostname);
            $hostNameElement->addAttribute('type', 'string');
            $hostNameElement->addAttribute('key', 'hostName');

            $lastConnectedElement = $parameterValues->addChild('value', (string)time());
            $lastConnectedElement->addAttribute('type', 'int');
            $lastConnectedElement->addAttribute('key', 'lastConnected');

            $passwordElement = $parameterValues->addChild('value', $password);
            $passwordElement->addAttribute('type', 'string');
            $passwordElement->addAttribute('key', 'password');

            $portElement = $parameterValues->addChild('value', $port);
            $portElement->addAttribute('type', 'int');
            $portElement->addAttribute('key', 'port');

            $schemaElement = $parameterValues->addChild('value', $schema);
            $schemaElement->addAttribute('type', 'string');
            $schemaElement->addAttribute('key', 'schema');

            $serverVersionElement = $parameterValues->addChild('value', $serverVersion);
            $serverVersionElement->addAttribute('type', 'string');
            $serverVersionElement->addAttribute('key', 'serverVersion');

            $sslCAElement = $parameterValues->addChild('value', '');
            $sslCAElement->addAttribute('type', 'string');
            $sslCAElement->addAttribute('key', 'sslCA');

            $sslCertElement = $parameterValues->addChild('value', '');
            $sslCertElement->addAttribute('type', 'string');
            $sslCertElement->addAttribute('key', 'sslCert');

            $sslCipherElement = $parameterValues->addChild('value', '');
            $sslCipherElement->addAttribute('type', 'string');
            $sslCipherElement->addAttribute('key', 'sslCipher');

            $sslKeyElement = $parameterValues->addChild('value', '');
            $sslKeyElement->addAttribute('type', 'string');
            $sslKeyElement->addAttribute('key', 'sslKey');

            $useSSLElement = $parameterValues->addChild('value', '1');
            $useSSLElement->addAttribute('type', 'int');
            $useSSLElement->addAttribute('key', 'useSSL');

            $userNameElement = $parameterValues->addChild('value', $username);
            $userNameElement->addAttribute('type', 'string');
            $userNameElement->addAttribute('key', 'userName');

            $nameElement = $newConnection->addChild('value', $connectionName);
            $nameElement->addAttribute('type', 'string');
            $nameElement->addAttribute('key', 'name');

            $ownerElement = $newConnection->addChild('link', $ownerLink);
            $ownerElement->addAttribute('type', 'object');
            $ownerElement->addAttribute('struct-name', 'GrtObject');
            $ownerElement->addAttribute('key', 'owner');

            // Save the updated XML back to the file with proper formatting
            $dom->loadXML($xml->asXML());
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true; // Enable formatting

            $this->xmlFileManager->saveXmlFile($dom, $connectionsFile);

            $this->logger->info("Connexion '$connectionName' ajoutée avec succès.");
            return true;
        } catch (Exception $e) {
            $this->logger->error("Failed to add connection '$connectionName': " . $e->getMessage());
            return false;
        }
    }

    private function getOwnerLink(SimpleXMLElement $xml): string
    {
        foreach ($xml->xpath("//link[@key='owner']") as $link) {
            return (string) $link;
        }
        throw new Exception("Lien propriétaire introuvable dans le fichier XML");
    }
}
