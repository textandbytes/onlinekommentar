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
        /*
         * Bundesverfassung (BV)
         */

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
            'parent_id' => 2,
            'sort'      => 1,
            'label_de'  => '3. Titel: Bund, Kantone und Gemeinden',
            'label_en'  => '3. Titel: Bund, Kantone und Gemeinden',
            'label_fr'  => '3. Titel: Bund, Kantone und Gemeinden',
            'label_it'  => '3. Titel: Bund, Kantone und Gemeinden'
        ]);

        DocumentTree::Factory()->create([
            'id'        => 4,
            'parent_id' => 3,
            'sort'      => 1,
            'label_de'  => '1. Kapitel: Verhältnis von Bund und Kantonen',
            'label_en'  => '1. Kapitel: Verhältnis von Bund und Kantonen',
            'label_fr'  => '1. Kapitel: Verhältnis von Bund und Kantonen',
            'label_it'  => '1. Kapitel: Verhältnis von Bund und Kantonen'
        ]);

        DocumentTree::Factory()->create([
            'id'        => 5,
            'parent_id' => 3,
            'sort'      => 2,
            'label_de'  => '2. Kapitel: Zuständigkeiten',
            'label_en'  => '2. Kapitel: Zuständigkeiten',
            'label_fr'  => '2. Kapitel: Zuständigkeiten',
            'label_it'  => '2. Kapitel: Zuständigkeiten'
        ]);

        DocumentTree::Factory()->create([
            'id'        => 6,
            'parent_id' => 5,
            'sort'      => 1,
            'label_de'  => '3. Abschnitt: Bildung, Forschung und Kultur Art. 61a – Art. 72',
            'label_en'  => '3. Abschnitt: Bildung, Forschung und Kultur Art. 61a – Art. 72',
            'label_fr'  => '3. Abschnitt: Bildung, Forschung und Kultur Art. 61a – Art. 72',
            'label_it'  => '3. Abschnitt: Bildung, Forschung und Kultur Art. 61a – Art. 72'
        ]);

        DocumentTree::Factory()->create([
            'id'         => 7,
            'parent_id'  => 6,
            'sort'       => 1,
            'label_de'   => 'Art. 68 BV Sport',
            'label_en'   => 'Art. 68 FC Sport',
            'label_fr'   => 'Art. 68 Cst. Sport',
            'label_it'   => 'Art. 68 Cost. Sport',
            'content_de' => '
                <p><sup>1</sup>&nbsp;Der Bund fördert den Sport, ins­be­son­de­re die Ausbildung.</p>
                <p><sup>2</sup>&nbsp;Er betreibt eine Sportschule.</p>
                <p><sup>3</sup>&nbsp;Er kann Vor­schrif­ten über den Jugend­sport erlas­sen und den Sport­un­ter­richt an Schu­len obli­ga­to­risch erklären.</p>
            ',
            'content_en' => '
                <p><sup>1</sup>&nbsp;The Confederation shall encourage sport, and in particular education in sport.</p>
                <p><sup>2</sup>&nbsp;It shall operate a sports school.</p>
                <p><sup>3</sup>&nbsp;It may issue regulations on sport for young people and declare the teaching of sport in schools to be compulsory.</p>'
            ,
            'content_fr' => '
                <p><sup>1</sup>&nbsp;La Confédération encourage le sport, en particulier la formation au sport.</p>
                <p><sup>2</sup>&nbsp;Elle gère une école de sport.</p>
                <p><sup>3</sup>&nbsp;Elle peut légiférer sur la pratique du sport par les jeunes et déclarer obligatoire l\'enseignement du sport dans les écoles.</p>
            ',
            'content_it' => '
                <p><sup>1</sup>&nbsp;La Confederazione promuove lo sport, in particolare l\'educazione sportiva.</p>
                <p><sup>2</sup>&nbsp;Gestisce una scuola di sport.</p>
                <p><sup>3</sup>&nbsp;Può emanare prescrizioni sullo sport giovanile e dichiarare obbligatorio l\'insegnamento dello sport nelle scuole.</p>
            ',
            'node_type'  => 'leaf',
        ]);


        /*
         * Obligationenrecht (OR)
         */

        DocumentTree::Factory()->create([
            'id'        => 8,
            'parent_id' => 1,
            'sort'      => 2,
            'label_de'  => 'Obligationenrecht (OR)',
            'label_en'  => 'Obligationenrecht (OR)',
            'label_fr'  => 'Obligationenrecht (OR)',
            'label_it'  => 'Obligationenrecht (OR)'
        ]);

        DocumentTree::Factory()->create([
            'id'         => 9,
            'parent_id'  => 8,
            'sort'       => 1,
            'label_de'   => 'Art. 11 OR',
            'label_en'   => 'Art. 11 CO',
            'label_fr'   => 'Art. 11 CO',
            'label_it'   => 'Art. 11 CO',
            'content_de' => '
                <p><sup>1</sup>&nbsp;Verträge bedürfen zu ihrer Gültigkeit nur dann einer besonderen Form, wenn das Gesetz eine solche vorschreibt.</p>
                <p><sup>2</sup>&nbsp;Ist über Bedeutung und Wirkung einer gesetzlich vorgeschriebenen Form nicht etwas anderes bestimmt, so hängt von deren Beobachtung die Gültigkeit des Vertrages ab.</p>
            ',
            'content_en' => '
                <p><sup>1</sup>&nbsp;The validity of a contract is not subject to compliance with any particular form unless a particular form is prescribed by law.</p>
                <p><sup>2</sup>&nbsp;In the absence of any provision to the contrary on the significance and effect of formal requirements prescribed by law, the contract is valid only if such requirements are satisfied.</p>
            ',
            'content_fr' => '
                <p><sup>1</sup>&nbsp;La validité des contrats n\'est subordonnée à l\'observation d\'une forme particulière qu\'en vertu d\'une prescription spéciale de la loi.</p>
                <p><sup>2</sup>&nbsp;À défaut d\'une disposition contraire sur la portée et les effets de la forme prescrite, le contrat n\'est valable que si cette forme a été observée.</p>
            ',
            'content_it' => '
                <p><sup>1</sup>&nbsp;Per la validità dei contratti non si richiede alcuna forma speciale, se questa non sia prescritta dalla legge.</p>
                <p><sup>2</sup>&nbsp;Ove non sia diversamente stabilito circa l\'importanza e l\'efficacia d\'una forma legalmente prescritta, dalla osservanza di questa dipende la validità del contratto.</p>
            ',
            'node_type'  => 'leaf',
        ]);

        DocumentTree::Factory()->create([
            'id'         => 10,
            'parent_id'  => 8,
            'sort'       => 2,
            'label_de'   => 'Art. 143 OR',
            'label_en'   => 'Art. 143 CO',
            'label_fr'   => 'Art. 143 CO',
            'label_it'   => 'Art. 143 CO',
            'content_de' => '
                <p><sup>1</sup>&nbsp;Solidarität unter mehreren Schuldnern entsteht, wenn sie erklären, dass dem Gläubiger gegenüber jeder einzeln für die Erfüllung der ganzen Schuld haften wolle.</p>
                <p><sup>2</sup>&nbsp;Ohne solche Willenserklärung entsteht Solidarität nur in den vom Gesetze bestimmten Fällen.</p>
            ',
            'content_en' => '
                <p><sup>1</sup>&nbsp;Debtors become jointly and severally liable for a debt by stating that each of them wishes to be individually liable for performance of the entire obligation.</p>
                <p><sup>2</sup>&nbsp;Without such a statement of intent, debtors are joint and severally liable only in the cases specified by law.</p>
            ',
            'content_fr' => '
                <p><sup>1</sup>&nbsp;Il y a solidarité entre plusieurs débiteurs lorsqu\'ils déclarent s\'obliger de manière qu\'à l\'égard du créancier chacun d\'eux soit tenu pour le tout.</p>
                <p><sup>2</sup>&nbsp;À défaut d\'une semblable déclaration, la solidarité n\'existe que dans les cas prévus par la loi.</p>
            ',
            'content_it' => '
                <p><sup>1</sup>&nbsp;Vi ha solidarietà fra più debitori quando essi dichiarano di obbligarsi verso il creditore ciascuno singolarmente all\'adempimento dell\'intera obbligazione.</p>
                <p><sup>2</sup>&nbsp;Senza tale dichiarazione di volontà non sorge solidarietà che nei casi determinati dalla legge.</p>
            ',
            'node_type'  => 'leaf',
        ]);

        DocumentTree::Factory()->create([
            'id'         => 11,
            'parent_id'  => 8,
            'sort'       => 3,
            'label_de'   => '<p>3. Universalversammlung</p><p>Art. 701 OR</p>',
            'label_en'   => '<p>3. Universal meeting</p><p>Art. 701 CO</p>',
            'label_fr'   => '<p>3. Réunion de tous les actionnaires</p><p>Art. 701 CO</p>',
            'label_it'   => '<p>3. Riunione di tutti gli azionisti</p><p>Art. 701 CO</p>',
            'content_de' => '
                <p><sup>1</sup>&nbsp;Die Eigentümer oder Vertreter sämtlicher Aktien können, falls kein Widerspruch erhoben wird, eine Generalversammlung ohne Einhaltung der für die Einberufung vorgeschriebenen Formvorschriften abhalten.</p>
                <p><sup>2</sup>&nbsp;In dieser Versammlung kann über alle in den Geschäftskreis der Generalversammlung fallenden Gegenstände gültig verhandelt und Beschluss gefasst werden, solange die Eigentümer oder Vertreter sämtlicher Aktien anwesend sind.</p>
            ',
            'content_en' => '
                <p><sup>1</sup>&nbsp;The owners or representatives of all the company\'s shares may, if no objection is raised, hold a general meeting without complying with the formal requirements for convening meetings.</p>
                <p><sup>2</sup>&nbsp;This meeting may hold validly discuss and pass binding resolutions on all matters within the remit of the general meeting, provided that the owners or representatives of all the shares are present.</p>
            ',
            'content_fr' => '
                <p><sup>1</sup>&nbsp;Les propriétaires ou les représentants de la totalité des actions peuvent, s\'il n\'y a pas d\'opposition, tenir une assemblée générale sans observer les formes prévues pour sa convocation.</p>
                <p><sup>2</sup>&nbsp;Aussi longtemps qu\'ils sont présents, cette assemblée a le droit de délibérer et de statuer valablement sur tous les objets qui sont du ressort de l\'assemblée générale.</p>
            ',
            'content_it' => '
                <p><sup>1</sup>&nbsp;I proprietari o i rappresentanti di tutte le azioni possono, purché nessuno vi si opponga, tenere un\'assemblea generale anche senza osservare le formalità prescritte per la convocazione.</p>
                <p><sup>2</sup>&nbsp;Finché i proprietari od i rappresentanti di tutte le azioni sono presenti, siffatta assemblea può validamente trattare tutti gli argomenti di spettanza dell\'assemblea generale e deliberare su di essi.</p>
            ',
            'node_type'  => 'leaf',
        ]);



        /*
         * Bundesgesetz über das Internationale Privatrecht (IPRG)
         */

        DocumentTree::Factory()->create([
            'id'        => 12,
            'parent_id' => 1,
            'sort'      => 3,
            'label_de'  => 'Bundesgesetz über das Internationale Privatrecht (IPRG)',
            'label_en'  => 'Bundesgesetz über das Internationale Privatrecht (IPRG)',
            'label_fr'  => 'Bundesgesetz über das Internationale Privatrecht (IPRG)',
            'label_it'  => 'Bundesgesetz über das Internationale Privatrecht (IPRG)'
        ]);

        DocumentTree::Factory()->create([
            'id'         => 13,
            'parent_id'  => 12,
            'sort'       => 1,
            'label_de'   => 'Art. 20 IPRG',
            'label_en'   => 'Art. 20 PILA',
            'label_fr'   => 'Art. 20 LDIP',
            'label_it'   => 'Art. 20 LDIP',
            'content_de' => '
                <p><sup>1</sup>&nbsp;Im Sinne dieses Gesetzes hat eine natürliche Person:</p>
                <p><sup>a.</sup>&nbsp;ihren Wohnsitz in dem Staat, in dem sie sich mit der Absicht dauernden Verbleibens aufhält;</p>
                <p><sup>b.</sup>&nbsp;ihren gewöhnlichen Aufenthalt in dem Staat, in dem sie während längerer Zeit lebt, selbst wenn diese Zeit zum vornherein befristet ist;</p>
                <p><sup>c.</sup>&nbsp;ihre Niederlassung in dem Staat, in dem sich der Mittelpunkt ihrer geschäftlichen Tätigkeit befindet.</p>
                <p><sup>2</sup>&nbsp;Niemand kann an mehreren Orten zugleich Wohnsitz haben. Hat eine Person nirgends einen Wohnsitz, so tritt der gewöhnliche Aufenthalt an die Stelle des Wohnsitzes. Die Bestimmungen des Zivilgesetzbuches über Wohnsitz und Aufenthalt sind nicht anwendbar.</p>
            ',
            'content_en' => '
                <p><sup>1</sup>&nbsp;Within the meaning of this Act, a natural person:</p>
                <p><sup>a.</sup>&nbsp;has their domicile in the state where they reside with the intent of establishing permanent residence;</p>
                <p><sup>b.</sup>&nbsp;has their habitual residence in the state where they live for a certain period of time, even if this period is of limited duration from the outset;</p>
                <p><sup>c.</sup>&nbsp;has their establishment in the state where the centre of their professional or commercial activities is located.</p>
                <p><sup>2</sup>&nbsp;No person may have more than one domicile at the same time. If a person does not have a domicile anywhere, the habitual residence is the relevant place. The provisions of the Civil Code relating to domicile and residence do not apply.</p>
            ',
            'content_fr' => '
                <p><sup>1</sup>&nbsp;Au sens de la présente loi, une personne physique:</p>
                <p><sup>a.</sup>&nbsp;a son domicile dans l\'État dans lequel elle réside avec l\'intention de s\'y établir;</p>
                <p><sup>b.</sup>&nbsp;a sa résidence habituelle dans l\'État dans lequel elle vit pendant une certaine durée, même si cette durée est de prime abord limitée;</p>
                <p><sup>c.</sup>&nbsp;a son établissement dans l\'État dans lequel se trouve le centre de ses activités professionnelles ou commerciales.</p>
                <p><sup>2</sup>&nbsp;Nul ne peut avoir en même temps plusieurs domiciles. Si une personne n\'a nulle part de domicile, la résidence habituelle est déterminante. Les dispositions du code civil suisse relatives au domicile et à la résidence ne sont pas applicables.</p>
            ',
            'content_it' => '
                <p><sup>1</sup>&nbsp;Giusta la presente legge, la persona fisica ha:</p>
                <p><sup>a.</sup>&nbsp;il domicilio nello Stato dove dimora con l\'intenzione di stabilirvisi durevolmente;</p>
                <p><sup>b.</sup>&nbsp;la dimora abituale nello Stato dove vive per una certa durata, anche se tale durata è limitata a priori;</p>
                <p><sup>c.</sup>&nbsp;la stabile organizzazione nello Stato dove si trova il centro della sua attività economica.</p>
                <p><sup>2</sup>&nbsp;Nessuno può avere contemporaneamente il suo domicilio in più luoghi. In mancanza di domicilio, fa stato la dimora abituale. Le disposizioni del Codice civile svizzero concernenti il domicilio e la dimora non sono applicabili.</p>
            ',
            'node_type'  => 'leaf',
        ]);


        /*
         * Lugano-Übereinkommen (LugÜ)
         */

        DocumentTree::Factory()->create([
            'id'        => 14,
            'parent_id' => 1,
            'sort'      => 4,
            'label_de'  => 'Lugano-Übereinkommen (LugÜ)',
            'label_en'  => 'Lugano-Übereinkommen (LugÜ)',
            'label_fr'  => 'Lugano-Übereinkommen (LugÜ)',
            'label_it'  => 'Lugano-Übereinkommen (LugÜ)'
        ]);

        DocumentTree::Factory()->create([
            'id'         => 15,
            'parent_id'  => 14,
            'sort'       => 1,
            'label_de'   => 'Art. 32 LugÜ',
            'label_en'   => '',
            'label_fr'   => 'Art. 32 CL',
            'label_it'   => 'Art. 32 CLug',
            'content_de' => '
                <p>Unter «Entscheidung» im Sinne dieses Übereinkommens ist jede Entscheidung zu verstehen, die von einem Gericht eines durch dieses Übereinkommen gebundenen Staates erlassen worden ist, ohne Rücksicht auf ihre Bezeichnung wie Urteil, Beschluss, Zahlungsbefehl oder Vollstreckungsbescheid, einschliesslich des Kostenfestsetzungsbeschlusses eines Gerichtsbediensteten.</p>
            ',
            'content_en' => '
                <p></p>
            ',
            'content_fr' => '
                <p>Aux fins de la présente Convention, on entend par «décision» toute décision rendue par une juridiction d\'un Etat lié par la présente Convention quelle que soit la dénomination qui lui est donnée, telle qu\'arrêt, jugement, ordonnance ou mandat d\'exécution, ainsi que la fixation par le greffier du montant des frais du procès.</p>
            ',
            'content_it' => '
                <p>Ai fini della presente convenzione, con «decisione» si intende, a prescindere dalla denominazione usata, qualsiasi decisione emessa da un giudice di uno Stato vincolato dalla presente convenzione, quale ad esempio decreto, sentenza, ordinanza o mandato di esecuzione, nonché la determinazione delle spese giudiziali da parte del cancelliere.</p>
            ',
            'node_type'  => 'leaf',
        ]);


        /*
         * Strafprozessordnung
         */

        DocumentTree::Factory()->create([
            'id'        => 16,
            'parent_id' => 1,
            'sort'      => 5,
            'label_de'  => 'Strafprozessordnung',
            'label_en'  => 'Strafprozessordnung',
            'label_fr'  => 'Strafprozessordnung',
            'label_it'  => 'Strafprozessordnung'
        ]);

        DocumentTree::Factory()->create([
            'id'         => 17,
            'parent_id'  => 16,
            'sort'       => 1,
            'label_de'   => 'Art. 366 StPO Voraussetzungen',
            'label_en'   => 'Art. 366 CrimPC Requirements',
            'label_fr'   => 'Art. 366 CPP Conditions',
            'label_it'   => 'Art. 366 CPP Presupposti',
            'content_de' => '
                <p><sup>1</sup>&nbsp;Bleibt eine ordnungsgemäss vorgeladene beschuldigte Person der erstinstanzlichen Hauptverhandlung fern, so setzt das Gericht eine neue Verhandlung an und lädt die Person dazu wiederum vor oder lässt sie vorführen. Es erhebt die Beweise, die keinen Aufschub ertragen.</p>
                <p><sup>2</sup>&nbsp;Erscheint die beschuldigte Person zur neu angesetzten Hauptverhandlung nicht oder kann sie nicht vorgeführt werden, so kann die Hauptverhandlung in ihrer Abwesenheit durchgeführt werden. Das Gericht kann das Verfahren auch sistieren.</p>
                <p><sup>3</sup>&nbsp;Hat sich die beschuldigte Person selber in den Zustand der Verhandlungsunfähigkeit versetzt oder weigert sie sich, aus der Haft zur Hauptverhandlung vorgeführt zu werden, so kann das Gericht sofort ein Abwesenheitsverfahren durchführen.</p>
                <p><sup>4</sup>&nbsp;Ein Abwesenheitsverfahren kann nur stattfinden, wenn:</p>
                <p><sup>a.</sup>&nbsp;die beschuldigte Person im bisherigen Verfahren ausreichend Gelegenheit hatte, sich zu den ihr vorgeworfenen Straftaten zu äussern; und</p>
                <p><sup>b.</sup>&nbsp;die Beweislage ein Urteil ohne ihre Anwesenheit zulässt.</p>
            ',
            'content_en' => '
                <p><sup>1</sup>&nbsp;If an accused who has been duly summoned fails to appear before the court of first instance, the court shall fix a new hearing and summon the person again or arrange for him or her to be brought before the court. It shall take evidence where this cannot be delayed.</p>
                <p><sup>2</sup>&nbsp;If the accused fails to appear for the re-arranged main hearing or if it is not possible to bring him or her before the court, the main hearing may be held in the absence of the accused. The court may also suspend the proceedings.</p>
                <p><sup>3</sup>&nbsp;If the accused is suffering from a voluntarily induced unfitness to plead or if he or she refuses to be brought from detention to the main hearing, the court may conduct proceedings immediately in absentia.</p>
                <p><sup>4</sup>&nbsp;Proceedings in absentia may only be held if:</p>
                <p><sup>a.</sup>&nbsp;the accused has previously had adequate opportunity in the proceedings to comment on the offences of which he or she is accused</p>
                <p><sup>b.</sup>&nbsp;sufficient evidence is available to reach a judgment without the presence of the accused.</p>
            ',
            'content_fr' => '
                <p><sup>1</sup>&nbsp;Si le prévenu, dûment cité, ne comparaît pas aux débats de première instance, le tribunal fixe de nouveaux débats et cite à nouveau le prévenu ou le fait amener. Il recueille les preuves dont l\'administration ne souffre aucun délai.</p>
                <p><sup>2</sup>&nbsp;Si le prévenu ne se présente pas aux nouveaux débats ou ne peut y être amené, ils peuvent être conduits en son absence. Le tribunal peut aussi suspendre la procédure.</p>
                <p><sup>3</sup>&nbsp;Si le prévenu s\'est lui-même mis dans l\'incapacité de participer aux débats ou s\'il refuse d\'être amené de l\'établissement de détention aux débats, le tribunal peut engager aussitôt la procédure par défaut.</p>
                <p><sup>4</sup>&nbsp;La procédure par défaut ne peut être engagée qu\'aux conditions suivantes:</p>
                <p><sup>a.</sup>&nbsp;le prévenu a eu suffisamment l\'occasion de s\'exprimer auparavant sur les faits qui lui sont reprochés;</p>
                <p><sup>b.</sup>&nbsp;les preuves réunies permettent de rendre un jugement en son absence.</p>
            ',
            'content_it' => '
                <p><sup>1</sup>&nbsp;Se l\'imputato regolarmente citato non si presenta al dibattimento di primo grado, il giudice fissa una nuova udienza e lo cita a comparire o ne dispone l\'accompagnamento coattivo. Assume comunque le prove indifferibili.</p>
                <p><sup>2</sup>&nbsp;Se l\'imputato non si presenta al nuovo dibattimento o non può esservi tradotto, il dibattimento può iniziare in sua assenza. Il giudice può anche sospendere il procedimento.</p>
                <p><sup>3</sup>&nbsp;Qualora l\'imputato si sia posto egli stesso nella situazione di incapacità dibattimentale oppure rifiuti di essere tradotto dal carcere al dibattimento, il giudice può svolgere immediatamente una procedura contumaciale.</p>
                <p><sup>4</sup>&nbsp;La procedura contumaciale può essere svolta soltanto se:</p>
                <p><sup>a.</sup>&nbsp;nel procedimento in corso l\'imputato ha avuto sufficienti opportunità di esprimersi sui reati che gli sono contestati; e</p>
                <p><sup>b.</sup>&nbsp;la situazione probatoria consente la pronuncia di una sentenza anche in assenza dell\'imputato.</p>
            ',
            'node_type'  => 'leaf',
        ]);
    }
}
