<?php

namespace Database\Seeders;

use App\Models\Commentary;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserCommentarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get roles
        $editorRole = Role::where('name', 'editor')->first();
        $authorRole = Role::where('name', 'author')->first();

        // get authors
        $marcoZollinger = User::where('name', 'Mar­co Zol­lin­ger')->first();
        $susanneBrütsch = User::where('name', 'Susan­ne Brütsch')->first();
        $jeanPascalStoll = User::where('name', 'Jean-Pas­cal Stoll')->first();
        $danielBrugger = User::where('name', 'Dani­el Brug­ger')->first();
        $loïcStucki = User::where('name', 'Loïc Stucki')->first();
        $alexanderKistler = User::where('name', 'Alex­an­der Kist­ler')->first();
        $deniseWeingart = User::where('name', 'Deni­se Wein­gart')->first();

        // get editors
        $stefanSchlegel = User::where('name', 'Stefan Schlegel')->first();
        $odileAmmann = User::where('name', 'Odile Ammann')->first();
        $christophHurni = User::where('name', 'Christoph Hurni')->first();
        $mirjamEggen = User::where('name', 'Mirjam Eggen')->first();
        $sonjaKoch = User::where('name', 'Sonja Koch')->first();

        // Commentary: Art. 68 BV
        // Authors: Marco Zollinger
        // Editors: Stefan Schlegel, Odile Ammann
        $bv68 = Commentary::where('label_de', 'Art. 68 BV')->first();
        $bv68->authors()->attach($marcoZollinger->id, ['role_id' => $authorRole->id]);
        $bv68->editors()->attach($stefanSchlegel->id, ['role_id' => $editorRole->id]);
        $bv68->editors()->attach($odileAmmann->id, ['role_id' => $editorRole->id]);

        // Commentary: Art. 11 OR
        // Authors: Susanne Brütsch
        // Editors: Christoph Hurni, Mirjam Eggen
        $or11 = Commentary::where('label_de', 'Art. 11 OR')->first();
        $or11->authors()->attach($susanneBrütsch->id, ['role_id' => $authorRole->id]);
        $or11->editors()->attach($christophHurni->id, ['role_id' => $editorRole->id]);
        $or11->editors()->attach($mirjamEggen->id, ['role_id' => $editorRole->id]);

        // Commentary: Art. 143 OR
        // Authors: Jean-Pascal Stoll
        // Editors: Christoph Hurni, Mirjam Eggen
        $or143 = Commentary::where('label_de', 'Art. 143 OR')->first();
        $or143->authors()->attach($jeanPascalStoll->id, ['role_id' => $authorRole->id]);
        $or143->editors()->attach($christophHurni->id, ['role_id' => $editorRole->id]);
        $or143->editors()->attach($mirjamEggen->id, ['role_id' => $editorRole->id]);

        // Commentary: Art. 701 OR
        // Authors: Daniel Brugger
        $or701 = Commentary::where('label_de', 'Art. 701 OR')->first();
        $or701->authors()->attach($danielBrugger->id, ['role_id' => $authorRole->id]);

        // Commentary: Art. 20 IPRG
        // Authors: Loïc Stucki
        // Editors: Christoph Hurni
        $iprg20 = Commentary::where('label_de', 'Art. 20 IPRG')->first();
        $iprg20->authors()->attach($loïcStucki->id, ['role_id' => $authorRole->id]);
        $iprg20->editors()->attach($christophHurni->id, ['role_id' => $editorRole->id]);

        // Commentary: Art. 32 - 37 LugÜ
        // Authors: Alexander Kistler
        // Editors: Christoph Hurni
        $lugu32vorb = Commentary::where('label_de', 'Art. 32 — 37 LugÜ')->first();
        $lugu32vorb->authors()->attach($alexanderKistler->id, ['role_id' => $authorRole->id]);
        $lugu32vorb->editors()->attach($christophHurni->id, ['role_id' => $editorRole->id]);

        // Commentary: Art. 32 LugÜ
        // Authors: Alexander Kistler
        // Editors: Christoph Hurni
        $lugu32 = Commentary::where('label_de', 'Art. 32 LugÜ')->first();
        $lugu32->authors()->attach($alexanderKistler->id, ['role_id' => $authorRole->id]);
        $lugu32->editors()->attach($christophHurni->id, ['role_id' => $editorRole->id]);

        // Commentary: Art. 366 StPO
        // Authors: Denise Weingart
        // Editors: Sonja Koch
        $stpo366 = Commentary::where('label_de', 'Art. 366 StPO')->first();
        $stpo366->authors()->attach($alexanderKistler->id, ['role_id' => $authorRole->id]);
        $stpo366->editors()->attach($christophHurni->id, ['role_id' => $editorRole->id]);
    }
}
