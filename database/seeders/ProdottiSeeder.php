<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Prodotto;

class ProdottiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Workstation Pro XPS 15',
                'image_name' => 'xps15_workstation.jpg',
                'descrizione' => 'Laptop workstation 15.6" pensato per sviluppo e modellazione 3D. CPU Intel Core i9, 32GB RAM, GPU dedicata NVidia RTX serie professionale.',
                'note_uso' => 'Ideale per ambienti di sviluppo, compilazione e rendering. Evitare l\'uso prolungato in ambienti surriscaldati; effettuare aggiornamenti firmware regolari.',
                'mod_installazione' => 'Rimuovere pellicole protettive, collegare alimentatore originale e aggiornare BIOS e driver GPU prima dell\'uso.',
            ],
            [
                'name' => 'Router Wi‑Fi 6 AX3000',
                'image_name' => 'router_ax3000.png',
                'descrizione' => 'Router dual‑band Wi‑Fi 6 con supporto MU‑MIMO e porte Gigabit‑Ethernet. Ideale per uffici di piccole/medie dimensioni.',
                'note_uso' => 'Posizionare centralmente per copertura ottimale. Evitare posizionamento vicino a dispositivi interferenti come microonde.',
                'mod_installazione' => 'Collegare WAN al modem, accedere al pannello admin via 192.168.1.1, configurare SSID e password, aggiornare firmware.',
            ],
            [
                'name' => 'NAS 4‑bay Pro (RAID)',
                'image_name' => 'nas_4bay.jpg',
                'descrizione' => 'Dispositivo NAS a 4 bay con supporto RAID 0/1/5/6. CPU ARM ad alte prestazioni e app per backup e sincronizzazione centralizzata.',
                'note_uso' => 'Usare dischi identici per migliori prestazioni RAID. Effettuare backup offsite regolari.',
                'mod_installazione' => 'Inserire dischi, configurare array RAID dal pannello web, creare utenti e impostare condivisioni SMB/NFS.',
            ],
            [
                'name' => 'Monitor 27" 4K IPS',
                'image_name' => 'monitor_27_4k.jpg',
                'descrizione' => 'Monitor 27 pollici 4K con pannello IPS, gamut sRGB elevato e profilo colore calibrabile. Ottimo per sviluppo UI/UX e grafica.',
                'note_uso' => 'Consigliata calibrazione colore per lavoro grafico professionale. Usare porte DisplayPort per risoluzioni massime.',
                'mod_installazione' => 'Montare base, collegare cavo DisplayPort/HDMI, impostare risoluzione 3840x2160 e scaling nel sistema operativo.',
            ],
            [
                'name' => 'SSD NVMe 1TB Gen4',
                'image_name' => 'ssd_nvme_1tb.jpg',
                'descrizione' => 'Unità SSD NVMe M.2 1TB con alte velocità di lettura/scrittura per ridurre tempi di build e avvio di macchine virtuali.',
                'note_uso' => 'Installare su slot M.2 compatibile con Gen4 per migliori prestazioni; evitare esposizione a calore eccessivo.',
                'mod_installazione' => 'Inserire M.2 nello slot dedicato, fissare con vite, verificare riconoscimento in BIOS e partizionare/formattare dal sistema operativo.',
            ],
            [
                'name' => 'Switch Managed 24‑port Gigabit',
                'image_name' => 'switch_24_gigabit.jpg',
                'descrizione' => 'Switch gestito 24 porte Gigabit con supporto VLAN, QoS e stacking. Adatto a reti aziendali e piccoli datacenter.',
                'note_uso' => 'Configura VLAN per segmentazione del traffico; abilitare STP per evitare loop di rete.',
                'mod_installazione' => 'Collegare alimentazione, uplink al router, accedere alla console via web/SSH e applicare configurazioni VLAN/QoS.',
            ],
            [
                'name' => 'UPS 1500VA Online',
                'image_name' => 'ups_1500va.png',
                'descrizione' => 'Gruppo di continuità online 1500VA con onda sinusoidale pura, ideale per protezione di server e workstation critiche.',
                'note_uso' => 'Testare la batteria periodicamente; evitare spostamenti con UPS ancora carico.',
                'mod_installazione' => 'Collegare carichi critici alle prese protette, impostare software di shutdown automatico sul server e verificare comunicazione USB/RS232.',
            ],
            [
                'name' => 'Scheda Grafica GPU RTX 4070 Ti',
                'image_name' => 'gpu_rtx4070ti.jpg',
                'descrizione' => 'GPU ad alte prestazioni per calcolo parallelo, accelerazione ML e rendering. 12GB GDDR6X e supporto CUDA/DirectX 12.',
                'note_uso' => 'Verificare adeguata alimentazione e flusso d\'aria nel case; aggiornare driver ufficiali NVIDIA.',
                'mod_installazione' => 'Inserire nello slot PCIe x16, collegare alimentazione PCIe, installare driver ufficiali e testare con benchmark.',
            ],
            [
                'name' => 'Server Rack 1U - Micro',
                'image_name' => 'server_1u.jpg',
                'descrizione' => 'Server rack 1U compatto per servizi web e database leggeri. Supporta CPU Xeon, fino a 128GB RAM e storage hot‑swap.',
                'note_uso' => 'Monitorare temperature in rack; pianificare backup regolari e aggiornamenti di sicurezza.',
                'mod_installazione' => 'Montare su rack 19", collegare alimentazione ridondante se disponibile, configurare RAID e installare OS server.',
            ],
            [
                'name' => 'Kit SBC Raspberry Pi 4 - 8GB + Case',
                'image_name' => 'raspberrypi4_8gb_kit.jpg',
                'descrizione' => 'Single Board Computer Raspberry Pi 4 con 8GB RAM, alimentatore USB‑C, case e scheda microSD. Perfetto per prototipi IoT e test server leggeri.',
                'note_uso' => 'Non esporre a fonti di calore; usare dissipatore per carichi prolungati.',
                'mod_installazione' => 'Inserire microSD con sistema operativo, collegare alimentazione e rete, eseguire primo avvio e aggiornare pacchetti.',
            ],
        ];

        foreach ($products as $p) {
            Prodotto::create($p);
        }
    }
}
