<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\DipartimentoService;
use App\Services\PrestazioneService;
use App\Services\MedicoService;
use App\Services\StatisticheService;
use Illuminate\View\View;
use App\Http\Requests\GestioneDipartimentiRequest;
use App\Http\Requests\GestioneUtentiRequest;
use App\Http\Requests\GestionePrestazioniRequest;
use App\Http\Requests\StatisticheRequest;
use App\Services\AgendaService;
use App\Services\PrenotazioneService;

class AdminController extends Controller
{
    protected UserService $userService;
    protected DipartimentoService $dipartimentoService;
    protected PrestazioneService $prestazioneService;
    protected MedicoService $medicoService;
    protected AgendaService $agendaService;
    protected StatisticheService $statisticheService;
    protected PrenotazioneService $prenotazioneService;

    public function __construct(UserService $userService, DipartimentoService $dipartimentoService, PrestazioneService $prestazioneService, MedicoService $medicoService, AgendaService $agendaService, StatisticheService $statisticheService, PrenotazioneService $prenotazioneService)
    {
        $this->userService = $userService;
        $this->dipartimentoService = $dipartimentoService;
        $this->prestazioneService = $prestazioneService;
        $this->medicoService = $medicoService;
        $this->agendaService = $agendaService;
        $this->statisticheService = $statisticheService;
        $this->prenotazioneService = $prenotazioneService;
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

        return redirect()->route('admin.users.index');
    }

    public function updateUser(GestioneUtentiRequest $request, string $id)
    {
        $data = $request->validated();
        $this->userService->update($id, $data);

        return redirect()->route('admin.users.index');
    }

    public function deleteUser(string $id)
    {
        $this->prestazioneService->setPrestazioneStaffIdNullByStaffId($id);
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
        return redirect()->route('admin.departments.index');
    }

    public function updateDipartimento(GestioneDipartimentiRequest $request, string $id)
    {
        $data = $request->validated();
        $this->dipartimentoService->update($id, $data);
        return redirect()->route('admin.departments.index');
    }

    public function deleteDipartimento(string $id)
    {
        $this->medicoService->setMedicoDipartimentoIdNullByDipartimentoId($id);
        $this->dipartimentoService->delete($id);
    }

    public function prestazioni(PrestazioneService $prestazioneService)
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
        $orari = $this->agendaService->getAgendaTemplateByPrestazioneId($id);
        return view('admin.prestazioni.edit', compact('prestazione', 'medici', 'staff', 'orari'));
    }

    public function storePrestazione(GestionePrestazioniRequest $request)
    {
        $data = $request->only(['descrizione', 'prescrizioni', 'medico_id', 'staff_id']);
        $prestazione = $this->prestazioneService->create($data);

        $orari = json_decode($request->input('orari', '[]'), true);

        $startOfJune = \Carbon\Carbon::create(2025, 6, 1);
        $endOfJune = \Carbon\Carbon::create(2025, 6, 30);

        foreach ($orari as $entry) {
            $giornoSettimana = (int) $entry['giorno'];
            $start = (int) $entry['start'];
            $end = (int) $entry['end'];

            $fascia = "$start-$end";
            $this->agendaService->createTemplateRow($prestazione->id, $giornoSettimana, $fascia);

            for ($date = $startOfJune->copy(); $date <= $endOfJune; $date->addDay()) {
                if ($date->dayOfWeekIso === $giornoSettimana) {
                    for ($ora = $start; $ora < $end; $ora++) {
                        $this->agendaService->createGiornalieraRow(
                            $prestazione->id,
                            $date->format('Y-m-d'),
                            $ora
                        );
                    }
                }
            }
        }

        return redirect()->route('admin.services.index');
    }

    public function updatePrestazione(GestionePrestazioniRequest $request, int $id)
    {
        $data = $request->only(['descrizione', 'prescrizioni', 'medico_id', 'staff_id']);
        $this->prestazioneService->update($id, $data);

        $this->agendaService->deleteTemplateByPrestazioneId($id);

        $startOfJune = \Carbon\Carbon::create(2025, 6, 1);
        $endOfJune = \Carbon\Carbon::create(2025, 6, 30);

        $orari = json_decode($request->input('orari', '[]'), true);
        $fasceOrarieAttuali = [];

        foreach ($orari as $entry) {
            $giornoSettimana = (int) $entry['giorno'];
            $start = (int) $entry['start'];
            $end = (int) $entry['end'];

            $fascia = "$start-$end";
            $this->agendaService->createTemplateRow($id, $giornoSettimana, $fascia);

            for ($h = $start; $h < $end; $h++) {
                $fasceOrarieAttuali[$giornoSettimana][] = $h;
            }
        }

        $oggi = now()->format('Y-m-d');
        $this->agendaService->deleteGiornalieraByPrestazioneId($id, $oggi);

        for ($date = $startOfJune->copy(); $date <= $endOfJune; $date->addDay()) {
            if ($date->format('Y-m-d') < $oggi) continue;

            $giornoSettimana = $date->dayOfWeekIso;

            if (!isset($fasceOrarieAttuali[$giornoSettimana])) continue;

            foreach ($fasceOrarieAttuali[$giornoSettimana] as $ora) {
                $this->agendaService->createGiornalieraRow(
                    $id,
                    $date->format('Y-m-d'),
                    $ora
                );
            }
        }

        $this->agendaService->deleteInvalidPrenotazioni($id, $fasceOrarieAttuali);

        return redirect()->route('admin.services.index');
    }


    public function deletePrestazione(string $id)
    {
        $this->agendaService->deleteDataByPrestazioneId($id);
        $this->prenotazioneService->deleteByPrestazioneId($id);
        $this->prestazioneService->delete($id);
    }

    public function statistichePrestazioni(StatisticheRequest $request)
    {
        $data = $request->validated();
        $utenteEsterno = null;

        if (!empty($data['utente_esterno'])) {
            $utenteEsterno = $this->userService->getByUsername($data['utente_esterno']);
            $data['utente_id'] = $utenteEsterno?->id;
        }

        $statistiche = $this->statisticheService->getStatistiche($data);
        $utentiEsterni = $this->userService->getByRuolo('user');

        return view('admin.statistiche', compact('statistiche', 'utentiEsterni', 'utenteEsterno'));
    }
}
