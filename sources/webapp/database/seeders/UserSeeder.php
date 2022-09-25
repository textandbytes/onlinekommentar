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
            'name' => 'Daniel Brugger',
            'title' => 'MLaw, Rechtsanwalt',
            'occupation' => 'Gerichtsschreiber am Bundesgericht und Gründer des Onlinekommentars',
            'practice' => 'Gründer &amp; Gesamtherausgeber',
            'linkedin_url' => 'https://www.linkedin.com/in/daniel-brugger-90547474/',
            'website_url' => '',
        ]);
        
        /*
         * Authors
         */

        User::factory()->create([
            'name' => 'Marco Zollinger',
            'title' => 'Dr. iur., Rechtsanwalt',
            'occupation' => 'Gerichtsschreiber am Schweizerischen Bundesgericht',
            'practice' => 'Bundesverfassung',
            'linkedin_url' => '',
            'website_url' => '',
        ]);

        User::factory()->create([
            'name' => 'Marc\'Antonio Iten-Chen',
            'title' => 'Dr.iur.',
            'occupation' => 'Erbschafts- und Steuerberater',
            'practice' => 'Zivilgesetzbuch',
            'linkedin_url' => 'https://www.linkedin.com/in/dr-iur-marc-antonio-iten-chen-5281b997/',
            'website_url' => '',
        ]);

        User::factory()->create([
            'name' => 'Yannick Minnig',
            'title' => 'Dr. iur., Rechtsanwalt',
            'occupation' => 'Habilitand und Oberassistent am Zivilistischen Seminar der Universität Bern',
            'practice' => 'Zivilgesetzbuch',
            'linkedin_url' => '',
            'website_url' => 'https://www.ziv.unibe.ch/ueber_uns/personen/personen_abt_prof_wolf/dr_iur_minnig_yannick/index_ger.html',
        ]);

        User::factory()->create([
            'name' => 'Sandra Strahm',
            'title' => 'MLaw, Rechtsanwältin',
            'occupation' => '',
            'practice' => 'Zivilgesetzbuch',
            'linkedin_url' => 'https://www.linkedin.com/in/sandra-strahm-933050141/',
            'website_url' => '',
        ]);

        User::factory()->create([
            'name' => 'Sandra Viertler',
            'title' => 'Magistra',
            'occupation' => 'Universitätsassistentin und Doktorandin an der Universität Innsbruck',
            'practice' => 'Zivilgesetzbuch',
            'linkedin_url' => '',
            'website_url' => 'https://www.ziv.unibe.ch/ueber_uns/personen/personen_abt_prof_wolf/ehemalige_abt_wolf/viertler_sandra/index_ger.html',
        ]);

        User::factory()->create([
            'name' => 'Peter Barmettler',
            'title' => 'Dr.oec.',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/dr-oec-peter-barmettler-33b051115/',
            'website_url' => '',
        ]);

        User::factory()->create([
            'name' => 'Emanuel Bittel',
            'title' => 'Dr.iur, Rechtsanwalt',
            'occupation' => 'Gerichtsschreiber am Bundesgericht',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/emanuel-bittel/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Valentin Botteron',
            'title' => 'Dr.iur, Rechtsanwalt',
            'occupation' => 'Gerichtsschreiber am Bundesgericht',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/valentinbotteron/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Patric Brand',
            'title' => 'Dr.iur, Rechtsanwalt, LL.M.',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/patric-brand-174a22188/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Susanne Brütsch',
            'title' => 'MLaw, Rechtsanwältin',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/susanne-br%C3%BCtsch-5a3a22109/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Renato Bucher',
            'title' => 'MLaw, LL.M., Rechtsanwalt',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/renatobucher/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Andreas Dietschi',
            'title' => 'MLaw',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/andreas-dietschi-557a85161/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Lucas Forrer',
            'title' => 'MLaw, Junior Associate',
            'occupation' => 'Doktorand an der Universität Zürich',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/lucasforrer/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Dario Galli',
            'title' => 'MLaw, LL.M., Rechtsanwalt',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/dario-galli-65b460124/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Marcel Griesinger',
            'title' => 'Rechtsanwalt',
            'occupation' => 'Wissenschaftlicher Mitarbeiter/Dozent',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/marcel-griesinger-9873a396/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Claudio Gür',
            'title' => 'M.A. HSG in Law and Economics, Rechtsanwalt',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/claudio-gur/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Jan Heller',
            'title' => 'MLaw',
            'occupation' => 'Anwaltspraktikant',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/jan-heller-864546149/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'David P. Henry',
            'title' => 'Dr.iur. HSG, LL.M., Rechtsanwalt',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/dphenry/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Sarah Leiendecker',
            'title' => 'Dipl. Jur.',
            'occupation' => 'Wissenschaftliche Mitarbeiterin und juristische Podcasterin',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/sarah-leiendecker/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Lukas Müller',
            'title' => 'Prof. Dr.oec. HSG, Rechtsanwalt',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/lukas-m%C3%BCller-b03441b0/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Matthias Müller',
            'title' => 'MLaw',
            'occupation' => 'Junior Associate',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/mattpamueller/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Anne Mirjam Schneuwly',
            'title' => 'Dr.iur., Rechtsanwältin',
            'occupation' => 'Executive M.B.L.-HSG, Oberassistentin an der Universität Zürich',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/anne-mirjam-schneuwly-32b65159/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Jean-Pascal Stoll',
            'title' => 'MLaw',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/jean-pascal-stoll-8b2889205/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Markus Vischer',
            'title' => 'Dr.iur, LL.M., Rechtsanwalt',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/markus-vischer-30193714b/',
            'website_url' => '',
        ]);

        User::factory()->create([
            'name' => 'Oliver D. William',
            'title' => 'Dr. iur., Rechtsanwalt',
            'occupation' => 'Lehrbeauftragter und Senior Researcher am Zivilistischen Seminar der Universität Bern',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/oliver-d-william-bb3899115/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Clarisse von Wunschheim',
            'title' => 'Dr.iur, Rechtsanwältin',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/clarisse-von-wunschheim-950561/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Pascal Zysset',
            'title' => 'Dr.iur., Rechtsanwalt und Notar',
            'occupation' => '',
            'practice' => 'Obligationenrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/pascal-zysset-100738b2/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Benjamin Domenig',
            'title' => 'M.A. HSG in Law and Economics, Rechtsanwalt',
            'occupation' => '',
            'practice' => 'Zivilverfahrensrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/benjamin-domenig/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Jacques Douzals',
            'title' => 'MLaw, LL.M., Rechtsanwalt',
            'occupation' => 'Gerichtsschreiber am Bundesgericht',
            'practice' => 'Zivilverfahrensrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/jacquesdouzals/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Laurent Grobéty',
            'title' => 'Dr. iur., Rechtsanwalt',
            'occupation' => 'Lehrbeauftragter an der FernUni Schweiz und an der Universität Freiburg',
            'practice' => 'Zivilverfahrensrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/laurent-grob%C3%A9ty-39033163/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Adrienne Hennemann',
            'title' => 'lic.iur., Rechtsanwältin',
            'occupation' => '',
            'practice' => 'Zivilverfahrensrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/adrienne-hennemann-2a325619b/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Patrick Honegger-Müntener',
            'title' => 'MLaw, Rechtsanwalt',
            'occupation' => 'Wissenschaftlicher Assistent und Doktorand',
            'practice' => 'Zivilverfahrensrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/patrick-honegger-m%C3%BCntener-a7496b8a/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Alexander Kistler',
            'title' => 'MLaw, Rechtsanwalt, LL.M.',
            'occupation' => 'Wissenschaftlicher Assistent und Doktorand',
            'practice' => 'Zivilverfahrensrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/alexander-kistler-a4916739/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Andreas Schneuwly',
            'title' => 'Dr.iur., Rechtsanwalt',
            'occupation' => 'Ersatzrichter am Obergericht des Kantons Aargau und Gerichtsschreiber am Handelsgericht des Kantons Aargau',
            'practice' => 'Zivilverfahrensrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/andreas-schneuwly-463981b6/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Loïc Stucki',
            'title' => 'MLaw',
            'occupation' => 'Wissenschaftlicher Assistent an der Universität Bern',
            'practice' => 'Zivilverfahrensrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/lo%C3%AFc-stucki-7a769b192/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Dominik Milani',
            'title' => 'Dr.iur., Rechtsanwalt',
            'occupation' => '',
            'practice' => 'Schuldbetreibungs- und Konkursrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/dominik-milani-244542b3/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Frédéric Erard',
            'title' => 'Dr.iur., Rechtsanwalt',
            'occupation' => 'Senior Legal Officer',
            'practice' => 'Strafrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/fr%C3%A9d%C3%A9ric-erard-41115378/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Marianne Johanna Lehmkuhl',
            'title' => 'Prof. Dr.iur.',
            'occupation' => 'Ordinaria für Strafrecht, Wirtschafts- und internationales Strafrecht / Vizedekanin der Rechtswissenschaftlichen Fakultät der Universität Bern',
            'practice' => 'Strafrecht',
            'linkedin_url' => '',
            'website_url' => 'https://www.krim.unibe.ch/ueber_uns/personen/prof_dr_lehmkuhl_marianne_johanna/index_ger.html',
        ]);
        
        User::factory()->create([
            'name' => 'Nicolas Leu',
            'title' => 'Dr.iur.',
            'occupation' => 'Jurist Strafrechtsdienst',
            'practice' => 'Strafrecht',
            'linkedin_url' => '',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'André Tanner',
            'title' => 'MLaw',
            'occupation' => 'Senior Compliance Officer AML',
            'practice' => 'Strafrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/andr%C3%A9tanner/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Madeleine von Rotz-Laager',
            'title' => 'Dr.iur',
            'occupation' => 'Financial Crime Compliance Officer',
            'practice' => 'Strafrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/dr-madeleine-von-rotz-laager-084a87a1/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Jonas Weber',
            'title' => 'Prof. Dr.iur.',
            'occupation' => 'Ordinarius für Strafrecht und Kriminologie, geschäftsführender Direktor des Departements für Strafrecht der Universität Bern',
            'practice' => 'Strafrecht',
            'linkedin_url' => '',
            'website_url' => 'https://www.krim.unibe.ch/ueber_uns/personen/prof_dr_weber_jonas/index_ger.html',
        ]);
        
        User::factory()->create([
            'name' => 'Jan Wenk',
            'title' => 'MLaw',
            'occupation' => 'Wissenschaftlicher Assistent an der Universität Bern',
            'practice' => 'Strafrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/jan-wenk-b46629160/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Konrad Jeker',
            'title' => 'lic.iur, Rechtsanwalt',
            'occupation' => 'Fachanwalt SAV Strafrecht',
            'practice' => 'Strafprozessrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/konrad-jeker-a756a1149/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Markus J. Meier',
            'title' => 'MLaw, Rechtsanwalt',
            'occupation' => 'Strafverteidiger',
            'practice' => 'Strafprozessrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/markus-j-meier-611a3299/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Tobias Schaffner',
            'title' => 'Dr.iur., LL.M., Rechtsanwalt',
            'occupation' => '',
            'practice' => 'Strafprozessrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/tobias-schaffner-08a586141/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Caroline Schär',
            'title' => 'MLaw, Rechtsanwältin',
            'occupation' => 'Gerichtsschreiberin am Bundesgericht, Ersatzrichterin am Obergericht des Kantons Aargau',
            'practice' => 'Strafprozessrecht',
            'linkedin_url' => '',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Kristina Schwab',
            'title' => 'MLaw',
            'occupation' => 'Juristin',
            'practice' => 'Strafprozessrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/kristina-schwab-b30833156/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Denise Weingart',
            'title' => 'Dr.iur, Rechtsanwältin',
            'occupation' => 'Gerichtspräsidentin Regionalgericht Berner Jura-Seeland, Ersatzrichterin am Obergericht Bern',
            'practice' => 'Strafprozessrecht',
            'linkedin_url' => 'https://www.linkedin.com/in/denise-weingart-766b33157/',
            'website_url' => '',
        ]);
        
        User::factory()->create([
            'name' => 'Lea Hungerbühler',
            'title' => 'Rechtsanwältin, LL.M.',
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
