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
        $this->view('all_note', []);
    }

    public function createNote(): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $_POST['status'] = NoteStatus::active->value ?? null;
            // $_POST['user_id'] = 1 ?? null;
            // $this->note->createNote($_POST);
            $tags = explode(',', $_POST['tags']);

            dd($tags);
        }

        $this->view('create_new_note', []);
    }
}

