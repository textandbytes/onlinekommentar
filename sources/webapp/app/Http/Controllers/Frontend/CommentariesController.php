<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request as RequestFacade;
use Jfcherng\Diff\DiffHelper;
use Jfcherng\Diff\Factory\RendererFactory;
use Jfcherng\Diff\Renderer\RendererConstant;
use PragmaRX\Yaml\Package\Facade as YamlFacade;
use Statamic\Facades\Entry;
use Statamic\Facades\User;
use Statamic\Modifiers\CoreModifiers;
use Statamic\View\View;
use TOC\MarkupFixer;
use TOC\TocGenerator;

class CommentariesController extends Controller
{
    public function show($locale, $commentarySlug, $versionTimestamp = null)
    {
        if ($versionTimestamp) {
            // locate the commentary with the given slug
            $commentary = Entry::query()
                ->where('collection', 'commentaries')
                ->where('locale', $locale)
                ->where('slug', $commentarySlug)
                ->first()
                ->toArray();

            // return 404 if revision file is not found
            $commentaryRevisionBasePath = $this->_getCommentaryRevisionBasePath($locale, $commentary['id']);
            $revisionFile = $commentaryRevisionBasePath . '/' . $versionTimestamp . '.yaml';
            if (!File::exists($revisionFile)) {
                abort(404);
            }

            // get the revision data for the given timestamp
            $commentaryData = $this->_getRevisionDataFromRevisionFile($revisionFile, $locale);
        }
        else {
            $commentaryData = Entry::query()
                ->where('collection', 'commentaries')
                ->where('locale', $locale)
                ->where('slug', $commentarySlug)
                ->where('status', 'published')
                ->first()
                ->toArray();
        }

        // get the assigned authors and editors from their ids
        $commentaryData['assigned_authors'] = $this->_getUsers($commentaryData['assigned_authors'], ['name']);
        $commentaryData['assigned_editors'] = $this->_getUsers($commentaryData['assigned_editors'], ['name']);

        // generate formatted html markup for the language-specific 'content' field
        $content = $commentaryData['content'];

        // add anchor attributes to the heading elements
        $contentMarkup = null;
        if ($content) {
            $markupFixer = new MarkupFixer();
            $contentMarkup = $markupFixer->fix($content);
            // $commentaryData['content'] = $contentMarkup;
        }
        
        // generate table of contents from the heading elements
        $toc = null;
        if ($contentMarkup) {
            $tocGenerator = new TocGenerator();
            $toc = $tocGenerator->getHtmlMenu($contentMarkup);
        }
    
        // load the commentary detail view
        return (new View)
            ->template('commentaries/show')
            ->layout('layout')
            ->with(array_merge([
                'locale' => $locale,
                'contentMarkup' => $contentMarkup,
                'toc' => $toc,
                'versionTimestamp' => $versionTimestamp
            ], $commentaryData));
    }

    public function compareRevisions($locale, $commentaryId, $versionTimestamp1, $versionTimestamp2)
    {
        // TODO: validate parameters

        // get the html version of the 'content' field for each revision
        $commentaryRevisionBasePath = $this->_getCommentaryRevisionBasePath($locale, $commentaryId);
        $revisionContent1 = $this->_getRevisionContentFromRevisionFile($commentaryRevisionBasePath . '/' . $versionTimestamp1 . '.yaml', $locale);
        $revisionContent2 = $this->_getRevisionContentFromRevisionFile($commentaryRevisionBasePath . '/' . $versionTimestamp2 . '.yaml', $locale);

        // compare the revisions
        $comparisonResult = $this->_compareRevisions($revisionContent1, $revisionContent2);

        return response()->json($comparisonResult);
    }

    private function _getUsers($ids, $fieldsToInclude = null)
    {
        $users = [];
        if ($ids) {
            foreach ($ids as $id) {
                $user = User::query()
                    ->where('id', '=', $id)
                    ->first()
                    ->toArray();

                $users[] = $fieldsToInclude ? array_intersect_key($user, array_flip($fieldsToInclude)) : $user;
            }
        }
        return $users;
    }

    private function _getCommentaryRevisionBasePath($locale, $commentaryId)
    {
        return config('statamic.revisions.path') . '/collections/commentaries/' . $locale . '/' . $commentaryId;
    }

    private function _getLocaleFormattedTimestamp($timestamp, $locale)
    {
        $format = ($locale === 'en' ? 'MM.DD' : 'DD.MM') . '.YYYY hh:mm:ss z';
        return Carbon::createFromTimestamp($timestamp)->isoFormat($format);
    }

