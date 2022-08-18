<?php

namespace Database\Seeders;

use App\Models\Commentary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Commentary::factory()->create([
            'slug' => 'bv68',
            'label_de' => 'Art. 68 BV',
            'suggested_citation_long' => 'Marco Zollinger, Kommentar zu Art. 68 BV, in: Stefan Schlegel / Odile Ammann (Hrsg.), Onlinekommentar zur Bundesverfassung, https://onlinekommentar.ch/bv68/, 1. Aufl., N. XXX zu Art. 68 BV (besucht am XXX).',
            'suggested_citation_short' => 'OK-Zollinger, N. XXX zu Art. 68 BV.',
            'doi' => 'xx.xxxx/onlinekommentar.bv68',
        ]);

        Commentary::factory()->create([
            'slug' => 'or11',
            'label_de' => 'Art. 11 OR',
            'suggested_citation_long' => 'Susanne Brütsch, Kommentar zu Art. 11 OR, in: Christoph Hurni / Mirjam Eggen (Hrsg.), Onlinekommentar zum Obligationenrecht, https://onlinekommentar.ch/or11/, 1. Aufl., N. XXX zu Art. 11 OR (besucht am XXX).',
            'suggested_citation_short' => 'OK-Brütsch, N. XXX zu Art. 11 OR.',
            'doi' => 'xx.xxxx/onlinekommentar.or11',
        ]);

        Commentary::factory()->create([
            'slug' => 'or143',
            'label_de' => 'Art. 143 OR',
            'suggested_citation_long' => 'Jean-Pascal Stoll, Kommentar zu Art. 143 OR, in: Christoph Hurni / Mirjam Eggen (Hrsg.), Onlinekommentar zum Obligationenrecht, https://onlinekommentar.ch/or143/, 1. Aufl., N. XXX zu Art. 143 OR (besucht am XXX).',
            'suggested_citation_short' => 'OK-Stoll, N. XXX zu Art. 143 OR.',
            'doi' => 'xx.xxxx/onlinekommentar.or143',
        ]);

        Commentary::factory()->create([
            'slug' => 'or701',
            'label_de' => 'Art. 701 OR',
            'suggested_citation_long' => 'Daniel Brugger, Kommentar zu Art. 701 OR, in: Onlinekommentar zum Obligationenrecht, Onlinekommentar.ch, https://onlinekommentar.ch/or701/, 1. Aufl., N. XXX zu Art. 701 OR (besucht am XXX).',
            'suggested_citation_short' => 'OK-Brugger, N. XXX zu Art. 701 OR.',
            'doi' => 'xx.xxxx/onlinekommentar.or701',
        ]);

        Commentary::factory()->create([
            'slug' => 'iprg20',
            'label_de' => 'Art. 20 IPRG',
            'suggested_citation_long' => 'Loïc Stucki, Kommentar zu Art. 20 IPRG, in: Christoph Hurni (Hrsg.), Onlinekommentar zum IPRG, https://onlinekommentar.ch/iprg20/, 1. Aufl., N. XXX zu Art. 20 IPRG (besucht am XXX).',
            'suggested_citation_short' => 'OK-Stucki, N. XXX zu Art. 20 IPRG.',
            'doi' => 'xx.xxxx/onlinekommentar.iprg20',
        ]);

        Commentary::factory()->create([
            'slug' => 'lugu32vorb',
            'label_de' => 'Art. 32 — 37 LugÜ',
            'suggested_citation_long' => 'Alexander Kistler, Vorb. zu Art. 32 — 37 LugÜ, in: Christoph Hurni (Hrsg.), Onlinekommentar zum Lugano Übereinkommen, https://onlinekommentar.ch/lugu32vorb, 1. Aufl., N. XXX zu Vorb. zu Art. 32 — 37 LugÜ (besucht am XXX).',
            'suggested_citation_short' => 'OK-Kistler, N. XXX zu Vorb. zu Art. 32 — 37 LugÜ.',
            'doi' => 'xx.xxxx/onlinekommentar.lugu32vorb',
        ]);

        Commentary::factory()->create([
            'slug' => 'lugu32',
            'label_de' => 'Art. 32 LugÜ',
            'suggested_citation_long' => 'Alexander Kistler, Kommentar zu Art. 32 LugÜ, in: Christoph Hurni (Hrsg.), Onlinekommentar zum Lugano Übereinkommen, https://onlinekommentar.ch/lugu32/, 1. Aufl., N. XXX zu Art. 32 LugÜ (besucht am XXX).',
            'suggested_citation_short' => 'OK-Kistler, N. XXX zu Art. 32 LugÜ.',
            'doi' => 'xx.xxxx/onlinekommentar.lugu32',
        ]);

        Commentary::factory()->create([
            'slug' => 'stpo366',
            'label_de' => 'Art. 366 StPO',
            'suggested_citation_long' => 'Denise Weingart, Kommentar zu Art. 366 StPO, in: Sonja Koch (Hrsg.), Onlinekommentar zur Strafprozessordnung, https://onlinekommentar.ch/stpo366/, 1. Aufl., N. XXX zu Art. 366 StPO (besucht am XXX).',
            'suggested_citation_short' => 'OK-Weingart, N. XXX zu Art. 366 StPO.',
            'doi' => 'xx.xxxx/onlinekommentar.stpo366',
        ]);
    }
}
