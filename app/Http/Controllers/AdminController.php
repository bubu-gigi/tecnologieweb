<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\DipartimentoService;
use App\Services\PrestazioneService;
use App\Services\MedicoService;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SearchPrestazioneRequest;
use App\Http\Requests\SearchDipartimentoRequest;
use App\Http\Requests\GestioneDipartimentiRequest;
use App\Http\Requests\GestioneUtentiRequest;
use App\Http\Requests\GestionePrestazioniRequest;
use App\Services\AgendaService;

class AdminController extends Controller
{
    protected UserService $userService;
    protected DipartimentoService $dipartimentoService;
    protected PrestazioneService $prestazioneService;
    protected MedicoService $medicoService;
    protected AgendaService $agendaService;

    public function __construct(UserService $userService, DipartimentoService $dipartimentoService, PrestazioneService $prestazioneService, MedicoService $medicoService, AgendaService $agendaService)
    {
        $this->userService = $userService;
        $this->dipartimentoService = $dipartimentoService;
        $this->prestazioneService = $prestazioneService;
        $this->medicoService = $medicoService;
        $this->agendaService = $agendaService;
    }

    public function index(): View
    {
        return view('admin.dashboard');
    }

    public function users(): View
    {
        session(['previous_url' => url()->current()]);

        $users = $this->userService->getByRuolo('staff');
        return view('admin.utenti', compact('users'));
    }

    public function createUser(): View
    {
        return view('admin.utenti.create');
    }

    public function editUser($id): View
    {
        $user = $this->userService->getById($id);
        return view('admin.utenti.edit', data: compact('user'));
    }

    public function storeUser(GestioneUtentiRequest $request)
    {
        $data = $request->validated();
        $data['ruolo'] = 'staff';
        $this->userService->create($data);

        return redirect()->route('admin.users')->with('success', 'Utente creato con successo.');
    }

    public function updateUser(GestioneUtentiRequest $request, string $id)
    {
        $data = $request->validated();
        $this->userService->update($id, $data);

        return redirect()->route('admin.users')->with('success', 'Utente aggiornato con successo.');
    }

    public function deleteUser(string $id)
    {
        $this->userService->delete($id);
    }

    public function dipartimenti()
    {
        $dipartimenti = $this->dipartimentoService->getAll();
        return view('admin.dipartimenti', compact('dipartimenti'));
    }

    public function createDipartimento(): View
    {
        return view('admin.dipartimenti.create');
    }

    public function editDipartimento(string $id): View
    {
        $dipartimento = $this->dipartimentoService->getById($id);
        return view('admin.dipartimenti.edit', data: compact('dipartimento'));
    }

    public function storeDipartimento(GestioneDipartimentiRequest $request)
    {
        $data = $request->validated();
        $this->dipartimentoService->create($data);

        return redirect()->route('admin.dipartimenti')->with('success', 'Dipartimento creato con successo.');
    }

    public function updateDipartimento(GestioneDipartimentiRequest $request, string $id)
    {
        $data = $request->validated();
        $this->dipartimentoService->update($id, $data);

        return redirect()->route('admin.dipartimenti')->with('success', 'Dipartimento aggiornato con successo.');
    }

    public function deleteDipartimento(string $id): JsonResponse
    {
        $deleted = $this->dipartimentoService->delete($id);

        if ($deleted) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Errore durante l\'eliminazione'], 500);
    }

    public function gestionePrestazioni(PrestazioneService $prestazioneService)
    {
        $prestazioni = $prestazioneService->getAll();
        return view('admin.prestazioni', compact('prestazioni'));
    }

    public function createPrestazione()
    {
        $medici = $this->medicoService->getAll();
        $staff = $this->userService->getByRuolo('staff');

        return view('admin.prestazioni.create', compact('medici', 'staff'));
    }

    public function editPrestazione(string $id)
    {
        $prestazione = $this->prestazioneService->getById($id);
        $medici = $this->medicoService->getAll();
        $staff = $this->userService->getByRuolo('staff');

        return view('admin.prestazioni.edit', compact('prestazione', 'medici', 'staff'));
    }
    
    public function storePrestazione(GestionePrestazioniRequest $request)
    {
        $data = $request->only(['descrizione', 'prescrizioni', 'medico_id', 'staff_id']);
        $prestazione = $this->prestazioneService->create($data);

        $giorni = $request->input('giorno', []);
        $startTimes = $request->input('start_time', []);
        $endTimes = $request->input('end_time', []);

        foreach ($giorni as $index => $giornoSettimana) {
            $start = $startTimes[$index];
            $end = $endTimes[$index];

            $startHour = \Carbon\Carbon::createFromFormat('H:i', $start);
            $endHour = \Carbon\Carbon::createFromFormat('H:i', $end);

            $fascia = $startHour->hour . '-' . $endHour->hour;
            $this->agendaService->createTemplateRow($prestazione->id, $giornoSettimana, $fascia);

            $startOfJune = \Carbon\Carbon::createFromDate(2025, 6, 1);
            $endOfJune = \Carbon\Carbon::createFromDate(2025, 6, 30);

            for ($date = $startOfJune->copy(); $date <= $endOfJune; $date->addDay()) {
                if ($date->dayOfWeekIso == $giornoSettimana) {
                    $ora = $startHour->copy();
                    while ($ora < $endHour) {
                        $this->agendaService->createGiornalieraRow(
                            $prestazione->id,
                            $date->format('Y-m-d'),
                            $ora->hour
                        );

                        $ora->addHour();
                    }
                }
            }
        }

        return redirect()->route('admin.prestazioni')->with('success', 'Prestazione creata con successo.');
    }

    public function updatePrestazione(GestionePrestazioniRequest $request, string $id)
    {
        $data = $request->validated();
        $this->prestazioneService->update($id, $data);

        return redirect()->route('admin.prestazioni')->with('success', 'Prestazione aggiornata con successo.');
    }

    public function deletePrestazione(string $id): JsonResponse
    {
        $deleted = $this->prestazioneService->delete($id);

        if ($deleted) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Errore durante l\'eliminazione'], 500);
    }
}
