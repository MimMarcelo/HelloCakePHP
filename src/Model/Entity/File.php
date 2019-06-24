<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * File Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $filename
 * 
 * @property \App\Model\Entity\User $user
 * @property FileUpload $_file File to be uploaded
 */
class File extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'filename' => true,
        'user' => true,
        'file' => true,
    ];

    public function _setFile($_file) {
        $this->_file = new FileUpload($_file);
        $this->filename = $this->_file->getFileName();
    }
    
    public function upload($_fileName = "", $_pathToSaveFile = ""){
        $this->_file->setFileName($_fileName);
        $this->_file->setPathToSaveFile($_pathToSaveFile);
        
        if ($this->_file->validate(true, 0.6)) {
            if ($this->_file->upload()) {
                return true;
            }
        }
        return false;
    }
}
