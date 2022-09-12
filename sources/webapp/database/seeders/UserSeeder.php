<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Founder
         */

        User::factory()->create([
            'name' => 'Dani­el Brug­ger',
            'title' => 'MLaw, Rechts­an­walt',
            'occupation' => 'Gerichts­schrei­ber am Bun­des­ge­richt und Grün­der des Online­kom­men­tars',
            'practice' => 'Gründer &amp; Gesamtherausgeber',
            'linkedin_url' => 'https://www.linkedin.com/in/daniel-brugger-90547474/',
            'website_url' => '',
        ]);
        
        /*
         * Authors
         */

        User::factory()->create([
            'name' => 'Mar­co Zol­lin­ger',
            'title' => 'Dr. iur., Rechts­an­walt',
            'occupation' => 'Gerichts­schrei­ber am Schwei­ze­ri­schen Bun­des­ge­richt',
            'practice' => 'Bundesverfassung',
            'linkedin_url' => '',
            'website_url' => '',
        ]);

        User::factory()->create([
            'name' => 'Mar­c\'An­to­nio Iten-Chen',
            'title' => 'Dr.iur.',
            'occupation' => 'Erb­schafts- und Steu­er­be­ra­ter',
            'practice' => 'Zivilgesetzbuch',
            'linkedin_url' => 'https://www.linkedin.com/in/dr-iur-marc-antonio-iten-chen-5281b997/',
            'website_url' => '',
        ]);

        User::factory()->create([
            'name' => 'Yan­nick Min­nig',
            'title' => 'Dr. iur., Rechts­an­walt',
            'occupation' => 'Habi­li­tand und Ober­as­sis­tent am Zivi­lis­ti­schen Semi­nar der Uni­ver­si­tät Bern',
            'practice' => 'Zivilgesetzbuch',
            'linkedin_url' => '',
            'website_url' => 'https://www.ziv.unibe.ch/ueber_uns/personen/personen_abt_prof_wolf/dr_iur_minnig_yannick/index_ger.html',
        ]);

        User::factory()->create([
            'name' => 'San­dra Strahm',
            'title' => 'MLaw, Rechts­an­wäl­tin',
            'occupation' => '',
            'practice' => 'Zivilgesetzbuch',
            'linkedin_url' => 'https://www.linkedin.com/in/sandra-strahm-933050141/',
            'website_url' => '',
        ]);

        User::factory()->create([
            'name' => 'San­dra Viert­ler',
            'title' => 'Magis­tra',
            'occupation' => 'Uni­ver­si­täts­as­sis­ten­tin und Dok­to­ran­din an der Uni­ver­si­tät Inns­bruck',
            'practice' => 'Zivilgesetzbuch',
            'linkedin_url' => '',
            'website_url' => 'https://www.ziv.unibe.ch/ueber_uns/personen/personen_abt_prof_wolf/ehemalige_abt_wolf/viertler_sandra/index_ger.html',
        ]);

        User::factory()->create([
            'name' => 'Peter Bar­mett­ler',
            'title' => 'Dr.oec.',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/dr-oec-peter-barmettler-33b051115/',
            'website_url' => '',
        ]);

        User::factory()->create([
            'name' => 'Ema­nu­el Bit­tel',
            'title' => 'Dr.iur, Rechts­an­walt',
            'occupation' => 'Gerichts­schrei­ber am Bun­des­ge­richt',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/emanuel-bittel/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Valen­tin Bot­te­ron',
            'title' => 'Dr.iur, Rechts­an­walt',
            'occupation' => 'Gerichts­schrei­ber am Bun­des­ge­richt',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/valentinbotteron/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Patric Brand',
            'title' => 'Dr.iur, Rechts­an­walt, LL.M.',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/patric-brand-174a22188/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Susan­ne Brütsch',
            'title' => 'MLaw, Rechts­an­wäl­tin',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/susanne-br%C3%BCtsch-5a3a22109/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Rena­to Bucher',
            'title' => 'MLaw, LL.M., Rechts­an­walt',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/renatobucher/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Andre­as Diet­schi',
            'title' => 'MLaw',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/andreas-dietschi-557a85161/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Lucas For­rer',
            'title' => 'MLaw, Juni­or Asso­cia­te',
            'occupation' => 'Dok­to­rand an der Uni­ver­si­tät Zürich',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/lucasforrer/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Dario Gal­li',
            'title' => 'MLaw, LL.M., Rechts­an­walt',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/dario-galli-65b460124/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Mar­cel Grie­sin­ger',
            'title' => 'Rechts­an­walt',
            'occupation' => 'Wis­sen­schaft­li­cher Mitarbeiter/Dozent',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/marcel-griesinger-9873a396/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Clau­dio Gür',
            'title' => 'M.A. HSG in Law and Eco­no­mics, Rechts­an­walt',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/claudio-gur/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Jan Hel­ler',
            'title' => 'MLaw',
            'occupation' => 'Anwalts­prak­ti­kant',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/jan-heller-864546149/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'David P. Hen­ry',
            'title' => 'Dr.iur. HSG, LL.M., Rechts­an­walt',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/dphenry/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Sarah Lei­en­de­cker',
            'title' => 'Dipl. Jur.',
            'occupation' => 'Wis­sen­schaft­li­che Mit­ar­bei­te­rin und juris­ti­sche Pod­cas­te­rin',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/sarah-leiendecker/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Lukas Mül­ler',
            'title' => 'Prof. Dr.oec. HSG, Rechts­an­walt',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/lukas-m%C3%BCller-b03441b0/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Mat­thi­as Mül­ler',
            'title' => 'MLaw',
            'occupation' => 'Juni­or Asso­cia­te',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/mattpamueller/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Anne Mir­jam Schneuw­ly',
            'title' => 'Dr.iur., Rechts­an­wäl­tin',
            'occupation' => 'Exe­cu­ti­ve M.B.L.-HSG, Ober­as­sis­ten­tin an der Uni­ver­si­tät Zürich',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/anne-mirjam-schneuwly-32b65159/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Jean-Pas­cal Stoll',
            'title' => 'MLaw',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/jean-pascal-stoll-8b2889205/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Mar­kus Vischer',
            'title' => 'Dr.iur, LL.M., Rechts­an­walt',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/markus-vischer-30193714b/',
            'website_url' => '',
        ]);

        User::factory()->create([
            'name' => 'Oli­ver D. Wil­liam',
            'title' => 'Dr. iur., Rechts­an­walt',
            'occupation' => 'Lehr­be­auf­trag­ter und Seni­or Rese­ar­cher am Zivi­lis­ti­schen Semi­nar der Uni­ver­si­tät Bern',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/oliver-d-william-bb3899115/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Cla­ris­se von Wunsch­heim',
            'title' => 'Dr.iur, Rechts­an­wäl­tin',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/clarisse-von-wunschheim-950561/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Pas­cal Zys­set',
            'title' => 'Dr.iur., Rechts­an­walt und Notar',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/pascal-zysset-100738b2/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Ben­ja­min Dome­nig',
            'title' => 'M.A. HSG in Law and Eco­no­mics, Rechts­an­walt',
            'occupation' => '',
            'practice' => 'Zivilverfahrensrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/benjamin-domenig/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Jac­ques Douz­als',
            'title' => 'MLaw, LL.M., Rechts­an­walt',
            'occupation' => 'Gerichts­schrei­ber am Bun­des­ge­richt',
            'practice' => 'Zivilverfahrensrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/jacquesdouzals/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Lau­rent Gro­bé­ty',
            'title' => 'Dr. iur., Rechts­an­walt',
            'occupation' => 'Lehr­be­auf­trag­ter an der Fern­Uni Schweiz und an der Uni­ver­si­tät Frei­burg',
            'practice' => 'Zivilverfahrensrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/laurent-grob%C3%A9ty-39033163/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Adri­en­ne Hen­ne­mann',
            'title' => 'lic.iur., Rechts­an­wäl­tin',
            'occupation' => '',
            'practice' => 'Zivilverfahrensrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/adrienne-hennemann-2a325619b/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Patrick Hon­eg­ger-Mün­te­ner',
            'title' => 'MLaw, Rechts­an­walt',
            'occupation' => 'Wis­sen­schaft­li­cher Assis­tent und Dok­to­rand',
            'practice' => 'Zivilverfahrensrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/patrick-honegger-m%C3%BCntener-a7496b8a/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Alex­an­der Kist­ler',
            'title' => 'MLaw, Rechts­an­walt, LL.M.',
            'occupation' => 'Wis­sen­schaft­li­cher Assis­tent und Dok­to­rand',
            'practice' => 'Zivilverfahrensrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/alexander-kistler-a4916739/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Andre­as Schneuw­ly',
            'title' => 'Dr.iur., Rechts­an­walt',
            'occupation' => 'Ersatz­rich­ter am Ober­ge­richt des Kan­tons Aar­gau und Gerichts­schrei­ber am Han­dels­ge­richt des Kan­tons Aar­gau',
            'practice' => 'Zivilverfahrensrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/andreas-schneuwly-463981b6/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Loïc Stucki',
            'title' => 'MLaw',
            'occupation' => 'Wis­sen­schaft­li­cher Assis­tent an der Uni­ver­si­tät Bern',
            'practice' => 'Zivilverfahrensrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/lo%C3%AFc-stucki-7a769b192/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Domi­nik Mila­ni',
            'title' => 'Dr.iur., Rechts­an­walt',
            'occupation' => '',
            'practice' => 'Schuldbetreibungs- und Konkursrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/dominik-milani-244542b3/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Fré­dé­ric Erard',
            'title' => 'Dr.iur., Rechts­an­walt',
            'occupation' => 'Seni­or Legal Offi­cer',
            'practice' => 'Strafrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/fr%C3%A9d%C3%A9ric-erard-41115378/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Mari­an­ne Johan­na Lehm­kuhl',
            'title' => 'Prof. Dr.iur.',
            'occupation' => 'Ordi­na­ria für Straf­recht, Wirt­schafts- und inter­na­tio­na­les Straf­recht / Vize­de­ka­nin der Rechts­wis­sen­schaft­li­chen Fakul­tät der Uni­ver­si­tät Bern',
            'practice' => 'Strafrecht',
            'linkedin_url' => '',
            'website_url' => 'https://www.krim.unibe.ch/ueber_uns/personen/prof_dr_lehmkuhl_marianne_johanna/index_ger.html',
        ]);
        
        User::factory()->create([
            'name' => 'Nico­las Leu',
            'title' => 'Dr.iur.',
            'occupation' => 'Jurist Straf­rechts­dienst',
            'practice' => 'Strafrecht',
            'linkedin_url' => '',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'André Tan­ner',
            'title' => 'MLaw',
            'occupation' => 'Seni­or Com­pli­an­ce Offi­cer AML',
            'practice' => 'Strafrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/andr%C3%A9tanner/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Made­lei­ne von Rotz-Laager',
            'title' => 'Dr.iur',
            'occupation' => 'Finan­cial Crime Com­pli­an­ce Offi­cer',
            'practice' => 'Strafrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/dr-madeleine-von-rotz-laager-084a87a1/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Jonas Weber',
            'title' => 'Prof. Dr.iur.',
            'occupation' => 'Ordi­na­ri­us für Straf­recht und Kri­mi­no­lo­gie, geschäfts­füh­ren­der Direk­tor des Depar­te­ments für Straf­recht der Uni­ver­si­tät Bern',
            'practice' => 'Strafrecht',
            'linkedin_url' => '',
            'website_url' => 'https://www.krim.unibe.ch/ueber_uns/personen/prof_dr_weber_jonas/index_ger.html',
        ]);
        
        User::factory()->create([
            'name' => 'Jan Wenk',
            'title' => 'MLaw',
            'occupation' => 'Wis­sen­schaft­li­cher Assis­tent an der Uni­ver­si­tät Bern',
            'practice' => 'Strafrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/jan-wenk-b46629160/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Kon­rad Jeker',
            'title' => 'lic.iur, Rechts­an­walt',
            'occupation' => 'Fach­an­walt SAV Straf­recht',
            'practice' => 'Strafprozessrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/konrad-jeker-a756a1149/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Mar­kus J. Mei­er',
            'title' => 'MLaw, Rechts­an­walt',
            'occupation' => 'Straf­ver­tei­di­ger',
            'practice' => 'Strafprozessrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/markus-j-meier-611a3299/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Tobi­as Schaff­ner',
            'title' => 'Dr.iur., LL.M., Rechts­an­walt',
            'occupation' => '',
            'practice' => 'Strafprozessrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/tobias-schaffner-08a586141/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Caro­li­ne Schär',
            'title' => 'MLaw, Rechts­an­wäl­tin',
            'occupation' => 'Gerichts­schrei­be­rin am Bun­des­ge­richt, Ersatz­rich­te­rin am Ober­ge­richt des Kan­tons Aar­gau',
            'practice' => 'Strafprozessrecht',
            'linkedin_url' => '',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Kris­ti­na Schwab',
            'title' => 'MLaw',
            'occupation' => 'Juris­tin',
            'practice' => 'Strafprozessrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/kristina-schwab-b30833156/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Deni­se Wein­gart',
            'title' => 'Dr.iur, Rechts­an­wäl­tin',
            'occupation' => 'Gerichts­prä­si­den­tin Regio­nal­ge­richt Ber­ner Jura-See­land, Ersatz­rich­te­rin am Ober­ge­richt Bern',
            'practice' => 'Strafprozessrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/denise-weingart-766b33157/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Lea Hun­ger­büh­ler',
            'title' => 'Rechts­an­wäl­tin, LL.M.',
            'occupation' => '',
            'practice' => 'Migrationsrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/lea-hungerb%C3%BChler-37b99a107/',
            'website_url' => '',
        ]);

        /*
         * Editors
         */

        User::factory()->create([
            'name' => 'Odile Ammann',
            'title' => 'Prof. Dr.iur., LL.M.',
            'occupation' => 'Professeure associée an der Universität Lausanne',
            'practice' => 'Bundesverfassung',
            'linkedin_url' => '',
            'website_url' => '',
        ]);

        User::factory()->create([
            'name' => 'Stefan Schlegel',
            'title' => 'Dr.iur',
            'occupation' => 'SNF Ambizione Fellow am Institut für öffentliches Recht der Universität Bern',
            'practice' => 'Bundesverfassung',
            'linkedin_url' => '',
            'website_url' => '',
        ]);

        User::factory()->create([
            'name' => 'Christoph Hurni',
            'title' => 'PD Dr.iur.',
            'occupation' => 'Bundesrichter',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => '',
            'website_url' => '',
        ]);

        User::factory()->create([
            'name' => 'Mirjam Eggen',
            'title' => 'Prof. Dr.iur',
            'occupation' => 'Ordentliche Professorin für Privatrecht an der Universität Bern',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => '',
            'website_url' => '',
        ]);

        User::factory()->create([
            'name' => 'Sonja Koch',
            'title' => 'Dr.iur.',
            'occupation' => 'Bundesrichterin',
            'practice' => 'Strafprozessrecht',
            'linkedin_url' => '',
            'website_url' => '',
        ]);

        /*
         * Fake users
         */

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com'
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'Editor',
            'email' => 'editor@test.com'
        ])->assignRole('editor');

        User::factory()->create([
            'name' => 'Author',
            'email' => 'author@test.com',
        ])->assignRole('author');

        User::factory()->create([
            'name' => 'Unknown',
            'email' => 'unknown@test.com',
        ]);
    }
}
