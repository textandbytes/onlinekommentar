<?php

namespace App\Tags;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use PragmaRX\Yaml\Package\Facade as YamlFacade;
use Statamic\Tags\Tags;
use Statamic\Modifiers\CoreModifiers;

class Revisions extends Tags
{
    /**
     * The {{ revisions:commentary }} tag.
     *
     * @return string|array
     */
    public function commentary()
    {
        // get the locale and commentary id parameters from the tag
        $locale = $this->params->get('locale');
        $commentaryId = $this->params->get('id');

        // extract the timestamps from the list of revision files
        $commentaryRevisionBasePath = config('statamic.revisions.path') . '/collections/commentaries/' . $locale . '/' . $commentaryId;
        $revisionTimestamps = $this->_getFilenamesFromPath($commentaryRevisionBasePath, false);


        // return the unix timestamp, human-readable timestamp and content for each revision
        $revisions = [];
        $currentRevisionHtml = null;
        $previousRevisionHtml = null;
        $yaml = YamlFacade::instance();
        foreach ($revisionTimestamps as $timestamp) {
            // keep track of the previous version of the content
            $previousRevisionHtml = $currentRevisionHtml;

            // extract the structured data from 'content' field in the revision file
            $revisionFile = $commentaryRevisionBasePath . '/' . $timestamp . '.yaml';
            $revision = $yaml->parseFile($revisionFile);
            $revisionContent = $revision['attributes']['data']['content'];

            // convert the structured data from the 'content' field into HTML
            $modifiers = new CoreModifiers();
            $revisionHtml = $modifiers->bardHtml($revisionContent);

            // keep track of the current version of the content
            $currentRevisionHtml = $revisionHtml;

            // only include revisions whose content field has changed
            if (strcmp($currentRevisionHtml, $previousRevisionHtml) !== 0) {
                $revisions[] = [
                    'unix_timestamp' => $timestamp,
                    'human_readable_timestamp' => Carbon::createFromTimestamp($timestamp)->isoFormat('MM.DD.YYYY hh:mm:ss z'),
                    'content' => $currentRevisionHtml
                ];
            }
        }

        return array_reverse($revisions);
    }

    private function _getFilenamesFromPath($path, $includeFileExtension = true)
    {
        $filenames = collect(File::files($path))
            ->map(function ($file) use ($includeFileExtension) {
                return $includeFileExtension ? pathinfo($file)['basename'] : pathinfo($file)['filename'];
            })
            ->toArray();

        return array_values($filenames);
    }
}
