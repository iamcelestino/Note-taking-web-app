<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\Controller;
use App\Services\NoteService;
use App\Enums\NoteStatus;

class NoteController extends Controller
{
    public function __construct(
        protected NoteService $note
    ){}

    public function index(): void
    {
       
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
            $this->redirect('/');
        }

        $this->view('create_new_note', []);
    }

    public function deleteNote(): void
    {
        $this->note->deleteNote(1);
        $this->view('delete_note', []);
    }
}

