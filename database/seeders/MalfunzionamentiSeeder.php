<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Prodotto;
use App\Models\Malfunzionamento;

class MalfunzionamentiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Workstation Pro XPS 15' => [
                [
                    'descrizione'        => 'Surriscaldamento durante rendering o compilazioni lunghe',
                    'soluzione_tecnica'  => 'Aggiornare BIOS/firmware, pulire ventole, verificare pasta termica, usare base di raffreddamento.',
                ],
                [
                    'descrizione'        => 'Lag quando sono attive VM',
                    'soluzione_tecnica'  => 'Abilitare VT-x/Hyper-V nel BIOS, aumentare RAM alla VM e usare disco su SSD NVMe.',
                ],
            ],
            'Router Wi-Fi 6 AX3000' => [
                [
                    'descrizione'        => 'Disconnessioni su banda 5 GHz',
                    'soluzione_tecnica'  => 'Aggiornare firmware, impostare canale meno affollato, disabilitare DFS se necessario.',
                ],
                [
                    'descrizione'        => 'Bassa velocità in download',
                    'soluzione_tecnica'  => 'Verificare cavo CAT6, abilitare accelerazione NAT/Hardware, controllare MTU del provider.',
                ],
            ],
            'NAS 4-bay Pro (RAID)' => [
                [
                    'descrizione'        => 'Array RAID in stato degradato',
                    'soluzione_tecnica'  => 'Identificare disco guasto, sostituire con modello identico e avviare ricostruzione dal pannello.',
                ],
                [
                    'descrizione'        => 'Volume RAID non montato all\'avvio',
                    'soluzione_tecnica'  => 'Verificare stato dell’array, controllare le voci di mount (pannello o /etc/fstab) e ricreare i metadata se corrotti.',
                ],
            ],
            
            'Monitor 27" 4K IPS' => [
                [
                    'descrizione'        => 'Dominante colore / non uniformità ai bordi',
                    'soluzione_tecnica'  => 'Calibrazione con profilo ICC, ridurre luminosità, usare DisplayPort alla risoluzione nativa.',
                ],
                [
                    'descrizione'        => 'Nessun segnale 4K a 60 Hz',
                    'soluzione_tecnica'  => 'Usare cavo DP 1.4/HDMI 2.0 certificato, impostare 3840x2160@60Hz nel sistema e abilitare chroma 4:4:4.',
                ],
            ],
            
            'SSD NVMe 1TB Gen4' => [
                [
                    'descrizione'        => 'Prestazioni inferiori alle attese',
                    'soluzione_tecnica'  => 'Usare slot PCIe Gen4, aggiornare driver/chipset, abilitare modalità NVMe nel BIOS.',
                ],
                [
                    'descrizione'        => 'Surriscaldamento / thermal throttling',
                    'soluzione_tecnica'  => 'Installare dissipatore per M.2, migliorare il flusso d’aria del case e aggiornare il firmware dell’SSD.',
                ],
            ],
            
            'Switch Managed 24-port Gigabit' => [
                [
                    'descrizione'        => 'Loop di rete e tempeste di broadcast',
                    'soluzione_tecnica'  => 'Abilitare STP/RSTP, configurare storm-control e verificare cablaggi doppi.',
                ],
                [
                    'descrizione'        => 'VLAN non isolate / traffico inter-VLAN non desiderato',
                    'soluzione_tecnica'  => 'Impostare correttamente tagging/untagging, PVID sulle porte access, trunk dove serve e applicare ACL.',
                ],
            ],
            
            'UPS 1500VA Online' => [
                [
                    'descrizione'        => 'Spegnimento carichi durante blackout',
                    'soluzione_tecnica'  => 'Test/sostituzione batteria, ridurre carico, configurare software di shutdown automatico.',
                ],
                [
                    'descrizione'        => 'Batteria non si carica / autonomia molto bassa',
                    'soluzione_tecnica'  => 'Eseguire calibrazione (scarica/carica completa), verificare collegamenti e sostituire la batteria se capacità <80%.',
                ],
            ],
            
            'Scheda Grafica GPU RTX 4070 Ti' => [
                [
                    'descrizione'        => 'Artefatti/black screen sotto carico',
                    'soluzione_tecnica'  => 'Aggiornare driver, verificare alimentazione PCIe, monitorare temperature.',
                ],
                [
                    'descrizione'        => 'Timeout driver (TDR) con applicazioni DX12',
                    'soluzione_tecnica'  => 'Pulizia driver con DDU e reinstallazione, aggiornamento firmware/BIOS, aumento limite TDR e verifica PSU.',
                ],
            ],
            
            'Server Rack 1U - Micro' => [
                [
                    'descrizione'        => 'Temperature elevate nel rack',
                    'soluzione_tecnica'  => 'Pulizia filtri, ottimizzazione flusso d’aria, profilo ventole bilanciato.',
                ],
                [
                    'descrizione'        => 'Allarme alimentazione ridondante',
                    'soluzione_tecnica'  => 'Controllare entrambi gli alimentatori e i cavi A/B, sostituire l’unità difettosa e verificare log IPMI.',
                ],
            ],
            
            'Kit SBC Raspberry Pi 4 - 8GB + Case' => [
                [
                    'descrizione'        => 'Throttling termico',
                    'soluzione_tecnica'  => 'Aggiungere dissipatore/ventola, usare alimentatore adeguato, evitare overclock eccessivo.',
                ],
                [
                    'descrizione'        => 'Nessun segnale video su micro-HDMI',
                    'soluzione_tecnica'  => 'Usare un cavo micro-HDMI idoneo sulla porta HDMI0, impostare `hdmi_force_hotplug=1` in config.txt e usare alimentatore conforme.',
                ],
            ],
            
        ];

        $prodottiIndicizzati = Prodotto::all()->keyBy(function ($p) {
            return $this->normalizeName($p->name);
        });

        foreach ($data as $productName => $issues) {
            $key = $this->normalizeName($productName);
            $prodotto = $prodottiIndicizzati->get($key);

            if (! $prodotto) {
                continue;
            }

            foreach ($issues as $issue) {
                $exists = \App\Models\Malfunzionamento::where('prodotto_id', $prodotto->id)
                    ->where('descrizione', $issue['descrizione'])
                    ->exists();
            
                if (! $exists) {
                    $m = new \App\Models\Malfunzionamento([
                        'descrizione'        => $issue['descrizione'],
                        'soluzione_tecnica'  => $issue['soluzione_tecnica'],
                    ]);
                    $m->prodotto()->associate($prodotto);
                    $m->save();
                }
            }
        }
    }


    private function normalizeName(string $name): string
    {
        return Str::of($name)
            ->replace(['–', '—', '−'], '-') 
            ->lower()
            ->squish()
            ->toString();
    }
}
