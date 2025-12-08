<?php
namespace Models;
require "JournalModel.php";
class VolumeModel {
    private $db;

    public function __construct(\Models\Database $db) {
        $this->db = $db;
    }

    /**
     * Dans cette approche, nous considérons que la table "revues" 
     * représente en fait des volumes, et chaque volume peut avoir 
     * plusieurs numéros (qui seraient les "revue_parts")
     */

    /**
     * Créer un volume (alias revue)
     */
    public function createVolume($data) {
        $journalModel = new JournalModel();
        return $journalModel->createJournal($data);
    }

    /**
     * Récupérer un volume par ID
     */
    public function getVolumeById($id) {
        $journalModel = new JournalModel();
        return $journalModel->getJournalById($id);
    }

    /**
     * Récupérer les volumes par année
     */
    public function getVolumesByYear($year) {
        $sql = "SELECT * FROM revues 
                WHERE YEAR(date_publication) = :year 
                ORDER BY numero ASC";
        
        return $this->db->fetchAll($sql, [':year' => $year]);
    }

    /**
     * Récupérer tous les volumes
     */
    public function getAllVolumes($page = 1, $limit = 20) {
        $journalModel = new JournalModel();
        return $journalModel->getAllJournals($page, $limit);
    }

    /**
     * Récupérer les "numéros" d'un volume (les revue_parts)
     */
    public function getVolumeIssues($volumeId) {
        $journalModel = new JournalModel();
        return $journalModel->getJournalParts($volumeId);
    }

    /**
     * Ajouter un numéro à un volume
     */
    public function addIssueToVolume($volumeId, $data) {
        $journalModel = new JournalModel();
        return $journalModel->addJournalPart($volumeId, $data);
    }

    /**
     * Récupérer les volumes regroupés par année
     */
    public function getVolumesGroupedByYear() {
        $sql = "SELECT YEAR(date_publication) as year, 
                       COUNT(*) as volume_count,
                       GROUP_CONCAT(id ORDER BY numero ASC) as volume_ids
                FROM revues 
                WHERE date_publication IS NOT NULL 
                GROUP BY YEAR(date_publication) 
                ORDER BY year DESC";
        
        $years = $this->db->fetchAll($sql);
        
        // Récupérer les détails des volumes pour chaque année
        foreach ($years as &$year) {
            $volumeIds = explode(',', $year['volume_ids']);
            $year['volumes'] = [];
            
            foreach ($volumeIds as $volumeId) {
                $volume = $this->getVolumeById($volumeId);
                if ($volume) {
                    $year['volumes'][] = $volume;
                }
            }
            
            unset($year['volume_ids']);
        }
        
        return $years;
    }

    /**
     * Récupérer le dernier volume publié
     */
    public function getLatestVolume() {
        $sql = "SELECT * FROM revues 
                WHERE date_publication IS NOT NULL 
                ORDER BY date_publication DESC 
                LIMIT 1";
        
        return $this->db->fetchOne($sql);
    }

    /**
     * Récupérer les volumes avec statistiques
     */
    public function getVolumesWithStats($page = 1, $limit = 10) {
        $offset = ($page - 1) * $limit;
        
        $sql = "SELECT r.*,
                       (SELECT COUNT(*) FROM revue_parts WHERE revue_id = r.id) as issue_count,
                       (SELECT COUNT(*) FROM commentaires WHERE revue_id = r.id) as comment_count,
                       (SELECT COUNT(*) FROM telechargements WHERE revue_id = r.id) as download_count,
                       (SELECT AVG(valeur) FROM notes WHERE revue_id = r.id) as average_rating
                FROM revues r 
                ORDER BY r.date_publication DESC 
                LIMIT :limit OFFSET :offset";
        
        $volumes = $this->db->fetchAll($sql, [
            ':limit' => $limit,
            ':offset' => $offset
        ]);
        
        // Formater les notes
        foreach ($volumes as &$volume) {
            $volume['average_rating'] = round($volume['average_rating'] ?? 0, 1);
        }
        
        return $volumes;
    }
}
?>