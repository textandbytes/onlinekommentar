<?php

namespace Textandbytes\Converter\Commands;

use Textandbytes\Converter\Converter;
use Illuminate\Console\Command;
use Statamic\Facades\Entry;

class ImportDocuments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'converter:import-documents';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // You'll need to fetch the list of .html files from whereever they are on your system
        $documents = [
            '/example-path-to-documents-folder/legal-text-1.html',
            '/example-path-to-documents-folder/legal-text-2.html',
            // ...
        ];

        // Loop over the documents
        foreach ($documents as $document) {

            // Get the name of the file and convert it to ProseMirror
            $name = pathinfo($document, PATHINFO_FILENAME);
            $text = (new Converter)->convert(file_get_contents($document));

            // Create and save a new entry
            Entry::make()
                ->published(true)
                ->collection('commentaries')
                ->blueprint('commentary')
                ->slug($name)
                ->data([
                    'title' => $name,
                    'legal_text' => $text,
                ])
                ->save();
        }

        return Command::SUCCESS;
    }
}
