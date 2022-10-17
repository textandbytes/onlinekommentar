<div class="bg-white">
  {{ search:results as="results" }}
    <div class="px-8 py-4 mb-2 border-b border-black">
      <h2 class="text-xs uppercase"><span class="font-medium">{{ get:q }}</span> – {{ results | count }}
        {{ if results | count === 1 }}
          <?= __('result_found') ?>
        {{ else }}
          <?= __('results_found') ?>
        {{ endif }}
      </h2>
    </div>

    <div class="container px-8 py-8">
      <div class="row">
        <div class="col-12">
          <div class="search-results">
              {{ if results }}
                <ul class="border-t border-gray-300 pt-4">
                {{ results }}
                  {{ if content != '' }}
                    <li class="flex justify-between items-start border-b border-gray-400 py-4">
                      <span class="flex w-3/12 text-xl font-serif">{{ title }}</span>
                      <span class="flex w-6/12 text-sm text-gray-700">{{ content  | raw | bard_text | truncate:200 }}</span>
                      <a class="flex ok-button !mt-0" href="{{ url }}"><?= __('open') ?></a>
                    </li>
                  {{ endif }}
                {{ /results }}
                </ul>
              {{ else }}
                <p><?= __('no_results_found') ?>.</p>
              {{ /if }}
          </div>
        </div>
      </div>
  {{ /search:results }}
</div>