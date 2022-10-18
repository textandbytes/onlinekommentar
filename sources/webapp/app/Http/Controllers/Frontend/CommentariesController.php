<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Yaml\Package\Facade as YamlFacade;
use Statamic\Modifiers\CoreModifiers;
use Jfcherng\Diff\DiffHelper;
use Jfcherng\Diff\Factory\RendererFactory;
use Jfcherng\Diff\Renderer\RendererConstant;

class CommentariesController extends Controller
{
    public function compareRevisions($locale, $commentaryId, $revisionTimestamp1, $revisionTimestamp2)
    {
        // TODO: validate parameters

        // get the html version of the 'content' field for each revision
        $commentaryRevisionBasePath = config('statamic.revisions.path') . '/collections/commentaries/' . $locale . '/' . $commentaryId;
        $revision1 = $this->_getDataFromRevisionFile($commentaryRevisionBasePath . '/' . $revisionTimestamp1 . '.yaml');
        $revision2 = $this->_getDataFromRevisionFile($commentaryRevisionBasePath . '/' . $revisionTimestamp2 . '.yaml');

        // compare the revisions
        $comparisonResult = $this->_compareRevisions($revision1, $revision2);

        return response()->json($comparisonResult);
    }

    private function _getDataFromRevisionFile($revisionFile)
    {
        // open and parse the revision yaml file
        $yaml = YamlFacade::instance();
        $revision = $yaml->parseFile($revisionFile);

        // convert the structured data from the 'content' field into html
        $modifiers = new CoreModifiers();
        $revisionHtmlContent = $modifiers->bardHtml($revision['attributes']['data']['content']);

        return [
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
            'language' => 'eng',
            // show line numbers in HTML renderers
            'lineNumbers' => true,
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