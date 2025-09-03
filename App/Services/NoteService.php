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

    public function createNote(array $noteData, array $tagNames): void
    {
        $this->noteValidator->validate($noteData);
        $this->noteModel->beginTransation();

        try {

            $this->noteModel->insert($noteData);
            $noteId = $this->noteModel->lastInsertId();
            
            foreach($tagNames as $tagName) {

                $tagId = $this->tagModel->findOrCreateByName($tagName);

                $this->noteTagModel->insert([
                    'note_id' => $noteId,
                    'tag_id' => $tagId
                ]);
            }
            
            $this->noteModel->commit();
        } catch (Exception $e) {
            $this->noteModel->rollBack();
            throw $e;
        }
    }

    public function getSingleNote(int|string $note_id): array|object|bool
    {
        return $this->noteModel->where('note_id', $note_id);
    }

    public function getAllNotes(): array
    {
        return $this->noteModel->all();
    }

    public function deleteNote(int|string $id): void
    {
        $this->noteModel->delete($id);
    }

    public function updateNote(mixed $id, array $data, array $tagNames): void
    {
        $this->noteValidator->validate($data);
        $this->noteModel->beginTransation();
        try {
            
            $this->noteModel->update($id, $data);

            $this->noteTagModel->deleteByNoteId($id);

            foreach ($tagNames as $tagName) {
                $tagId = $this->tagModel->findOrCreateByName(trim($tagName));
                $this->noteTagModel->insert([
                    'note_id' => $id,
                    'tag_id'  => $tagId
                ]);
            }

            $this->noteModel->commit();
        } catch(Exception $e) {
            $this->noteModel->rollBack();
            throw $e;
        }
    }

    public function getArchivedNotes(): array
    {
        return $this->noteModel->getArchivedNotes();
    }
}