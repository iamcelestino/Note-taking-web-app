<?php
declare(strict_types=1);

namespace App\Services;
use Exception;
use App\Contracts\{
    NoteInterface, 
    NoteValidateInterface,
    TagInterface,
    NoteTagInterface
};


class NoteService
{
    public function __construct(
        protected NoteInterface $noteModel,
        protected TagInterface $tagModel,
        protected NoteTagInterface $noteTagModel,
        protected NoteValidateInterface $noteValidator
    ){}

    public function createNote(array $noteData, array $tags): void
    {
        $this->noteValidator->validate($noteData);
        $this->noteModel->beginTransation();

        try {
            
            $this->noteModel->insert($noteData);
            $noteId = $this->noteModel->lastInsertId();

            foreach($tags as $tagName) {

                $tagId = $this->tagModel->findOrCreateByName($tagName);

                $this->noteTagModel->insert([
                    'note_id' => $noteId,
                    'tag_id' => $tagId
                ]);
            }

        } catch (Exception $e) {
            $this->noteModel->rollBack();
            throw $e;
            
        }
    }
}