    private function _getRevisionDataFromRevisionFile($revisionFile, $locale)
    {
        // extract the revision data from the revision yaml file
        $yaml = YamlFacade::instance();
        $revision = $yaml->parseFile($revisionFile);
        $revisionData = $revision['attributes']['data'];

        // include the id and slug in the revision data
        $revisionData['id'] = $revision['attributes']['id'];
        $revisionData['slug'] = $revision['attributes']['slug'];

        // convert the structured data from the 'content' field into html
        $modifiers = new CoreModifiers();
        $revisionData['content'] = $modifiers->bardHtml($revisionData['content']);

        // add anchor attributes to the heading elements
        if ($revisionData['content']) {
            $markupFixer = new MarkupFixer();
            $revisionData['content'] = $markupFixer->fix($revisionData['content']);
        }

        // include the human-readable timestamp of the revision in the revision data
        $revisionData['human_readable_timestamp'] = $this->_getLocaleFormattedTimestamp($revision['date'], $locale);

        return $revisionData;
    }

    private function _getRevisionContentFromRevisionFile($revisionFile, $locale)
    {
        // open and parse the revision yaml file
        $yaml = YamlFacade::instance();
        $revision = $yaml->parseFile($revisionFile);

        // convert the structured data from the 'content' field into html
        $modifiers = new CoreModifiers();
        $revisionHtmlContent = $modifiers->bardHtml($revision['attributes']['data']['content']);

        return [
            'human_readable_timestamp' => $this->_getLocaleFormattedTimestamp($revision['date'], $locale),
            'creator' => $revision['user'],
            'content' => $revisionHtmlContent
        ];
    }

    private function _compareRevisions($revision1, $revision2)
    {
        /*
         * Renderer class name:
         *   Text renderers: Context, JsonText, Unified
         *   HTML renderers: Combined, Inline, JsonHtml, SideBySide
         */
        $rendererName = 'SideBySide';

        /*
         * Renderer class options
         */
        $rendererOptions = [
            // how detailed the rendered HTML in-line diff is? (none, line, word, char)
            'detailLevel' => 'word',
            // renderer language: eng, cht, chs, jpn, ...
            // or an array which has the same keys with a language file
            'language' => [
                'old_version' => $revision1['creator'] . '&nbsp;&nbsp;' . $revision1['human_readable_timestamp'] . '<br />',
                'new_version' => $revision2['creator'] . '&nbsp;&nbsp;' . $revision2['human_readable_timestamp'] . '<br />'
            ],
            // show line numbers in HTML renderers
            'lineNumbers' => false,
            // show a separator between different diff hunks in HTML renderers
            'separateBlock' => true,
            // show the (table) header
            'showHeader' => true,
            // the frontend HTML could use CSS "white-space: pre;" to visualize consecutive whitespaces
            // but if you want to visualize them in the backend with "&nbsp;", you can set this to true
            'spacesToNbsp' => false,
            // HTML renderer tab width (negative = do not convert into spaces)
            'tabSize' => 4,
            // this option is currently only for the Combined renderer.
            // it determines whether a replace-type block should be merged or not
            // depending on the content changed ratio, which values between 0 and 1.
            'mergeThreshold' => 0.8,
            // this option is currently only for the Unified and the Context renderers.
            // RendererConstant::CLI_COLOR_AUTO = colorize the output if possible (default)
            // RendererConstant::CLI_COLOR_ENABLE = force to colorize the output
            // RendererConstant::CLI_COLOR_DISABLE = force not to colorize the output
            'cliColorization' => RendererConstant::CLI_COLOR_AUTO,
            // this option is currently only for the Json renderer.
            // internally, ops (tags) are all int type but this is not good for human reading.
            // set this to "true" to convert them into string form before outputting.
            'outputTagAsString' => false,
            // this option is currently only for the Json renderer.
            // it controls how the output JSON is formatted.
            // see available options on https://www.php.net/manual/en/function.json-encode.php
            'jsonEncodeFlags' => \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE,
            // this option is currently effective when the "detailLevel" is "word"
            // characters listed in this array can be used to make diff segments into a whole
            // for example, making "<del>good</del>-<del>looking</del>" into "<del>good-looking</del>"
            // this should bring better readability but set this to empty array if you do not want it
            'wordGlues' => [' ', '-'],
            // change this value to a string as the returned diff if the two input strings are identical
            'resultForIdenticals' => null,
            // extra HTML classes added to the DOM of the diff container
            'wrapperClasses' => ['diff-wrapper'],
        ];

        // use the JSON result to render in HTML
        $jsonResult = DiffHelper::calculate($revision1['content'], $revision2['content'], 'Json');  // may store the JSON result in your database
        $htmlRenderer = RendererFactory::make($rendererName, $rendererOptions);
        return html_entity_decode($htmlRenderer->renderArray(json_decode($jsonResult, true)));
    }
}