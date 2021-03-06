<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentTree;

class DocumentTreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentTree::Factory()->create([
            'id'        => 2,
            'parent_id' => 1,
            'sort'      => 1,
            'label_de'  => 'Bundesverfassung (BV)',
            'label_en'  => 'Bundesverfassung (BV)',
            'label_fr'  => 'Bundesverfassung (BV)',
            'label_it'  => 'Bundesverfassung (BV)'
        ]);

        DocumentTree::Factory()->create([
            'id'        => 3,
            'parent_id' => 1,
            'sort'      => 2,
            'label_de'  => 'Obligationenrecht (OR)',
            'label_en'  => 'Obligationenrecht (OR)',
            'label_fr'  => 'Obligationenrecht (OR)',
            'label_it'  => 'Obligationenrecht (OR)'
        ]);

        DocumentTree::Factory()->create([
            'id'        => 4,
            'parent_id' => 1,
            'sort'      => 3,
            'label_de'  => 'Bundesgesetz über das internationale Privatrecht (IPRG)',
            'label_en'  => 'Bundesgesetz über das internationale Privatrecht (IPRG)',
            'label_fr'  => 'Bundesgesetz über das internationale Privatrecht (IPRG)',
            'label_it'  => 'Bundesgesetz über das internationale Privatrecht (IPRG)'
        ]);

        DocumentTree::Factory()->create([
            'id'        => 5,
            'parent_id' => 1,
            'sort'      => 4,
            'label_de'  => 'Lugano Übereinkommen (LUGÜ)',
            'label_en'  => 'Lugano Übereinkommen (LUGÜ)',
            'label_fr'  => 'Lugano Übereinkommen (LUGÜ)',
            'label_it'  => 'Lugano Übereinkommen (LUGÜ)'
        ]);

        DocumentTree::Factory()->create([
            'id'        => 6,
            'parent_id' => 1,
            'sort'      => 5,
            'label_de'  => 'Strafprozessordnung',
            'label_en'  => 'Strafprozessordnung',
            'label_fr'  => 'Strafprozessordnung',
            'label_it'  => 'Strafprozessordnung'
        ]);


        DocumentTree::Factory()->create([
            'id'        => 7,
            'parent_id' => 2,
            'sort'      => 1,
            'label_de'  => '3. Titel: Bund, Kantone und Gemeinden',
            'label_en'  => '3. Titel: Bund, Kantone und Gemeinden',
            'label_fr'  => '3. Titel: Bund, Kantone und Gemeinden',
            'label_it'  => '3. Titel: Bund, Kantone und Gemeinden'
        ]);

        DocumentTree::Factory()->create([
            'id'        => 8,
            'parent_id' => 7,
            'sort'      => 1,
            'label_de'  => '1. Kapitel: Verhältnis von Bund und Kantonen',
            'label_en'  => '1. Kapitel: Verhältnis von Bund und Kantonen',
            'label_fr'  => '1. Kapitel: Verhältnis von Bund und Kantonen',
            'label_it'  => '1. Kapitel: Verhältnis von Bund und Kantonen'
        ]);

        DocumentTree::Factory()->create([
            'id'        => 9,
            'parent_id' => 7,
            'sort'      => 2,
            'label_de'  => '2. Kapitel: Zuständigkeiten',
            'label_en'  => '2. Kapitel: Zuständigkeiten',
            'label_fr'  => '2. Kapitel: Zuständigkeiten',
            'label_it'  => '2. Kapitel: Zuständigkeiten'
        ]);

        DocumentTree::Factory()->create([
            'id'        => 10,
            'parent_id' => 9,
            'sort'      => 1,
            'label_de'  => '3. Abschnitt: Bildung, Forschung und Kultur Art. 61a – Art. 72',
            'label_en'  => '3. Abschnitt: Bildung, Forschung und Kultur Art. 61a – Art. 72',
            'label_fr'  => '3. Abschnitt: Bildung, Forschung und Kultur Art. 61a – Art. 72',
            'label_it'  => '3. Abschnitt: Bildung, Forschung und Kultur Art. 61a – Art. 72'
        ]);

        DocumentTree::Factory()->create([
            'id'        => 11,
            'parent_id' => 10,
            'sort'      => 1,
            'label_de'  => 'Art. 68 BV, Sport',
            'label_en'  => 'Art. 68 BV, Sport',
            'label_fr'  => 'Art. 68 BV, Sport',
            'label_it'  => 'Art. 68 BV, Sport',
            'node_type'  => 'leaf',
            'content_de'  => '<p><sup>1</sup>Der Bund fördert den Sport, ins­be­son­de­re die Ausbildung.</p>
            <p><sup>2</sup>Er betreibt eine Sportschule.</p>
            <p><sup>3</sup>Er kann Vor­schrif­ten über den Jugend­sport erlas­sen und den Sport­un­ter­richt an Schu­len obli­ga­to­risch erklären.</p>',

            'content_en'  => '<p><sup>1</sup>The Con­fe­de­ra­ti­on shall encou­ra­ge sport, and in par­ti­cu­lar edu­ca­ti­on in sport.</p>
            <p><sup>2</sup>It shall ope­ra­te a sports school.</p>
            <p><sup>3</sup>It may issue regu­la­ti­ons on sport for young peop­le and decla­re the tea­ching of sport in schools to be compulsory.</p>',

            'content_fr'  => '<p><sup>1</sup>La Con­fé­dé­ra­ti­on encou­ra­ge le sport, en par­ti­cu­lier la for­ma­ti­on au sport.</p>
            <p><sup>2</sup>Elle gère une éco­le de sport.</p>
            <p><sup>3</sup>Elle peut légifé­rer sur la pra­tique du sport par les jeu­nes et décla­rer obli­ga­toire l’enseignement du sport dans les écoles.</p>',

            'content_it'  => '<p><sup>1</sup>La Con­fe­der­a­zio­ne pro­muo­ve lo sport, in par­ti­co­la­re l’educazione sportiva.</p>
            <p><sup>2</sup>Ges­tis­ce una scuo­la di sport.</p>
            <p><sup>3</sup>Può emana­re pre­scri­zio­ni sullo sport gio­va­ni­le e dichiara­re obb­li­ga­to­rio l’insegna­mento del­lo sport nel­le scuole.</p>',
        ]);

    }
}
