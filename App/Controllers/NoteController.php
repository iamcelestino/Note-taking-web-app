<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\Controller;
use App\Services\{NoteService};
use App\Contracts\NoteValidateInterface;
use App\Enums\NoteStatus;

class NoteController extends Controller
{
    public function __construct(
        protected NoteService $note,
        protected NoteValidateInterface $noteValidator
    ){}

    public function index(): void
    {
        $this->view('all_notes', []);
    }

    public function createNote(): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $note = [
                'status' => NoteStatus::active->value ?? null,
                'user_id' => 1 ?? null,
                'content' => $_POST['content'] ?? null
            ];
            
            $nome = explode(',', $_POST['nome']);
            $this->note->createNote($note, $nome);
            $this->redirect('/home');
        }

        $this->view('create_new_note', []);
    }

    public function deleteNote($id): void
    {
        $note_id = (int)$id;
        $note = $this->note->getSingleNote($note_id);

        if (!$note) {
            die;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->note->deleteNote($id);
        }

        $this->view('delete_note', [
            'note' => $note[0]
        ]);
    }
}

