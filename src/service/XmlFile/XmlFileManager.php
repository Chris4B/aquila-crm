<?php


namespace App\Service\XmlFile;

use DOMDocument;
use Exception;
use Psr\Log\LoggerInterface;

class XmlFileManager
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function loadXmlFile(string $filePath): DOMDocument
    {
        if (!file_exists($filePath)) {
            $this->logger->error("Le fichier XML n'a pas été trouvé à l'emplacement attendu : $filePath");
            throw new Exception("Le fichier XML n'a pas été trouvé à l'emplacement attendu : $filePath");
        }
        
        if (!is_readable($filePath)) {
            throw new Exception("Le fichier XML n'a pas les permissions de lecture.");
        }

        $dom = new DOMDocument('1.0', 'utf-8');
        if (!$dom->load($filePath)) {
            $this->logger->error("Erreur lors du chargement du fichier XML");
            throw new Exception("Erreur lors du chargement du fichier XML");
        }


        return $dom;
    }

    public function saveXmlFile(DOMDocument $dom, string $filePath): bool
    {
        if (!$dom->save($filePath)) {
            $this->logger->error("Erreur lors de la sauvegarde du fichier XML");
            throw new Exception("Erreur lors de la sauvegarde du fichier XML");
        }

        $this->logger->info("Fichier XML '$filePath' sauvegardé avec succès.");
        return true;
    }
}