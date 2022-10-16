<?php

namespace App\Tags;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Statamic\Tags\Tags;

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
        $pathToRevisions = config('statamic.revisions.path') . '/collections/commentaries/' . $locale . '/' . $commentaryId;
        $revisionTimestamps = $this->_getFilenamesFromPath($pathToRevisions, false);

        // convert revision timestamps into human-readable strings
        $revisions = [];
        foreach ($revisionTimestamps as $timestamp) {
            $revisions[] = [
                'unix_timestamp' => $timestamp,
                'human_readable_timestamp' => Carbon::createFromTimestamp($timestamp)->isoFormat('MM.DD.YYYY hh:mm:ss z')
            ];
        }

        return $revisions;
    }

    private function _getFilenamesFromPath($path, $includeFileExtension = true)
    {
        $filenames = collect(File::files($path))
            ->sortByDesc(function ($file) {
                return $file->getCTime();
            })
            ->map(function ($file) use ($includeFileExtension) {
                return $includeFileExtension ? pathinfo($file)['basename'] : pathinfo($file)['filename'];
            })
            ->toArray();

        return array_values($filenames);
    }
}
